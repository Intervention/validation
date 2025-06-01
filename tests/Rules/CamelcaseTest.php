<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Camelcase;
use PHPUnit\Framework\TestCase;

final class CamelcaseTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Camelcase())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'foo'];
        yield [true, 'Foo'];
        yield [true, 'fooBar'];
        yield [true, 'fooBarBaz'];
        yield [true, 'fooBarBâz'];
        yield [true, 'fOo'];
        yield [true, 'PostScript'];
        yield [true, 'iPhone'];
        yield [false, 'foobaR'];
        yield [false, 'FoobaR'];
        yield [false, 'FOo'];
        yield [false, 'FOO'];
        yield [false, 'fo0bar'];
        yield [false, '-fooBar'];
        yield [false, '-fooBar-'];
    }
}
