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
    public function testValidationAlpha2(bool $result, string $value, string $format): void
    {
        $valid = (new CountryCode($format))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'BS', CountryCode::ALPHA2];
        yield [true, 'BW', CountryCode::ALPHA2];
        yield [true, 'DE', CountryCode::ALPHA2];
        yield [true, 'GR', CountryCode::ALPHA2];
        yield [true, 'IT', CountryCode::ALPHA2];
        yield [true, 'JP', CountryCode::ALPHA2];
        yield [true, 'LU', CountryCode::ALPHA2];
        yield [true, 'PL', CountryCode::ALPHA2];
        yield [true, 'PL', CountryCode::ALPHA2];

        yield [true, 'DEU', CountryCode::ALPHA3];
        yield [true, 'CAN', CountryCode::ALPHA3];
        yield [true, 'AUS', CountryCode::ALPHA3];
        yield [true, 'PAK', CountryCode::ALPHA3];
        yield [true, 'ERI', CountryCode::ALPHA3];
        yield [true, 'ATA', CountryCode::ALPHA3];
        yield [true, 'AUT', CountryCode::ALPHA3];
        yield [true, 'KOR', CountryCode::ALPHA3];
        yield [true, 'CHL', CountryCode::ALPHA3];

        yield [true, '180', CountryCode::NUMERIC];
        yield [true, '004', CountryCode::NUMERIC];
        yield [true, '440', CountryCode::NUMERIC];
        yield [true, '706', CountryCode::NUMERIC];
        yield [true, '120', CountryCode::NUMERIC];
        yield [true, '312', CountryCode::NUMERIC];
        yield [true, '850', CountryCode::NUMERIC];
        yield [true, '732', CountryCode::NUMERIC];
        yield [true, '203', CountryCode::NUMERIC];

        yield [false, 'XE', CountryCode::ALPHA2];
        yield [false, 'BAC', CountryCode::ALPHA2];
        yield [false, 'DZA', CountryCode::ALPHA2];
        yield [false, 'RG', CountryCode::ALPHA2];
        yield [false, 'QX', CountryCode::ALPHA2];
        yield [false, 'XX', CountryCode::ALPHA2];
        yield [false, 'LP', CountryCode::ALPHA2];
        yield [false, 'PU', CountryCode::ALPHA2];
        yield [false, 'PZ', CountryCode::ALPHA2];
        yield [false, 'de', CountryCode::ALPHA2];
        yield [false, '', CountryCode::ALPHA2];

        yield [false, 'DEX', CountryCode::ALPHA3];
        yield [false, 'CAX', CountryCode::ALPHA3];
        yield [false, 'USI', CountryCode::ALPHA3];
        yield [false, 'PAC', CountryCode::ALPHA3];
        yield [false, 'E3I', CountryCode::ALPHA3];
        yield [false, 'ATW', CountryCode::ALPHA3];
        yield [false, 'PAA', CountryCode::ALPHA3];
        yield [false, 'WWW', CountryCode::ALPHA3];
        yield [false, 'DE', CountryCode::ALPHA3];
        yield [false, '', CountryCode::ALPHA3];

        yield [false, '001', CountryCode::NUMERIC];
        yield [false, '002', CountryCode::NUMERIC];
        yield [false, '20', CountryCode::NUMERIC];
        yield [false, '2', CountryCode::NUMERIC];
        yield [false, '0', CountryCode::NUMERIC];
        yield [false, '12001', CountryCode::NUMERIC];
        yield [false, '994', CountryCode::NUMERIC];
        yield [false, '730', CountryCode::NUMERIC];
        yield [false, '870', CountryCode::NUMERIC];
        yield [false, '18O', CountryCode::NUMERIC];
        yield [false, '', CountryCode::NUMERIC];
    }
}
