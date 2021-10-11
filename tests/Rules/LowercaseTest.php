<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Lowercase;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class LowercaseTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Lowercase()]]);
        $this->assertEquals($result, $validator->passes());
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
