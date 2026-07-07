<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use Intervention\Validation\Rules\Iso3166;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class Iso3166Test extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidationAlpha2(bool $result, string $value, string $format): void
    {
        $valid = (new Iso3166($format))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'BS', Iso3166::ALPHA2];
        yield [true, 'BW', Iso3166::ALPHA2];
        yield [true, 'DE', Iso3166::ALPHA2];
        yield [true, 'GR', Iso3166::ALPHA2];
        yield [true, 'IT', Iso3166::ALPHA2];
        yield [true, 'JP', Iso3166::ALPHA2];
        yield [true, 'LU', Iso3166::ALPHA2];
        yield [true, 'PL', Iso3166::ALPHA2];
        yield [true, 'PL', Iso3166::ALPHA2];

        yield [true, 'DEU', Iso3166::ALPHA3];
        yield [true, 'CAN', Iso3166::ALPHA3];
        yield [true, 'AUS', Iso3166::ALPHA3];
        yield [true, 'PAK', Iso3166::ALPHA3];
        yield [true, 'ERI', Iso3166::ALPHA3];
        yield [true, 'ATA', Iso3166::ALPHA3];
        yield [true, 'AUT', Iso3166::ALPHA3];
        yield [true, 'KOR', Iso3166::ALPHA3];
        yield [true, 'CHL', Iso3166::ALPHA3];

        yield [true, '180', Iso3166::NUMERIC];
        yield [true, '004', Iso3166::NUMERIC];
        yield [true, '440', Iso3166::NUMERIC];
        yield [true, '706', Iso3166::NUMERIC];
        yield [true, '120', Iso3166::NUMERIC];
        yield [true, '312', Iso3166::NUMERIC];
        yield [true, '850', Iso3166::NUMERIC];
        yield [true, '732', Iso3166::NUMERIC];
        yield [true, '203', Iso3166::NUMERIC];

        yield [false, 'XE', Iso3166::ALPHA2];
        yield [false, 'BAC', Iso3166::ALPHA2];
        yield [false, 'DZA', Iso3166::ALPHA2];
        yield [false, 'RG', Iso3166::ALPHA2];
        yield [false, 'QX', Iso3166::ALPHA2];
        yield [false, 'XX', Iso3166::ALPHA2];
        yield [false, 'LP', Iso3166::ALPHA2];
        yield [false, 'PU', Iso3166::ALPHA2];
        yield [false, 'PZ', Iso3166::ALPHA2];
        yield [false, 'de', Iso3166::ALPHA2];
        yield [false, '', Iso3166::ALPHA2];

        yield [false, 'DEX', Iso3166::ALPHA3];
        yield [false, 'CAX', Iso3166::ALPHA3];
        yield [false, 'USI', Iso3166::ALPHA3];
        yield [false, 'PAC', Iso3166::ALPHA3];
        yield [false, 'E3I', Iso3166::ALPHA3];
        yield [false, 'ATW', Iso3166::ALPHA3];
        yield [false, 'PAA', Iso3166::ALPHA3];
        yield [false, 'WWW', Iso3166::ALPHA3];
        yield [false, 'DE', Iso3166::ALPHA3];
        yield [false, '', Iso3166::ALPHA3];

        yield [false, '001', Iso3166::NUMERIC];
        yield [false, '002', Iso3166::NUMERIC];
        yield [false, '20', Iso3166::NUMERIC];
        yield [false, '2', Iso3166::NUMERIC];
        yield [false, '0', Iso3166::NUMERIC];
        yield [false, '12001', Iso3166::NUMERIC];
        yield [false, '994', Iso3166::NUMERIC];
        yield [false, '730', Iso3166::NUMERIC];
        yield [false, '870', Iso3166::NUMERIC];
        yield [false, '18O', Iso3166::NUMERIC];
        yield [false, '', Iso3166::NUMERIC];
    }
}
