<?php

use PHPUnit\Framework\TestCase;

class HttpHandlerTest extends TestCase
{
    protected function setUp(): void
    {
        $_POST = [];
        $_GET = [];
        $_SERVER['REQUEST_METHOD'] = 'GET';
    }

    protected function tearDown(): void
    {
        $_POST = [];
        $_GET = [];
    }

    public function testPostReturnsValueFromPostSuperglobal(): void
    {
        $_POST['name'] = 'John';

        $result = HttpHandler::post('name');
        $this->assertEquals('John', $result);
    }

    public function testPostReturnsEmptyStringForMissingKey(): void
    {
        $result = HttpHandler::post('nonexistent');
        $this->assertEquals('', $result);
    }

    public function testPostEscapesHtmlCharacters(): void
    {
        $_POST['input'] = '<script>alert("xss")</script>';

        $result = HttpHandler::post('input');
        $this->assertStringNotContainsString('<script>', $result);
    }

    public function testGetReturnsValueFromGetSuperglobal(): void
    {
        $_GET['page'] = '5';

        $result = HttpHandler::get('page');
        $this->assertEquals('5', $result);
    }

    public function testGetReturnsEmptyStringForMissingKey(): void
    {
        $result = HttpHandler::get('nonexistent');
        $this->assertEquals('', $result);
    }

    public function testGetEscapesHtmlCharacters(): void
    {
        $_GET['q'] = '<img onerror="alert(1)">';

        $result = HttpHandler::get('q');
        $this->assertStringNotContainsString('<img', $result);
    }

    public function testWipeSanitizesInput(): void
    {
        $result = HttpHandler::wipe('<b>bold</b>');
        $this->assertStringNotContainsString('<b>', $result);
    }

    public function testWipeHandlesNormalText(): void
    {
        $result = HttpHandler::wipe('hello world');
        $this->assertEquals('hello world', $result);
    }

    public function testCleanVarSanitizesInput(): void
    {
        $result = HttpHandler::cleanVar('<div>test</div>');
        $this->assertStringNotContainsString('<div>', $result);
    }

    public function testCleanVarPreservesPlainText(): void
    {
        $result = HttpHandler::cleanVar('simple text');
        $this->assertEquals('simple text', $result);
    }

    public function testIsPostReturnsTrueForPostRequest(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $this->assertTrue(HttpHandler::isPost());
    }

    public function testIsPostReturnsFalseForGetRequest(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $this->assertFalse(HttpHandler::isPost());
    }

    public function testIsGetReturnsTrueForGetRequest(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';

        $this->assertTrue(HttpHandler::isGet());
    }

    public function testIsGetReturnsFalseForPostRequest(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $this->assertFalse(HttpHandler::isGet());
    }

    public function testMapPostMapsPostDataToObjectProperties(): void
    {
        $_POST['name'] = 'John';
        $_POST['email'] = 'john@test.com';

        $obj = new class {
            public $name = '';
            public $email = '';
        };

        HttpHandler::mapPost($obj);

        $this->assertEquals('John', $obj->name);
        $this->assertEquals('john@test.com', $obj->email);
    }
}
