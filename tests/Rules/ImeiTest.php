<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Imei;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class ImeiTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Imei()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, '355689070069001'],
            [true, '861536030196001'],
            [true, '357631050052050'],
            [true, '357503040704274'],
            [false, '1'],
            [false, '123'],
            [false, '355689070069000'],
            [false, '011536020196001'],
            [false, '352192973771959'],
            [false, '111111111111111'],
            [false, 'ABCDEFGHIJKLMNO'],
            [false, '4444111122223333'],
        ];
    }
}
