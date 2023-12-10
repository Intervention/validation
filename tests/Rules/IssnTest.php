<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Issn;
use PHPUnit\Framework\TestCase;

class IssnTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $valid = (new Issn())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [true, '2049-3630'],
            [false, '0317-8472'],
            [false, '1982047x'],
            [false, 'DE0005810058'],
            [false, 'ZA9382189201'],
            [false, '2434-561Y'],
            [false, '2434561X'],
            [false, 'foo'],
            [false, '1234-1234'],
        ];
    }
}
