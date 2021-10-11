<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Luhn;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class LuhnTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Luhn()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, '4444111122223333'],
            [true, '9501234400008'],
            [true, '446667651'],
            [true, 446667651],
            [false, '9182819264532375'],
            [false, '12'],
            [false, '5555111122223333'],
            [false, 'xxxxxxxxxxxxxxxx'],
            [false, '4444111I22223333'],
        ];
    }
}
