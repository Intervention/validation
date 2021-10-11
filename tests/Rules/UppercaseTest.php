<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Uppercase;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class UppercaseTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Uppercase()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, 'A'],
            [true, 'ABC'],
            [true, 'Ä'],
            [true, 'ÄÖÜ'],
            [true, 'VALID'],
            [true, 'ÇÃÊ'],
            [true, '123'],
            [true, 'A1'],
            [true, '_'],
            [true, '!'],
            [true, 'A-B'],
            [true, 'A B'],
            [true, '?'],
            [true, '#'],
            [true, 'FOO BAR'],
            [false, 'a'],
            [false, 'foo bar'],
            [false, 'fooß'],
            [false, 'abc'],
            [false, 'äöü'],
            [false, '(a)'],
        ];
    }
}
