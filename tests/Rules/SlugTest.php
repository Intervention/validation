<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Slug;
use PHPUnit\Framework\TestCase;

final class SlugTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Slug())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
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
