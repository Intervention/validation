<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Uppercase;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class UppercaseTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = new Validator([new Uppercase()]);
        $this->assertEquals($result, $validator->validate($value));
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
