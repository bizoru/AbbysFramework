<?php

use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    private Router $router;

    protected function setUp(): void
    {
        $this->router = new Router();
        $_SERVER['SERVER_NAME'] = 'localhost';
        $_SERVER['SERVER_PORT'] = '80';
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        $_SERVER['REQUEST_URI'] = '/backend/admin/index';
    }

    public function testParseURLExtractsApplication(): void
    {
        $_SERVER['REQUEST_URI'] = '/backend/admin/index';

        $route = $this->router->parseURL();

        $this->assertEquals('backend', $route['application']);
    }

    public function testParseURLExtractsController(): void
    {
        $_SERVER['REQUEST_URI'] = '/backend/admin/index';

        $route = $this->router->parseURL();

        $this->assertEquals('admin', $route['controller']);
    }

    public function testParseURLExtractsMethod(): void
    {
        $_SERVER['REQUEST_URI'] = '/backend/admin/index';

        $route = $this->router->parseURL();

        $this->assertEquals('index', $route['method']);
    }

    public function testParseURLExtractsVar(): void
    {
        $_SERVER['REQUEST_URI'] = '/backend/usuario/edit/42';

        $route = $this->router->parseURL();

        $this->assertEquals('42', $route['var']);
    }

    public function testParseURLDefaultsMethodWhenMissing(): void
    {
        $_SERVER['REQUEST_URI'] = '/backend/admin';

        $route = $this->router->parseURL();

        $this->assertEquals(DEFAULT_METHOD, $route['method']);
    }

    public function testParseURLDefaultsControllerWhenEmpty(): void
    {
        $_SERVER['REQUEST_URI'] = '/backend';

        $route = $this->router->parseURL();

        $this->assertEquals(DEFAULT_CONTROLLER, $route['controller']);
    }

    public function testParseURLEmptyRequestUsesDefaults(): void
    {
        $_SERVER['REQUEST_URI'] = '/';

        $route = $this->router->parseURL();

        $this->assertEquals(DEFAULT_APPLICATION, $route['application']);
        $this->assertEquals(DEFAULT_CONTROLLER, $route['controller']);
        $this->assertEquals(DEFAULT_METHOD, $route['method']);
    }

    public function testCleanUriSanitizesHtmlEntities(): void
    {
        $uri = [
            'application' => '<script>',
            'controller' => 'admin',
        ];

        $this->router->cleanUri($uri);

        $this->assertStringNotContainsString('<script>', $uri['application']);
    }

    public function testCleanUriPreservesNormalText(): void
    {
        $uri = [
            'application' => 'backend',
            'controller' => 'admin',
        ];

        $this->router->cleanUri($uri);

        $this->assertEquals('backend', $uri['application']);
        $this->assertEquals('admin', $uri['controller']);
    }

    public function testCurPageURLReturnsHttpByDefault(): void
    {
        $_SERVER['REQUEST_URI'] = '/test';

        $url = $this->router->curPageURL();

        $this->assertStringStartsWith('http://', $url);
    }

    public function testCurPageURLReturnsHttpsWhenEnabled(): void
    {
        $_SERVER['HTTPS'] = 'on';
        $_SERVER['REQUEST_URI'] = '/test';

        $url = $this->router->curPageURL();

        $this->assertStringStartsWith('https://', $url);

        unset($_SERVER['HTTPS']);
    }

    public function testCurPageURLIncludesPortWhenNot80(): void
    {
        $_SERVER['SERVER_PORT'] = '8080';
        $_SERVER['REQUEST_URI'] = '/test';

        $url = $this->router->curPageURL();

        $this->assertStringContainsString(':8080', $url);
    }

    public function testGetCurrentURL(): void
    {
        $url = $this->router->getCurrentURL();

        $this->assertStringContainsString('localhost', $url);
    }

    public function testCurPageName(): void
    {
        $_SERVER['SCRIPT_NAME'] = '/path/to/index.php';

        $name = $this->router->curPageName();

        $this->assertEquals('index.php', $name);
    }
}
