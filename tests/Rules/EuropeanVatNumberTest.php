<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use Intervention\Validation\Rules\EuropeanVatNumber;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class EuropeanVatNumberTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidation(bool $result, string $value): void
    {
        $valid = (new EuropeanVatNumber())->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [true, 'ATU12345678'];
        yield [true, 'BE0123456789'];
        yield [true, 'BE1234567890'];
        yield [true, 'BG123456789'];
        yield [true, 'BG1234567890'];
        yield [true, 'CY12345678A'];
        yield [true, 'CZ12345678'];
        yield [true, 'CZ123456789'];
        yield [true, 'CZ1234567890'];
        yield [true, 'DE123456789'];
        yield [true, 'DK12345678'];
        yield [true, 'DK12 34 56 78'];
        yield [true, 'EE123456789'];
        yield [true, 'EL123456789'];
        yield [true, 'ESA12345678'];
        yield [true, 'ES12345678A'];
        yield [true, 'ESA1234567B'];
        yield [true, 'FI12345678'];
        yield [true, 'FR12123456789'];
        yield [true, 'FRAA123456789'];
        yield [true, 'GB123456789'];
        yield [true, 'GB123456789012'];
        yield [true, 'GBGD123'];
        yield [true, 'GBHA123'];
        yield [true, 'HR12345678901'];
        yield [true, 'HU12345676'];
        yield [true, 'IE1234567A'];
        yield [true, 'IE1A234567B'];
        yield [true, 'IT02182030391'];
        yield [true, 'LT123456789'];
        yield [true, 'LT123456789012'];
        yield [true, 'LU12345678'];
        yield [true, 'LV12345678901'];
        yield [true, 'MT12345678'];
        yield [true, 'NL123456789B01'];
        yield [true, 'PL1234567890'];
        yield [true, 'PT123456789'];
        yield [true, 'RO12'];
        yield [true, 'RO1234567890'];
        yield [true, 'SE123456789012'];
        yield [true, 'SI12345678'];
        yield [true, 'SK1234567890'];
        yield [true, 'CHE123456789MWST'];
        yield [true, 'CHE123456789TVA'];
        yield [true, 'CHE123456789IVA'];
        yield [true, 'CH123456'];
        yield [true, ' de123456789 '];
        yield [false, 'foobar'];
        yield [false, 'XX123456789'];
        yield [false, 'DE12345678'];
        yield [false, 'DE1234567890'];
        yield [false, 'AT12345678'];
        yield [false, 'ATU1234567'];
        yield [false, 'NL123456789B1'];
        yield [false, 'IT12345678901'];
        yield [false, 'HU12345678'];
        yield [false, ''];
    }
}
