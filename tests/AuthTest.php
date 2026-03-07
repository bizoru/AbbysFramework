<?php

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    protected function setUp(): void
    {
        // Reset session state
        $_SESSION = [];
    }

    public function testGetAuthReturnsFalseWhenNoSession(): void
    {
        unset($_SESSION['auth']);
        $this->assertFalse(Auth::getAuth());
    }

    public function testGetAuthReturnsTrueWhenSessionAuthSet(): void
    {
        $_SESSION['auth'] = true;
        $this->assertTrue(Auth::getAuth());
    }

    public function testGetAuthReturnsTrueWhenSessionAuthIsAnyTruthyValue(): void
    {
        $_SESSION['auth'] = 'user123';
        $this->assertTrue(Auth::getAuth());
    }

    public function testGetAuthReturnsTrueEvenWhenSessionAuthIsFalsy(): void
    {
        // isset() returns true even for falsy values like 0 or ""
        $_SESSION['auth'] = 0;
        $this->assertTrue(Auth::getAuth());
    }
}
