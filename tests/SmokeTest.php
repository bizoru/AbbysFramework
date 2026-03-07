<?php

use PHPUnit\Framework\TestCase;

/**
 * Smoke tests verifying end-to-end integration of framework components.
 * These tests exercise multiple classes working together without requiring
 * a running database or web server.
 */
class SmokeTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION = [];
        $_POST = [];
        $_GET = [];
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/';
        $_SERVER['SERVER_PORT'] = '80';
        $_SERVER['SERVER_NAME'] = 'localhost';
        $_SERVER['HTTPS'] = '';
    }

    // ---------------------------------------------------------------
    // Smoke: Router → URL parsing → default routing
    // ---------------------------------------------------------------

    public function testRouterParsesDefaultUrlToBackendAdmin(): void
    {
        $_SERVER['REQUEST_URI'] = '/';
        $router = new Router();
        $uri = $router->parseURL();

        $this->assertEquals(DEFAULT_APPLICATION, $uri['application']);
        $this->assertEquals(DEFAULT_CONTROLLER, $uri['controller']);
        $this->assertEquals(DEFAULT_METHOD, $uri['method']);
    }

    public function testRouterParsesDeepUrl(): void
    {
        $_SERVER['REQUEST_URI'] = '/backend/login/access/42';
        $router = new Router();
        $uri = $router->parseURL();

        $this->assertEquals('backend', $uri['application']);
        $this->assertEquals('login', $uri['controller']);
        $this->assertEquals('access', $uri['method']);
        $this->assertEquals('42', $uri['var']);
    }

    // ---------------------------------------------------------------
    // Smoke: Auth + Session integration
    // ---------------------------------------------------------------

    public function testAuthFlowUnauthenticatedUser(): void
    {
        // No session → Auth::getAuth() returns false
        $this->assertFalse(Auth::getAuth());

        // SessionMan also returns null
        $this->assertNull(SessionMan::getSessionValue('auth'));
    }

    public function testAuthFlowAuthenticatedUser(): void
    {
        // Simulate login: set session values like Login controller does
        SessionMan::setSessionValue(true, 'auth');
        SessionMan::setSessionValue(['id' => 1, 'usuario' => 'admin'], 'user');

        // Auth should now pass
        $this->assertTrue(Auth::getAuth());

        // Session values should be retrievable
        $user = SessionMan::getSessionValue('user');
        $this->assertEquals('admin', $user['usuario']);
        $this->assertEquals(1, $user['id']);
    }

    public function testLogoutClearsAuthSession(): void
    {
        // Login
        SessionMan::setSessionValue(true, 'auth');
        SessionMan::setSessionValue(['id' => 1], 'user');
        $this->assertTrue(Auth::getAuth());

        // Logout: delete session values
        SessionMan::deleteSessionValue('auth');
        SessionMan::deleteSessionValue('user');

        $this->assertFalse(Auth::getAuth());
        $this->assertNull(SessionMan::getSessionValue('user'));
    }

    // ---------------------------------------------------------------
    // Smoke: Model validation pipeline (end-to-end)
    // ---------------------------------------------------------------

    public function testModelValidationPipelineWithUserModel(): void
    {
        // Create a model subclass that mimics model_usuario's validators
        // without requiring a DB connection
        $model = new SmokeTestUserModel();

        // Empty fields → should fail validation
        $model->usuario = '';
        $model->nombre = '';
        $model->apellido = '';
        $model->correo = '';
        $model->contrasena = '';
        $model->contrasenar = '';
        $model->grupo_id = '';

        $this->assertFalse($model->isValid());
        $messages = $model->getForm()->messages;
        $this->assertNotEmpty($messages);

        // Check that specific fields were flagged
        $this->assertArrayHasKey('nombre', $messages);
        $this->assertArrayHasKey('usuario', $messages);
        $this->assertArrayHasKey('contrasena', $messages);
    }

    public function testModelValidationPipelinePassesWithValidData(): void
    {
        $model = new SmokeTestUserModel();

        $model->usuario = 'admin';
        $model->nombre = 'John';
        $model->apellido = 'Doe';
        $model->correo = 'john@test.com';
        $model->contrasena = 'secret123';
        $model->contrasenar = 'secret123';
        $model->grupo_id = '1';

        $this->assertTrue($model->isValid());
        $this->assertEmpty($model->getForm()->messages);
    }

    public function testModelValidationPasswordMismatch(): void
    {
        $model = new SmokeTestUserModel();

        $model->usuario = 'admin';
        $model->nombre = 'John';
        $model->apellido = 'Doe';
        $model->correo = 'john@test.com';
        $model->contrasena = 'password1';
        $model->contrasenar = 'password2';
        $model->grupo_id = '1';

        $this->assertFalse($model->isValid());
        $this->assertArrayHasKey('contrasena', $model->getForm()->messages);
    }

    // ---------------------------------------------------------------
    // Smoke: Prepared statements with SQL escaping
    // ---------------------------------------------------------------

    public function testPreparedStatementIntegration(): void
    {
        $model = new SmokeTestUserModel();

        // Simulate the checkUser query pattern from model_usuario
        $statement = "select * from usuario where usuario.usuario =':usuario' and usuario.contrasena=':password'";
        $params = ['usuario' => "admin' OR 1=1 --", 'password' => 'abc123'];

        $result = $model->prepareStatement($statement, $params);

        // SQL injection attempt should be escaped
        $this->assertStringContainsString("admin\\' OR 1=1 --", $result);
        $this->assertStringContainsString('abc123', $result);
        $this->assertStringNotContainsString(':usuario', $result);
        $this->assertStringNotContainsString(':password', $result);
    }

    // ---------------------------------------------------------------
    // Smoke: HttpHandler → Form validation round trip
    // ---------------------------------------------------------------

    public function testHttpHandlerToFormValidationRoundTrip(): void
    {
        // Simulate POST request with form data
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['usuario'] = '<script>alert("xss")</script>admin';
        $_POST['nombre'] = 'John';
        $_POST['password'] = 'secret';

        // HttpHandler should sanitize input
        $this->assertTrue(HttpHandler::isPost());
        $usuario = HttpHandler::post('usuario');
        $this->assertStringNotContainsString('<script>', $usuario);

        // Sanitized data can then be used in model validation
        $model = new SmokeTestUserModel();
        $model->usuario = $usuario;
        $model->nombre = HttpHandler::post('nombre');
        $model->apellido = 'Doe';
        $model->correo = 'test@test.com';
        $model->contrasena = HttpHandler::post('password');
        $model->contrasenar = HttpHandler::post('password');
        $model->grupo_id = '1';

        $this->assertTrue($model->isValid());
    }

    // ---------------------------------------------------------------
    // Smoke: Routes configuration integrity
    // ---------------------------------------------------------------

    public function testRoutesResolveToValidApplicationPaths(): void
    {
        // Verify that routes reference the correct application structure
        $homeRoute = Routes::$home;
        $this->assertEquals('backend', $homeRoute['route']['application']);
        $this->assertEquals('admin', $homeRoute['route']['module']);

        // The default router should produce compatible output
        $_SERVER['REQUEST_URI'] = '/backend/admin/index';
        $router = new Router();
        $uri = $router->parseURL();

        $this->assertEquals($homeRoute['route']['application'], $uri['application']);
        $this->assertEquals($homeRoute['route']['module'], $uri['controller']);
        $this->assertEquals($homeRoute['route']['method'], $uri['method']);
    }

    // ---------------------------------------------------------------
    // Smoke: Session lifecycle
    // ---------------------------------------------------------------

    public function testFullSessionLifecycle(): void
    {
        // 1. No session initially
        $this->assertFalse(Auth::getAuth());

        // 2. Set multiple session values (simulating login)
        SessionMan::setSessionValue(true, 'auth');
        SessionMan::setSessionValue(['id' => 5, 'usuario' => 'testuser', 'grupo_id' => 2], 'user');
        SessionMan::setSessionValue('vendedores', 'realm');

        // 3. Verify all values persist
        $this->assertTrue(Auth::getAuth());
        $user = SessionMan::getSessionValue('user');
        $this->assertEquals(5, $user['id']);
        $this->assertEquals('vendedores', SessionMan::getSessionValue('realm'));

        // 4. Partial cleanup
        SessionMan::deleteSessionValue('realm');
        $this->assertNull(SessionMan::getSessionValue('realm'));
        $this->assertTrue(Auth::getAuth()); // still authenticated

        // 5. Full logout
        SessionMan::deleteSessionValue('auth');
        SessionMan::deleteSessionValue('user');
        $this->assertFalse(Auth::getAuth());
    }

    // ---------------------------------------------------------------
    // Smoke: XSS protection across input handling
    // ---------------------------------------------------------------

    public function testXssProtectionEndToEnd(): void
    {
        $malicious = '<img src=x onerror=alert(1)>';

        // HttpHandler sanitizes POST
        $_POST['input'] = $malicious;
        $sanitized = HttpHandler::post('input');
        $this->assertStringNotContainsString('<img', $sanitized);

        // HttpHandler sanitizes GET
        $_GET['q'] = $malicious;
        $sanitizedGet = HttpHandler::get('q');
        $this->assertStringNotContainsString('<img', $sanitizedGet);

        // wipe also sanitizes
        $wiped = HttpHandler::wipe($malicious);
        $this->assertStringNotContainsString('<img', $wiped);

        // cleanVar also sanitizes
        $cleaned = HttpHandler::cleanVar($malicious);
        $this->assertStringNotContainsString('<img', $cleaned);

        // Router sanitizes URI arrays
        $router = new Router();
        $uri = ['path' => $malicious];
        $router->cleanUri($uri);
        $this->assertStringNotContainsString('<img', $uri['path']);
    }

    // ---------------------------------------------------------------
    // Smoke: Model getInstance with validation data
    // ---------------------------------------------------------------

    public function testModelGetInstanceReflectsCurrentState(): void
    {
        $model = new SmokeTestUserModel();
        $model->usuario = 'admin';
        $model->nombre = 'Test';
        $model->apellido = 'User';
        $model->correo = 'test@test.com';
        $model->contrasena = 'pass';
        $model->contrasenar = 'pass';
        $model->grupo_id = '1';

        $instance = $model->getInstance();

        $this->assertEquals('admin', $instance['usuario']);
        $this->assertEquals('Test', $instance['nombre']);
        $this->assertEquals('test@test.com', $instance['correo']);
    }

    // ---------------------------------------------------------------
    // Smoke: FileManager rejects bad file uploads
    // ---------------------------------------------------------------

    public function testFileUploadRejectsNonImageFiles(): void
    {
        $_FILES['file'] = [
            'type' => 'text/html',
            'size' => 100,
            'error' => 0,
            'name' => 'malicious.html',
            'tmp_name' => '/tmp/test',
        ];

        $result = FileManager::loadFile();
        $this->assertArrayHasKey('error', $result);
    }
}

/**
 * A testable Model subclass that mirrors model_usuario's validation setup
 * but without requiring a real database connection.
 */
class SmokeTestUserModel extends Model
{
    public $id;
    public $usuario;
    public $contrasena;
    public $contrasenar;
    public $nombre;
    public $apellido;
    public $correo;
    public $grupo_id;

    function __construct()
    {
        // Skip parent constructor (needs real DB), manually init form
        $reflection = new ReflectionClass(Model::class);

        $formProp = $reflection->getProperty('form');
        $formProp->setAccessible(true);
        $formProp->setValue($this, new Form());

        $sqlProp = $reflection->getProperty('sqlengine');
        $sqlProp->setAccessible(true);
        $sqlProp->setValue($this, null);

        // Set up validators exactly like model_usuario::setup()
        $this->getForm()->setValidator('checkPassword', 'contrasena', ['contrasena', 'contrasenar']);
        $this->getForm()->setValidator('checkEmpty', 'nombre', ['nombre']);
        $this->getForm()->setValidator('checkEmpty', 'usuario', ['usuario']);
        $this->getForm()->setValidator('checkEmpty', 'apellido', ['apellido']);
        $this->getForm()->setValidator('checkEmpty', 'correo', ['correo']);
        $this->getForm()->setValidator('checkEmpty', 'grupo', ['grupo_id']);
    }
}
