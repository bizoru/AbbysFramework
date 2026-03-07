<?php

use PHPUnit\Framework\TestCase;

class FormTest extends TestCase
{
    private Form $form;

    protected function setUp(): void
    {
        $this->form = new Form();
    }

    public function testGetValidatorsReturnsEmptyArrayByDefault(): void
    {
        $this->assertIsArray($this->form->getValidators());
        $this->assertEmpty($this->form->getValidators());
    }

    public function testSetValidatorAddsValidator(): void
    {
        $this->form->setValidator('checkEmpty', 'username', ['username']);

        $validators = $this->form->getValidators();
        $this->assertCount(1, $validators);
        $this->assertEquals('checkEmpty', $validators[0][0]);
        $this->assertEquals('username', $validators[0][1]);
        $this->assertEquals(['username'], $validators[0][2]);
    }

    public function testSetMultipleValidators(): void
    {
        $this->form->setValidator('checkEmpty', 'username', ['username']);
        $this->form->setValidator('checkPassword', 'password', ['password', 'confirm']);

        $validators = $this->form->getValidators();
        $this->assertCount(2, $validators);
    }

    public function testFormExtendsValidator(): void
    {
        $this->assertInstanceOf(Validator::class, $this->form);
    }

    public function testFormCanRunValidation(): void
    {
        $this->form->messages = [];
        $this->form->checkEmpty('name', ['']);

        $this->assertArrayHasKey('name', $this->form->messages);
        $this->assertEquals(EMPTY_FIELD, $this->form->messages['name']);
    }
}
