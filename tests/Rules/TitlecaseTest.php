<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Titlecase;
use PHPUnit\Framework\TestCase;

class TitlecaseTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation($result, $value): void
    {
        $valid = (new Titlecase())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): array
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
