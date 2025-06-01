<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Snakecase;
use PHPUnit\Framework\TestCase;

final class SnakecaseTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Snakecase())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'foo'];
        yield [true, 'foo_bar'];
        yield [true, 'foo_bar_baz'];
        yield [true, 'foo_bar_bâz'];
        yield [false, 'foo-bar'];
        yield [false, 'foo_'];
        yield [false, '_foo'];
        yield [false, '_foo-'];
        yield [false, 'fooBar'];
        yield [false, 'Foo_bar'];
        yield [false, 'foo_baR'];
    }
}
