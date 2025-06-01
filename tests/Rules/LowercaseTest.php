<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Lowercase;
use PHPUnit\Framework\TestCase;

final class LowercaseTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new Lowercase())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'a'];
        yield [true, 'abc'];
        yield [true, 'ß'];
        yield [true, 'êçã'];
        yield [true, 'valid'];
        yield [true, 'foo bar'];
        yield [true, 'foo-bar'];
        yield [true, '!'];
        yield [true, '?'];
        yield [true, '9'];
        yield [true, '#'];
        yield [false, 'A'];
        yield [false, 'ABC'];
        yield [false, 'Ä'];
        yield [false, 'ÄÖÜ'];
        yield [false, 'VALID'];
        yield [false, 'ÇÃÊ'];
    }
}
