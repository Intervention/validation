<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Hexcolor;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class HexcolorTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = new Validator([new Hexcolor()]);
        $this->assertEquals($result, $validator->validate($value));
    }

    /**
     * @dataProvider dataProviderShort
    */
    public function testValidationShort($result, $value)
    {
        $validator = new Validator([new Hexcolor(3)]);
        $this->assertEquals($result, $validator->validate($value));
    }

    /**
     * @dataProvider dataProviderLong
    */
    public function testValidationLong($result, $value)
    {
        $validator = new Validator([new Hexcolor(6)]);
        $this->assertEquals($result, $validator->validate($value));
    }

    public function dataProvider()
    {
        return [
            [true, '#cccccc'],
            [true, 'b33517'],
            [true, '#ccc'],
            [true, 'ccc'],
            [true, 'abc'],
            [false, 'x25s11'],
            [false, 'ffff'],
            [false, '#ffff'],
            [false, 'ff'],
            [false, '#'],
        ];
    }

    public function dataProviderShort()
    {
        return [
            [false, '#cccccc'],
            [false, 'b33517'],
            [true, '#ccc'],
            [true, 'ccc'],
            [true, 'abc'],
            [false, 'x25s11'],
            [false, 'ffff'],
            [false, '#ffff'],
            [false, 'ff'],
            [false, '#'],
        ];
    }

    public function dataProviderLong()
    {
        return [
            [true, '#cccccc'],
            [true, 'b33517'],
            [false, '#ccc'],
            [false, 'ccc'],
            [false, 'abc'],
            [false, 'x25s11'],
            [false, 'ffff'],
            [false, '#ffff'],
            [false, 'ff'],
            [false, '#'],
        ];
    }
}
