<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Slug;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Slug()]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [true, 'foo'],
            [true, 'foo-bar'],
            [true, 'foo-bar-baz'],
            [true, 'Foo-Bar'],
            [true, 'FOO-BAR'],
            [true, 'FOO-123'],
            [true, '1-3'],
            [true, 'f'],
            [true, 'f-o-o'],
            [true, '0'],
            [false, '-foo'],
            [false, 'foo-'],
            [false, '-foo-bar-'],
            [false, 'f--o'],
            [false, '-'],
            [false, 'foo bar'],
            [false, 'foo%20bar'],
            [false, 'foo+bar'],
            [false, 'foo_bar'],
            [false, 'foo '],
            [false, ' foo'],
            [false, '?'],
            [false, 'föö'],
        ];
    }
}
