<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Bic;
use PHPUnit\Framework\TestCase;

class BicTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $valid = (new Bic())->isValid($value);
        $this->assertEquals($result, $valid);
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
