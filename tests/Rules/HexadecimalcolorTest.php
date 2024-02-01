<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Intervention\Validation\Rules\Hexadecimalcolor;
use PHPUnit\Framework\TestCase;

class HexadecimalcolorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $valid = (new Hexadecimalcolor())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    /**
     * @dataProvider dataProviderShort
    */
    public function testValidationShort($result, $value)
    {
        $valid = (new Hexadecimalcolor([3]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    /**
     * @dataProvider dataProviderLongAlpha
    */
    public function testValidationLongAlpha($result, $value)
    {
        $valid = (new Hexadecimalcolor([8]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    /**
     * @dataProvider dataProviderShortAlpha
    */
    public function testValidationShortAlpha($result, $value)
    {
        $valid = (new Hexadecimalcolor([4]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    /**
     * @dataProvider dataProviderLong
    */
    public function testValidationLong($result, $value)
    {
        $valid = (new Hexadecimalcolor([6]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [false, '#'],
            [false, 'f'],
            [false, 'ff'],
            [false, 'x25s11'],
            [false, 'fffffffff'],
            [true, '#ccc'],
            [true, '#cccccc'],
            [true, '#ffff'],
            [true, '#ffffffff'],
            [true, 'abc'],
            [true, 'abcabc'],
            [true, 'abcabcab'],
            [true, 'b33517'],
            [true, 'b33517ff'],
            [true, 'ccc'],
            [true, 'ffff'],
            [true, 'f00'],
            [true, 'f000'],
        ];
    }

    public function dataProviderShort()
    {
        return [
            [false, '#'],
            [false, '#cccccc'],
            [false, '#ffff'],
            [false, 'b33517'],
            [false, 'ff'],
            [false, 'ffff'],
            [false, 'x25s11'],
            [false, 'ffffffff'],
            [true, '#ccc'],
            [true, 'abc'],
            [true, 'ccc'],
        ];
    }

    public function dataProviderLong()
    {
        return [
            [false, '#'],
            [false, '#ccc'],
            [false, '#ffff'],
            [false, 'abc'],
            [false, 'ccc'],
            [false, 'ff'],
            [false, 'ffff'],
            [false, 'x25s11'],
            [true, '#cccccc'],
            [true, 'b33517'],
        ];
    }

    public function dataProviderShortAlpha()
    {
        return [
            [false, '#'],
            [false, '#cccccc'],
            [false, 'b33517'],
            [false, 'ff'],
            [false, 'x25s11'],
            [false, 'ffffffff'],
            [true, 'cccc'],
            [true, '0000'],
            [true, '#cccc'],
        ];
    }

    public function dataProviderLongAlpha()
    {
        return [
            [false, '#'],
            [false, '#ccc'],
            [false, '#ffff'],
            [false, 'abc'],
            [false, 'ccc'],
            [false, 'ff'],
            [false, 'ffff'],
            [false, 'x25s11'],
            [true, '#cccccccc'],
            [true, '00000000'],
            [true, 'cccccccc'],
        ];
    }
}
