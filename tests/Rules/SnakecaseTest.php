<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Snakecase;
use Intervention\Validation\Validator;
use PHPUnit\Framework\TestCase;

class SnakecaseTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = new Validator([new Snakecase()]);
        $this->assertEquals($result, $validator->validate($value));
    }

    public function dataProvider()
    {
        return [
            [true, 'foo'],
            [true, 'foo_bar'],
            [true, 'foo_bar_baz'],
            [true, 'foo_bar_bâz'],
            [false, 'foo-bar'],
            [false, 'foo_'],
            [false, '_foo'],
            [false, '_foo-'],
            [false, 'fooBar'],
            [false, 'Foo_bar'],
            [false, 'foo_baR'],
        ];
    }
}
