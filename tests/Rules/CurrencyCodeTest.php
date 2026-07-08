<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use Intervention\Validation\Rules\CurrencyCode;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CurrencyCodeTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidationAlpha2(bool $result, string $value, string $format, bool $strict): void
    {
        $valid = (new CurrencyCode($format, $strict))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'EUR', CurrencyCode::ALPHA, true];
        yield [true, 'USD', CurrencyCode::ALPHA, true];
        yield [true, 'CHF', CurrencyCode::ALPHA, true];
        yield [true, 'HNL', CurrencyCode::ALPHA, true];
        yield [true, 'EUR', CurrencyCode::ALPHA, false];
        yield [true, 'USD', CurrencyCode::ALPHA, false];
        yield [true, 'CHF', CurrencyCode::ALPHA, false];
        yield [true, 'HNL', CurrencyCode::ALPHA, false];
        yield [true, 'eur', CurrencyCode::ALPHA, false];
        yield [true, 'usd', CurrencyCode::ALPHA, false];
        yield [true, 'chf', CurrencyCode::ALPHA, false];
        yield [true, 'hnl', CurrencyCode::ALPHA, false];
        yield [false, 'EURO', CurrencyCode::ALPHA, true];
        yield [false, 'US', CurrencyCode::ALPHA, true];
        yield [false, 'CHFR', CurrencyCode::ALPHA, true];
        yield [false, 'AOL', CurrencyCode::ALPHA, true];
        yield [false, 'euro', CurrencyCode::ALPHA, false];

        yield [true, '400', CurrencyCode::NUMERIC, true];
        yield [true, '344', CurrencyCode::NUMERIC, true];
        yield [true, '600', CurrencyCode::NUMERIC, true];
        yield [false, '1', CurrencyCode::NUMERIC, true];
        yield [false, '100', CurrencyCode::NUMERIC, true];
        yield [false, '666', CurrencyCode::NUMERIC, true];
        yield [false, '1', CurrencyCode::NUMERIC, false];
        yield [false, '100', CurrencyCode::NUMERIC, false];
        yield [false, '666', CurrencyCode::NUMERIC, false];
    }
}
