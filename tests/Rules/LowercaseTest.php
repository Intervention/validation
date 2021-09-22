<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Lowercase;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class LowercaseTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = new Validator([new Lowercase()]);
        $this->assertEquals($result, $validator->validate($value));
    }

    public function dataProvider()
    {
        return [
            [true, 'a'],
            [true, 'abc'],
            [true, 'ß'],
            [true, 'êçã'],
            [true, 'valid'],
            [true, 'foo bar'],
            [true, 'foo-bar'],
            [true, '!'],
            [true, '?'],
            [true, '9'],
            [true, '#'],
            [false, 'A'],
            [false, 'ABC'],
            [false, 'Ä'],
            [false, 'ÄÖÜ'],
            [false, 'VALID'],
            [false, 'ÇÃÊ'],
        ];
    }
}
