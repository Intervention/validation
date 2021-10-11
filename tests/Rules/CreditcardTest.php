<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Creditcard;
use Intervention\Validation\Traits\CanValidate;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class CreditcardTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Creditcard()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, '4444111122223333'],
            [false, '9182819264532375'],
            [false, '12'],
            [false, '5555111122223333'],
            [false, 'xxxxxxxxxxxxxxxx'],
            [false, '4444111I22223333'],
        ];
    }
}
