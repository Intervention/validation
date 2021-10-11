<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Kebabcase;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class KebabcaseTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Kebabcase()]]);
        $this->assertEquals($result, $validator->passes());
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
