<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Cidr;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class CidrTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Cidr()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, '0.0.0.0/0'],
            [true, '10.0.0.0/8'],
            [true, '1.1.1.1/32'],
            [true, '192.168.1.0/24'],
            [true, '192.168.1.1/24'],
            [false, '192.168.1.1'],
            [false, '1.1.1.1/3.14'],
            [false, '1.1.1.1/33'],
            [false, '1.1.1.1/100'],
            [false, '1.1.1.1/-3'],
            [false, '1.1.1/3'],
        ];
    }
}
