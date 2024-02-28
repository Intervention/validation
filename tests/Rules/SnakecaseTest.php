<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Snakecase;
use PHPUnit\Framework\TestCase;

class SnakecaseTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value)
    {
        $valid = (new Snakecase())->isValid($value);
        $this->assertEquals($result, $valid);
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
