<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Slug;
use PHPUnit\Framework\TestCase;

final class SlugTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Slug())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'foo'];
        yield [true, 'foo-bar'];
        yield [true, 'foo-bar-baz'];
        yield [true, 'Foo-Bar'];
        yield [true, 'FOO-BAR'];
        yield [true, 'FOO-123'];
        yield [true, '1-3'];
        yield [true, 'f'];
        yield [true, 'f-o-o'];
        yield [true, '0'];
        yield [false, '-foo'];
        yield [false, 'foo-'];
        yield [false, '-foo-bar-'];
        yield [false, 'f--o'];
        yield [false, '-'];
        yield [false, 'foo bar'];
        yield [false, 'foo%20bar'];
        yield [false, 'foo+bar'];
        yield [false, 'foo_bar'];
        yield [false, 'foo '];
        yield [false, ' foo'];
        yield [false, '?'];
        yield [false, 'föö'];
    }
}
