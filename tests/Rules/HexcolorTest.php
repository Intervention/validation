<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Hexcolor;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class HexcolorTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Hexcolor()]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderShort
    */
    public function testValidationShort($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Hexcolor(3)]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProviderLong
    */
    public function testValidationLong($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Hexcolor(6)]]);
        $this->assertEquals($result, $validator->passes());
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
