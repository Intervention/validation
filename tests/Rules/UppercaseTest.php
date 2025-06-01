<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Uppercase;
use PHPUnit\Framework\TestCase;

final class UppercaseTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Uppercase())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'A'];
        yield [true, 'ABC'];
        yield [true, 'Ä'];
        yield [true, 'ÄÖÜ'];
        yield [true, 'VALID'];
        yield [true, 'ÇÃÊ'];
        yield [true, '123'];
        yield [true, 'A1'];
        yield [true, '_'];
        yield [true, '!'];
        yield [true, 'A-B'];
        yield [true, 'A B'];
        yield [true, '?'];
        yield [true, '#'];
        yield [true, 'FOO BAR'];
        yield [false, 'a'];
        yield [false, 'foo bar'];
        yield [false, 'fooß'];
        yield [false, 'abc'];
        yield [false, 'äöü'];
        yield [false, '(a)'];
    }
}
