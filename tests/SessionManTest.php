<?php

use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class SessionManTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION = [];
    }

    public function testSetSessionValueStoresValue(): void
    {
        SessionMan::setSessionValue('bar', 'foo');
        $this->assertEquals('bar', $_SESSION['foo']);
    }

    public function testGetSessionValueReturnsStoredValue(): void
    {
        // Use setSessionValue to store (both methods call session_start())
        SessionMan::setSessionValue('testvalue', 'testkey');
        $this->assertEquals('testvalue', SessionMan::getSessionValue('testkey'));
    }

    public function testGetSessionValueReturnsNullForMissingKey(): void
    {
        $this->assertNull(SessionMan::getSessionValue('nonexistent'));
    }

    public function testDeleteSessionValueRemovesKey(): void
    {
        $_SESSION['toremove'] = 'value';
        SessionMan::deleteSessionValue('toremove');
        $this->assertArrayNotHasKey('toremove', $_SESSION);
    }

    public function testDeleteSessionValueDoesNothingForMissingKey(): void
    {
        SessionMan::deleteSessionValue('nonexistent');
        $this->assertArrayNotHasKey('nonexistent', $_SESSION);
    }

    public function testInitSessionSetsSessionName(): void
    {
        SessionMan::initSession();
        $this->assertEquals(md5('WebID'), session_name());
    }
}
