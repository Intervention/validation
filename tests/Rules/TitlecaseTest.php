<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Titlecase;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class TitlecaseTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Titlecase()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, 'Foo'],
            [true, 'FooBar'],
            [true, 'Foo Bar'],
            [true, 'F Bar'],
            [true, '6 Bar'],
            [true, 'FooBar Baz'],
            [true, 'Foo Bar Baz'],
            [true, 'Foo-Bar Baz'],
            [true, 'Ba_r Baz'],
            [true, 'F00 Bar Baz'],
            [true, 'Ês Üm Ñõ'],
            [false, 'foo'],
            [false, 'Foo '],
            [false, ' Foo'],
            [false, 'Foo bar'],
            [false, 'foo bar'],
            [false, 'Foo Bar baz'],
            [false, 'Foo bar baz'],
            [false, '-fooBar'],
            [false, '-fooBar-'],
            [false, 'The quick brown fox jumps over the lazy dog.'],
        ];
    }
}
