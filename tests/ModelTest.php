<?php

use PHPUnit\Framework\TestCase;

/**
 * Test the Model class with mocked database dependencies.
 * We test prepareStatement (no DB needed) and isValid (uses Form/Validator).
 * The constructor requires a DB connection, so we use a custom subclass with
 * an overridden constructor for unit testing.
 */
class TestableModel extends Model
{
    public $name;
    public $email;

    function __construct()
    {
        // Skip parent constructor (which creates a real SQLEngine/DB connection)
        // Manually set up the form
        $reflection = new ReflectionClass(Model::class);

        $formProp = $reflection->getProperty('form');
        $formProp->setAccessible(true);
        $formProp->setValue($this, new Form());

        $sqlProp = $reflection->getProperty('sqlengine');
        $sqlProp->setAccessible(true);
        $sqlProp->setValue($this, null);
    }
}

class ModelTest extends TestCase
{
    private TestableModel $model;

    protected function setUp(): void
    {
        $this->model = new TestableModel();
    }

    public function testGetFormReturnsFormInstance(): void
    {
        $this->assertInstanceOf(Form::class, $this->model->getForm());
    }

    public function testPrepareStatementReplacesParams(): void
    {
        $statement = "SELECT * FROM users WHERE name = :name AND email = :email";
        $params = ['name' => 'John', 'email' => 'john@example.com'];

        $result = $this->model->prepareStatement($statement, $params);

        $this->assertStringContainsString('John', $result);
        $this->assertStringContainsString('john@example.com', $result);
        $this->assertStringNotContainsString(':name', $result);
        $this->assertStringNotContainsString(':email', $result);
    }

    public function testPrepareStatementEscapesQuotes(): void
    {
        $statement = "SELECT * FROM users WHERE name = :name";
        $params = ['name' => "O'Brien"];

        $result = $this->model->prepareStatement($statement, $params);

        $this->assertStringContainsString("O\\'Brien", $result);
    }

    public function testPrepareStatementWithEmptyParams(): void
    {
        $statement = "SELECT * FROM users";
        $result = $this->model->prepareStatement($statement, []);

        $this->assertEquals($statement, $result);
    }

    public function testIsValidReturnsTrueWhenNoValidators(): void
    {
        $this->assertTrue($this->model->isValid());
    }

    public function testIsValidReturnsFalseWhenValidationFails(): void
    {
        $this->model->name = '';
        $this->model->getForm()->setValidator('checkEmpty', 'name', ['name']);

        $this->assertFalse($this->model->isValid());
    }

    public function testIsValidReturnsTrueWhenValidationPasses(): void
    {
        $this->model->name = 'John';
        $this->model->getForm()->setValidator('checkEmpty', 'name', ['name']);

        $this->assertTrue($this->model->isValid());
    }

    public function testIsValidClearsMessagesBeforeValidation(): void
    {
        $this->model->name = '';
        $this->model->getForm()->setValidator('checkEmpty', 'name', ['name']);

        // First validation should fail
        $this->assertFalse($this->model->isValid());

        // Fix the value
        $this->model->name = 'John';

        // Second validation should pass (messages cleared)
        $this->assertTrue($this->model->isValid());
    }

    public function testGetInstanceReturnsClassProperties(): void
    {
        $this->model->name = 'John';
        $this->model->email = 'john@test.com';

        $instance = $this->model->getInstance();

        $this->assertEquals('John', $instance['name']);
        $this->assertEquals('john@test.com', $instance['email']);
    }
}
