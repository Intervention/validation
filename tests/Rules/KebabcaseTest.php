<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Kebabcase;
use PHPUnit\Framework\TestCase;

final class KebabcaseTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Kebabcase())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'foo'];
        yield [true, 'foo-bar'];
        yield [true, 'foo-bar-baz'];
        yield [true, 'foo-bar-bâz'];
        yield [false, 'foo_bar'];
        yield [false, 'foo-'];
        yield [false, '-foo'];
        yield [false, '-foo-'];
        yield [false, 'fooBar'];
        yield [false, 'Foo-bar'];
        yield [false, 'foo-baR'];
    }
}
