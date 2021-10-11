<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Issn;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class IssnTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Issn()]]);
        $this->assertEquals($result, $validator->passes());
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
