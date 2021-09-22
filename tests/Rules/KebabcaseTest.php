<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Kebabcase;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class KebabcaseTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = new Validator([new Kebabcase()]);
        $this->assertEquals($result, $validator->validate($value));
    }

    public function dataProvider()
    {
        return [
            [true, 'foo'],
            [true, 'foo-bar'],
            [true, 'foo-bar-baz'],
            [true, 'foo-bar-bâz'],
            [false, 'foo_bar'],
            [false, 'foo-'],
            [false, '-foo'],
            [false, '-foo-'],
            [false, 'fooBar'],
            [false, 'Foo-bar'],
            [false, 'foo-baR'],
        ];
    }
}
