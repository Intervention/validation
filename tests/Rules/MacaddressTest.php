<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Macaddress;
use Intervention\Validation\Traits\CanValidate;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class MacaddressTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Macaddress()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, '00:80:41:ae:fd:7e'],
            [true, '12-34-56-78-9A-BC'],
            [true, '12-34-56-78-9a-bc'],
            [true, '008041aefd7e'],
            [true, '0080.41ae.fd7e'],
            [true, '008041-aefd7e'],
            [true, '00-80-41-ae-fd-7e'],
            [true, 'A1:B2-C3:D4-E5:F6'],
            [true, '00-07-E9-cc-b2-dd'],
            [true, '00 07 E9 cc b2 dd'],
            [true, '000000000000'],
            [false, 'A1xB2xC3xD4xE5xFA'],
            [false, 'A1:B2-C3:D4-E5:FX'],
            [false, '0000000000000'],
            [false, '123456'],
            [false, 'XXX'],
            [false, 'XXXXXXXXXXXX'],
        ];
    }
}
