<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Hexadecimalcolor;
use PHPUnit\Framework\TestCase;

final class HexadecimalcolorTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Hexadecimalcolor())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderShort')]
    public function testValidationShort($result, $value): void
    {
        $valid = (new Hexadecimalcolor([3]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderLongAlpha')]
    public function testValidationLongAlpha($result, $value): void
    {
        $valid = (new Hexadecimalcolor([8]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderShortAlpha')]
    public function testValidationShortAlpha($result, $value): void
    {
        $valid = (new Hexadecimalcolor([4]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    #[DataProvider('dataProviderLong')]
    public function testValidationLong($result, $value): void
    {
        $valid = (new Hexadecimalcolor([6]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [false, '#'];
        yield [false, 'f'];
        yield [false, 'ff'];
        yield [false, 'x25s11'];
        yield [false, 'fffffffff'];
        yield [true, '#ccc'];
        yield [true, '#cccccc'];
        yield [true, '#ffff'];
        yield [true, '#ffffffff'];
        yield [true, 'abc'];
        yield [true, 'abcabc'];
        yield [true, 'abcabcab'];
        yield [true, 'b33517'];
        yield [true, 'b33517ff'];
        yield [true, 'ccc'];
        yield [true, 'ffff'];
        yield [true, 'f00'];
        yield [true, 'f000'];
    }

    public static function dataProviderShort(): Generator
    {
        yield [false, '#'];
        yield [false, '#cccccc'];
        yield [false, '#ffff'];
        yield [false, 'b33517'];
        yield [false, 'ff'];
        yield [false, 'ffff'];
        yield [false, 'x25s11'];
        yield [false, 'ffffffff'];
        yield [true, '#ccc'];
        yield [true, 'abc'];
        yield [true, 'ccc'];
    }

    public static function dataProviderLong(): Generator
    {
        yield [false, '#'];
        yield [false, '#ccc'];
        yield [false, '#ffff'];
        yield [false, 'abc'];
        yield [false, 'ccc'];
        yield [false, 'ff'];
        yield [false, 'ffff'];
        yield [false, 'x25s11'];
        yield [true, '#cccccc'];
        yield [true, 'b33517'];
    }

    public static function dataProviderShortAlpha(): Generator
    {
        yield [false, '#'];
        yield [false, '#cccccc'];
        yield [false, 'b33517'];
        yield [false, 'ff'];
        yield [false, 'x25s11'];
        yield [false, 'ffffffff'];
        yield [true, 'cccc'];
        yield [true, '0000'];
        yield [true, '#cccc'];
    }

    public static function dataProviderLongAlpha(): Generator
    {
        yield [false, '#'];
        yield [false, '#ccc'];
        yield [false, '#ffff'];
        yield [false, 'abc'];
        yield [false, 'ccc'];
        yield [false, 'ff'];
        yield [false, 'ffff'];
        yield [false, 'x25s11'];
        yield [true, '#cccccccc'];
        yield [true, '00000000'];
        yield [true, 'cccccccc'];
    }
}
