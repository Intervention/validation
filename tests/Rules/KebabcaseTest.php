<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Intervention\Validation\Rules\Kebabcase;
use PHPUnit\Framework\TestCase;

class KebabcaseTest extends TestCase
{
    /**
     * @dataProvider dataProvider
    */
    public function testValidation($result, $value)
    {
        $valid = (new Kebabcase())->isValid($value);
        $this->assertEquals($result, $valid);
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
