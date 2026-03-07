<?php

use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    private Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
        $this->validator->messages = [];
    }

    public function testCheckEmptyWithEmptyValueAddsMessage(): void
    {
        $this->validator->checkEmpty('username', ['']);

        $this->assertArrayHasKey('username', $this->validator->messages);
        $this->assertEquals(EMPTY_FIELD, $this->validator->messages['username']);
    }

    public function testCheckEmptyWithValueDoesNotAddMessage(): void
    {
        $this->validator->checkEmpty('username', ['john']);

        $this->assertEmpty($this->validator->messages);
    }

    public function testCheckEmptyWithEmptyParamsDoesNotAddMessage(): void
    {
        $this->validator->checkEmpty('username', []);

        $this->assertEmpty($this->validator->messages);
    }

    public function testCheckPasswordMatchingPasswordsNoMessage(): void
    {
        $this->validator->checkPassword('password', ['secret123', 'secret123']);

        $this->assertArrayNotHasKey('password', $this->validator->messages);
    }

    public function testCheckPasswordMismatchedPasswordsAddsMessage(): void
    {
        $this->validator->checkPassword('password', ['secret123', 'different']);

        $this->assertArrayHasKey('password', $this->validator->messages);
        $this->assertEquals(NOT_EQUAL, $this->validator->messages['password']);
    }

    public function testCheckPasswordBothEmptyAddsEmptyPasswordMessage(): void
    {
        $this->validator->checkPassword('password', ['', '']);

        $this->assertArrayHasKey('password', $this->validator->messages);
        $this->assertEquals(EMPTY_PASSWORD, $this->validator->messages['password']);
    }

    public function testCheckPasswordSingleParamDoesNothing(): void
    {
        $this->validator->checkPassword('password', ['secret123']);

        $this->assertEmpty($this->validator->messages);
    }

    public function testCheckEqualMatchingValuesNoMessage(): void
    {
        $this->validator->checkEqual('email', ['a@b.com', 'a@b.com']);

        $this->assertArrayNotHasKey('email', $this->validator->messages);
    }

    public function testCheckEqualMismatchedValuesAddsMessage(): void
    {
        $this->validator->checkEqual('email', ['a@b.com', 'c@d.com']);

        $this->assertArrayHasKey('email', $this->validator->messages);
        $this->assertEquals(NOT_EQUAL, $this->validator->messages['email']);
    }

    public function testCheckEqualBothEmptyAddsEmptyEmailMessage(): void
    {
        $this->validator->checkEqual('email', ['', '']);

        $this->assertArrayHasKey('email', $this->validator->messages);
        $this->assertEquals(EMPTY_EMAIL, $this->validator->messages['email']);
    }
}
