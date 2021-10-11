<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Snakecase;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class SnakecaseTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Snakecase()]]);
        $this->assertEquals($result, $validator->passes());
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
