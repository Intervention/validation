<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Hexadecimalcolor;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class HexadecimalcolorTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Hexadecimalcolor()]]);
        $this->assertEquals($result, $validator->passes());

        $validator = $this->getValidator(['value' => $value], ['value' => ['hexadecimalcolor']]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderShort
    */
    public function testValidationShort($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Hexadecimalcolor(3)]]);
        $this->assertEquals($result, $validator->passes());

        $validator = $this->getValidator(['value' => $value], ['value' => ['hexadecimalcolor:3']]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderLongAlpha
    */
    public function testValidationLongAlpha($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Hexadecimalcolor(8)]]);
        $this->assertEquals($result, $validator->passes());

        $validator = $this->getValidator(['value' => $value], ['value' => ['hexadecimalcolor:8']]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderShortAlpha
    */
    public function testValidationShortAlpha($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Hexadecimalcolor(4)]]);
        $this->assertEquals($result, $validator->passes());

        $validator = $this->getValidator(['value' => $value], ['value' => ['hexadecimalcolor:4']]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderLong
    */
    public function testValidationLong($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Hexadecimalcolor(6)]]);
        $this->assertEquals($result, $validator->passes());

        $validator = $this->getValidator(['value' => $value], ['value' => ['hexadecimalcolor:6']]);
        $this->assertEquals($result, $validator->passes());
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
