<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class StrPutCsvTest extends TestCase
{
    public function testEmpty(): void
    {
        $csv = str_putcsv([]);
        $this->assertSame('', $csv);
    }

    public function testNumbers(): void
    {
        $csv = str_putcsv([1, 2, 3]);
        $this->assertSame('1,2,3', $csv);
    }

    public function testMixedTypes(): void
    {
        $csv = str_putcsv([1, 'John Doe', 'phpunit']);
        $this->assertSame('1,"John Doe",phpunit', $csv);
    }

    public function testMultiline(): void
    {
        $csv = str_putcsv([1, "PHP\nUnit"]);
        $this->assertSame("1,\"PHP\nUnit\"", $csv);
    }

    public function testMixedQuotes(): void
    {
        $csv = str_putcsv([1, 'php"unit']);
        $this->assertSame('1,"php""unit"', $csv);
    }

    public function testDifferentDelimiter(): void
    {
        $csv = str_putcsv([1, 'phpunit', 2], ']');
        $this->assertSame('1]phpunit]2', $csv);
    }

    public function testDifferentEnclosure(): void
    {
        $csv = str_putcsv([1, 'php unit', 2], ',', '\'');
        $this->assertSame("1,'php unit',2", $csv);
    }

    public function testDifferentEscape(): void
    {
        // The inner quotation mark is considered escaped by the @-sign.
        $csv = str_putcsv([1, 'php@"unit', 2], ',', '"', '@');
        $this->assertSame('1,"php@"unit",2', $csv);
    }

    public function testTrailingNewline(): void
    {
        $csv = str_putcsv([1, "phpunit\r\n", "\n"]);
        $this->assertSame("1,\"phpunit\r\n\",\"\n\"", $csv);
    }

    public function testDecoding(): void
    {
        // str_getcsv does not convert numeric fields to integers.
        $input = ['1', '"php,unit"', 'test'];
        $csv = str_putcsv($input);
        $this->assertSame($input, str_getcsv($csv));
    }
}
