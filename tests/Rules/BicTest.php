<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Bic;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class BicTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = new Validator([new Bic()]);
        $this->assertEquals($result, $validator->validate($value));
    }

    public function dataProvider()
    {
        return [
            [true, 'PBNKDEFF'],
            [true, 'NOLADE21SHO'],
            [false, 'foobar'],
            [false, 'xxx'],
            [false, 'ABNFDBF'],
            [false, 'GR82WEST'],
            [false, '5070081'],
            [false, 'DEUTDBBER'],
        ];
    }
}
