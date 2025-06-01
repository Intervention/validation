<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Titlecase;
use PHPUnit\Framework\TestCase;

final class TitlecaseTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Titlecase())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'Foo'];
        yield [true, 'FooBar'];
        yield [true, 'Foo Bar'];
        yield [true, 'F Bar'];
        yield [true, '6 Bar'];
        yield [true, 'FooBar Baz'];
        yield [true, 'Foo Bar Baz'];
        yield [true, 'Foo-Bar Baz'];
        yield [true, 'Ba_r Baz'];
        yield [true, 'F00 Bar Baz'];
        yield [true, 'Ês Üm Ñõ'];
        yield [false, 'foo'];
        yield [false, 'Foo '];
        yield [false, ' Foo'];
        yield [false, 'Foo bar'];
        yield [false, 'foo bar'];
        yield [false, 'Foo Bar baz'];
        yield [false, 'Foo bar baz'];
        yield [false, '-fooBar'];
        yield [false, '-fooBar-'];
        yield [false, 'The quick brown fox jumps over the lazy dog.'];
    }
}
