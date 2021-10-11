<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Htmlclean;
use Intervention\Validation\Traits\CanValidate;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class HtmlcleanTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Htmlclean()]]);
        $this->assertEquals($result, $validator->passes());
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
