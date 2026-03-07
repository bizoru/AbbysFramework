<?php

use PHPUnit\Framework\TestCase;

class ExcelXmlTest extends TestCase
{
    private Excel_XML $excel;

    protected function setUp(): void
    {
        $this->excel = new Excel_XML();
    }

    public function testSetWorksheetTitleStripsSpecialChars(): void
    {
        $this->excel->setWorksheetTitle('Test:Sheet/Name');

        $reflection = new ReflectionClass($this->excel);
        $prop = $reflection->getProperty('worksheet_title');
        $prop->setAccessible(true);

        $this->assertEquals('TestSheetName', $prop->getValue($this->excel));
    }

    public function testSetWorksheetTitleTruncatesTo31Chars(): void
    {
        $this->excel->setWorksheetTitle(str_repeat('A', 50));

        $reflection = new ReflectionClass($this->excel);
        $prop = $reflection->getProperty('worksheet_title');
        $prop->setAccessible(true);

        $this->assertEquals(31, strlen($prop->getValue($this->excel)));
    }

    public function testSetWorksheetTitleStripsBackslash(): void
    {
        $this->excel->setWorksheetTitle('Back\\Slash');

        $reflection = new ReflectionClass($this->excel);
        $prop = $reflection->getProperty('worksheet_title');
        $prop->setAccessible(true);

        $this->assertEquals('BackSlash', $prop->getValue($this->excel));
    }

    public function testSetWorksheetTitleStripsBrackets(): void
    {
        $this->excel->setWorksheetTitle('Test[1]');

        $reflection = new ReflectionClass($this->excel);
        $prop = $reflection->getProperty('worksheet_title');
        $prop->setAccessible(true);

        $this->assertEquals('Test1', $prop->getValue($this->excel));
    }

    public function testAddArrayPopulatesLines(): void
    {
        $data = [
            ['Name', 'Age'],
            ['Alice', '30'],
        ];
        $this->excel->addArray($data);

        $reflection = new ReflectionClass($this->excel);
        $prop = $reflection->getProperty('lines');
        $prop->setAccessible(true);
        $lines = $prop->getValue($this->excel);

        $this->assertCount(2, $lines);
        $this->assertStringContainsString('Alice', $lines[1]);
        $this->assertStringContainsString('Name', $lines[0]);
    }

    public function testAddArrayGeneratesValidXmlCells(): void
    {
        $data = [['Hello']];
        $this->excel->addArray($data);

        $reflection = new ReflectionClass($this->excel);
        $prop = $reflection->getProperty('lines');
        $prop->setAccessible(true);
        $lines = $prop->getValue($this->excel);

        $this->assertStringContainsString('<Row>', $lines[0]);
        $this->assertStringContainsString('<Cell>', $lines[0]);
        $this->assertStringContainsString('<Data ss:Type="String">', $lines[0]);
        $this->assertStringContainsString('</Row>', $lines[0]);
    }

    public function testAddArrayWithEmptyArray(): void
    {
        $this->excel->addArray([]);

        $reflection = new ReflectionClass($this->excel);
        $prop = $reflection->getProperty('lines');
        $prop->setAccessible(true);

        $this->assertCount(0, $prop->getValue($this->excel));
    }

    public function testDefaultWorksheetTitleIsTable1(): void
    {
        $reflection = new ReflectionClass($this->excel);
        $prop = $reflection->getProperty('worksheet_title');
        $prop->setAccessible(true);

        $this->assertEquals('Table1', $prop->getValue($this->excel));
    }
}
