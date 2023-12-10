<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Htmlclean;
use PHPUnit\Framework\TestCase;

class HtmlcleanTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $valid = (new Htmlclean())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public function dataProvider()
    {
        return [
            [true, '123456'],
            [true, '1+2=3'],
            [true, 'The quick brown fox jumps over the lazy dog.'],
            [true, '>>>test'],
            [true, '>test'],
            [true, 'test>'],
            [true, 'attr="test"'],
            [true, 'one < two'],
            [true, 'two>one'],
            [false, 'The quick brown fox jumps <strong>over</strong> the lazy dog.'],
            [false, '<html>'],
            [false, '<HTML>test</HTML>'],
            [false, '<html attr="test">'],
            [false, 'Test</p>'],
            [false, 'Test</>'],
            [false, 'Test<>'],
            [false, '<0>'],
            [false, '<>'],
            [false, '><'],
        ];
    }
}
