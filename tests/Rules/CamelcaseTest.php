<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Camelcase;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class CamelcaseTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = new Validator([new Camelcase()]);
        $this->assertEquals($result, $validator->validate($value));
    }

    public function dataProvider()
    {
        return [
            [true, 'foo'],
            [true, 'Foo'],
            [true, 'fooBar'],
            [true, 'fooBarBaz'],
            [true, 'fooBarBâz'],
            [true, 'fOo'],
            [true, 'PostScript'],
            [true, 'iPhone'],
            [false, 'foobaR'],
            [false, 'FoobaR'],
            [false, 'FOo'],
            [false, 'FOO'],
            [false, 'fo0bar'],
            [false, '-fooBar'],
            [false, '-fooBar-'],
        ];
    }
}
