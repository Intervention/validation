<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use Intervention\Validation\Rules\CountryCode;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CountryCodeTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidationAlpha2(bool $result, string $value, string $format, bool $strict): void
    {
        $valid = (new CountryCode($format, $strict))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'BS', CountryCode::ALPHA2, true];
        yield [true, 'BW', CountryCode::ALPHA2, true];
        yield [true, 'DE', CountryCode::ALPHA2, true];
        yield [true, 'GR', CountryCode::ALPHA2, true];
        yield [true, 'IT', CountryCode::ALPHA2, true];
        yield [true, 'JP', CountryCode::ALPHA2, true];
        yield [true, 'LU', CountryCode::ALPHA2, true];
        yield [true, 'PL', CountryCode::ALPHA2, true];
        yield [true, 'PL', CountryCode::ALPHA2, true];
        yield [true, 'DE', CountryCode::ALPHA2, false];
        yield [true, 'de', CountryCode::ALPHA2, false];

        yield [true, 'DEU', CountryCode::ALPHA3, true];
        yield [true, 'CAN', CountryCode::ALPHA3, true];
        yield [true, 'AUS', CountryCode::ALPHA3, true];
        yield [true, 'PAK', CountryCode::ALPHA3, true];
        yield [true, 'ERI', CountryCode::ALPHA3, true];
        yield [true, 'ATA', CountryCode::ALPHA3, true];
        yield [true, 'AUT', CountryCode::ALPHA3, true];
        yield [true, 'KOR', CountryCode::ALPHA3, true];
        yield [true, 'CHL', CountryCode::ALPHA3, true];
        yield [true, 'DEU', CountryCode::ALPHA3, false];
        yield [true, 'deu', CountryCode::ALPHA3, false];

        yield [true, '180', CountryCode::NUMERIC, true];
        yield [true, '004', CountryCode::NUMERIC, true];
        yield [true, '440', CountryCode::NUMERIC, true];
        yield [true, '706', CountryCode::NUMERIC, true];
        yield [true, '120', CountryCode::NUMERIC, true];
        yield [true, '312', CountryCode::NUMERIC, true];
        yield [true, '850', CountryCode::NUMERIC, true];
        yield [true, '732', CountryCode::NUMERIC, true];
        yield [true, '203', CountryCode::NUMERIC, true];
        yield [true, '203', CountryCode::NUMERIC, false];

        yield [false, 'XE', CountryCode::ALPHA2, true];
        yield [false, 'BAC', CountryCode::ALPHA2, true];
        yield [false, 'DZA', CountryCode::ALPHA2, true];
        yield [false, 'RG', CountryCode::ALPHA2, true];
        yield [false, 'QX', CountryCode::ALPHA2, true];
        yield [false, 'XX', CountryCode::ALPHA2, true];
        yield [false, 'LP', CountryCode::ALPHA2, true];
        yield [false, 'PU', CountryCode::ALPHA2, true];
        yield [false, 'PZ', CountryCode::ALPHA2, true];
        yield [false, 'de', CountryCode::ALPHA2, true];
        yield [false, '', CountryCode::ALPHA2, true];

        yield [false, 'DEX', CountryCode::ALPHA3, true];
        yield [false, 'CAX', CountryCode::ALPHA3, true];
        yield [false, 'USI', CountryCode::ALPHA3, true];
        yield [false, 'PAC', CountryCode::ALPHA3, true];
        yield [false, 'E3I', CountryCode::ALPHA3, true];
        yield [false, 'ATW', CountryCode::ALPHA3, true];
        yield [false, 'PAA', CountryCode::ALPHA3, true];
        yield [false, 'WWW', CountryCode::ALPHA3, true];
        yield [false, 'DE', CountryCode::ALPHA3, true];
        yield [false, '', CountryCode::ALPHA3, true];

        yield [false, '001', CountryCode::NUMERIC, true];
        yield [false, '002', CountryCode::NUMERIC, true];
        yield [false, '20', CountryCode::NUMERIC, true];
        yield [false, '2', CountryCode::NUMERIC, true];
        yield [false, '0', CountryCode::NUMERIC, true];
        yield [false, '12001', CountryCode::NUMERIC, true];
        yield [false, '994', CountryCode::NUMERIC, true];
        yield [false, '730', CountryCode::NUMERIC, true];
        yield [false, '870', CountryCode::NUMERIC, true];
        yield [false, '18O', CountryCode::NUMERIC, true];
        yield [false, '', CountryCode::NUMERIC, true];
    }
}
