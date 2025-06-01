<?php

declare(strict_types=1);

namespace Intervention\Validation\Tests\Rules;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use Intervention\Validation\Rules\Postalcode;
use PHPUnit\Framework\TestCase;

final class PostalcodeTest extends TestCase
{
    #[DataProvider('dataProvider')]
    public function testValidationConstructor(bool $result, string $countrycode, string $value): void
    {
        $valid = (new Postalcode([$countrycode]))->isValid($value);
        $this->assertEquals($result, $valid);
    }

    public static function dataProvider(): Generator
    {
        yield [false, 'non-existing-country-code', '0'];
        yield [true, 'de', '44141'];
        yield [true, 'de', '25746'];
        yield [false, 'de', '2240'];
        yield [false, 'de', '123456'];
        yield [true, 'dz', '44141'];
        yield [true, 'dz', '25746'];
        yield [false, 'dz', '2240'];
        yield [false, 'dz', '123456'];
        yield [true, 'as', '44141'];
        yield [true, 'as', '25746'];
        yield [false, 'as', '2240'];
        yield [false, 'as', '123456'];
        yield [true, 'ad', '44141'];
        yield [true, 'ad', '25746'];
        yield [false, 'ad', '2240'];
        yield [false, 'ad', '123456'];
        yield [true, 'ar', '4414'];
        yield [true, 'ar', '2574'];
        yield [false, 'ar', '224'];
        yield [false, 'ar', '12345'];
        yield [true, 'am', '4414'];
        yield [true, 'am', '2574'];
        yield [false, 'am', '224'];
        yield [false, 'am', '12345'];
        yield [true, 'au', '4414'];
        yield [true, 'au', '2574'];
        yield [false, 'au', '224'];
        yield [false, 'au', '12345'];
        yield [true, 'at', '4414'];
        yield [true, 'at', '2574'];
        yield [false, 'at', '224'];
        yield [false, 'at', '12345'];

        yield [true, 'az', '1234'];
        yield [true, 'az', '123456'];
        yield [false, 'az', '12345'];
        yield [false, 'az', '224'];
        yield [false, 'az', '1234567'];

        yield [true, 'bd', '4414'];
        yield [true, 'bd', '2574'];
        yield [false, 'bd', '224'];
        yield [false, 'bd', '12345'];

        yield [true, 'by', '123456'];
        yield [false, 'by', '12345'];
        yield [false, 'by', '1234567'];

        yield [true, 'be', '1234'];
        yield [false, 'be', '123'];
        yield [false, 'be', '12345'];

        yield [true, 'ba', '12345'];
        yield [false, 'ba', '1234'];
        yield [false, 'ba', '123456'];

        yield [true, 'br', '12345'];
        yield [false, 'br', '1234'];
        yield [false, 'br', '123456'];
        yield [true, 'br', '12345678'];
        yield [false, 'br', '123456789'];
        yield [false, 'br', '1234567'];
        yield [true, 'br', '12345-123'];
        yield [false, 'br', '1234-123'];
        yield [false, 'br', '12345-12'];

        yield [true, 'bn', 'AA1234'];
        yield [false, 'bn', '001234'];
        yield [false, 'bn', 'AAAAAA'];
        yield [false, 'bn', 'A1234'];
        yield [false, 'bn', 'AA123'];
        yield [false, 'bn', 'AAA1234'];
        yield [false, 'bn', 'AA12345'];

        yield [true, 'bg', '1234'];
        yield [false, 'bg', '123'];
        yield [false, 'bg', '12345'];

        yield [true, 'ca', 'A9A 9A9'];
        yield [true, 'ca', 'A9A 9A'];
        yield [false, 'ca', '9A9 A9A'];
        yield [false, 'ca', '9A9 A9'];
        yield [false, 'ca', 'A9A9A9'];
        yield [false, 'ca', 'A9A9A'];
        yield [false, 'ca', 'AAA 9A9'];
        yield [false, 'ca', 'AAA 9A'];
        yield [false, 'ca', '999 9A9'];
        yield [false, 'ca', 'A9A 99'];
        yield [false, 'ca', 'A9A 9A99'];
        yield [false, 'ca', '99999'];
        yield [false, 'ca', '9999'];

        yield [true, 'ic', '12345'];
        yield [false, 'ic', '1234'];
        yield [false, 'ic', '123456'];

        yield [true, 'cn', '123456'];
        yield [false, 'cn', '12345'];
        yield [false, 'cn', '1234567'];

        yield [true, 'mp', '12345'];
        yield [false, 'mp', '1234'];
        yield [false, 'mp', '123456'];

        yield [true, 'hr', '12345'];
        yield [false, 'hr', '1234'];
        yield [false, 'hr', '123456'];

        yield [true, 'cu', '12345'];
        yield [false, 'cu', '1234'];
        yield [false, 'cu', '123456'];

        yield [true, 'cy', '1234'];
        yield [false, 'cy', '123'];
        yield [false, 'cy', '12345'];

        yield [true, 'cz', '123 45'];
        yield [false, 'cz', '12345'];
        yield [false, 'cz', '12 345'];
        yield [false, 'cz', '1234'];
        yield [false, 'cz', '1234 56'];
        yield [false, 'cz', '123 456'];

        yield [true, 'gr', '123 45'];
        yield [false, 'gr', '12345'];
        yield [false, 'gr', '12 345'];
        yield [false, 'gr', '1234'];
        yield [false, 'gr', '1234 56'];
        yield [false, 'gr', '123 456'];

        yield [true, 'dk', '1234'];
        yield [false, 'dk', '123'];
        yield [false, 'dk', '12345'];

        yield [true, 'ec', '123456'];
        yield [false, 'ec', '12345'];
        yield [false, 'ec', '1234567'];

        yield [true, 'ee', '12345'];
        yield [false, 'ee', '1234'];
        yield [false, 'ee', '123456'];

        yield [true, 'fo', '123'];
        yield [false, 'fo', '1234'];
        yield [false, 'fo', '12'];
        yield [false, 'fo', '1245'];

        yield [true, 'fi', '12345'];
        yield [false, 'fi', '1234'];
        yield [false, 'fi', '123456'];

        yield [true, 'fr', '12345'];
        yield [false, 'fr', '1234'];
        yield [false, 'fr', '123456'];

        yield [true, 'gf', '12345'];
        yield [false, 'gf', '1234'];
        yield [false, 'gf', '123456'];

        yield [true, 'ge', '1234'];
        yield [false, 'ge', '123'];
        yield [false, 'ge', '12345'];

        yield [true, 'gl', '1234'];
        yield [false, 'gl', '123'];
        yield [false, 'gl', '12345'];

        yield [true, 'gp', '12345'];
        yield [false, 'gp', '1234'];
        yield [false, 'gp', '123456'];

        yield [true, 'gu', '12345'];
        yield [false, 'gu', '1234'];
        yield [false, 'gu', '123456'];

        yield [true, 'gg', 'AA9 9AA'];
        yield [true, 'gg', 'aa9 9aa'];
        yield [true, 'gg', 'AA99 9AA'];
        yield [true, 'gg', 'aa99 9aa'];
        yield [false, 'gg', 'AA99AA'];
        yield [false, 'gg', 'AA9 99AA'];
        yield [false, 'gg', '123 1234'];
        yield [false, 'gg', '123456'];
        yield [false, 'gg', '12345'];
        yield [false, 'gg', '1234'];
        yield [false, 'gg', '123'];

        yield [true, 'hu', '1234'];
        yield [false, 'hu', '123'];
        yield [false, 'hu', '12345'];

        yield [true, 'is', '123'];
        yield [false, 'is', '12'];
        yield [false, 'is', '1234'];

        yield [true, 'in', '123456'];
        yield [false, 'in', '12345'];
        yield [false, 'in', '1234567'];

        yield [true, 'id', '12345'];
        yield [false, 'id', '1234'];
        yield [false, 'id', '123456'];

        yield [true, 'il', '12345'];
        yield [true, 'il', '1234567'];
        yield [false, 'il', '123456'];
        yield [false, 'il', '1234'];
        yield [false, 'il', '123'];
        yield [false, 'il', '12345678'];

        yield [true, 'it', '12345'];
        yield [false, 'it', '1234'];
        yield [false, 'it', '123456'];

        yield [true, 'jp', '123-4567'];
        yield [false, 'jp', '1234567'];
        yield [false, 'jp', '12-4567'];
        yield [false, 'jp', '123-456'];
        yield [false, 'jp', '1234-4567'];
        yield [false, 'jp', '123-45678'];
        yield [false, 'jp', '12345'];
        yield [false, 'jp', '123-456-7'];

        yield [true, 'je', 'AA9 9AA'];
        yield [true, 'je', 'aa9 9aa'];
        yield [true, 'je', 'AA99 9AA'];
        yield [true, 'je', 'aa99 9aa'];
        yield [false, 'je', 'AA99AA'];
        yield [false, 'je', 'AA9 99AA'];
        yield [false, 'je', '123 1234'];
        yield [false, 'je', '123456'];
        yield [false, 'je', '12345'];
        yield [false, 'je', '1234'];
        yield [false, 'je', '123'];

        yield [true, 'kz', '123456'];
        yield [false, 'kz', '12345'];
        yield [false, 'kz', '1234567'];

        yield [true, 'kr', '12345'];
        yield [false, 'kr', '1234'];
        yield [false, 'kr', '123456'];

        yield [true, 'kv', '12345'];
        yield [false, 'kv', '1234'];
        yield [false, 'kv', '123456'];

        yield [true, 'kg', '123456'];
        yield [false, 'kg', '12345'];
        yield [false, 'kg', '1234567'];

        yield [true, 'lv', '1234'];
        yield [false, 'lv', '123'];
        yield [false, 'lv', '12345'];

        yield [true, 'li', '1234'];
        yield [false, 'li', '123'];
        yield [false, 'li', '12345'];

        yield [true, 'lt', '12345'];
        yield [false, 'lt', '1234'];
        yield [false, 'lt', '123456'];

        yield [true, 'lu', '1234'];
        yield [false, 'lu', '123'];
        yield [false, 'lu', '12345'];

        yield [true, 'mk', '1234'];
        yield [false, 'mk', '123'];
        yield [false, 'mk', '12345'];

        yield [true, 'mg', '123'];
        yield [false, 'mg', '12'];
        yield [false, 'mg', '1234'];

        yield [true, 'my', '12345'];
        yield [false, 'my', '1234'];
        yield [false, 'my', '123456'];

        yield [true, 'mv', '12345'];
        yield [true, 'mv', '1234'];
        yield [false, 'mv', '123'];
        yield [false, 'mv', '123456'];

        yield [true, 'mh', '12345'];
        yield [false, 'mh', '1234'];
        yield [false, 'mh', '123456'];

        yield [true, 'mq', '12345'];
        yield [false, 'mq', '1234'];
        yield [false, 'mq', '123456'];

        yield [true, 'yt', '12345'];
        yield [false, 'yt', '1234'];
        yield [false, 'yt', '123456'];

        yield [true, 'mx', '12345'];
        yield [true, 'mx', '1234'];
        yield [false, 'mx', '123'];
        yield [false, 'mx', '123456'];

        yield [true, 'fm', '12345'];
        yield [false, 'fm', '1234'];
        yield [false, 'fm', '123456'];

        yield [true, 'md', '1234'];
        yield [false, 'md', '123'];
        yield [false, 'md', '12345'];

        yield [true, 'mc', '12345'];
        yield [false, 'mc', '1234'];
        yield [false, 'mc', '123456'];

        yield [true, 'mn', '12345'];
        yield [true, 'mn', '123456'];
        yield [false, 'mn', '1234'];
        yield [false, 'mn', '1234567'];

        yield [true, 'me', '12345'];
        yield [false, 'me', '1234'];
        yield [false, 'me', '123456'];

        yield [true, 'ma', '12345'];
        yield [false, 'ma', '1234'];
        yield [false, 'ma', '123456'];

        yield [true, 'nl', '1234 AA'];
        yield [true, 'nl', '1234 aa'];
        yield [true, 'nl', '1234AA'];
        yield [false, 'nl', '1234'];
        yield [false, 'nl', '123 AA'];
        yield [false, 'nl', '1234 AAA'];
        yield [false, 'nl', '12345'];
        yield [false, 'nl', '123'];
        yield [false, 'nl', '1234-AA'];
        yield [false, 'nl', '123456'];

        yield [true, 'nc', '12345'];
        yield [false, 'nc', '1234'];
        yield [false, 'nc', '123456'];

        yield [true, 'nz', '1234'];
        yield [false, 'nz', '123'];
        yield [false, 'nz', '12345'];

        yield [true, 'no', '1234'];
        yield [false, 'no', '123'];
        yield [false, 'no', '12345'];

        yield [true, 'pk', '12345'];
        yield [false, 'pk', '1234'];
        yield [false, 'pk', '123456'];

        yield [true, 'pw', '12345'];
        yield [false, 'pw', '1234'];
        yield [false, 'pw', '123456'];

        yield [true, 'pg', '123'];
        yield [false, 'pg', '12'];
        yield [false, 'pg', '1234'];

        yield [true, 'ph', '1234'];
        yield [false, 'ph', '123'];
        yield [false, 'ph', '12345'];

        yield [true, 'pl', '12-345'];
        yield [false, 'pl', '12345'];
        yield [false, 'pl', '123-345'];
        yield [false, 'pl', '12-3456'];
        yield [false, 'pl', '1-345'];
        yield [false, 'pl', '12-34'];
        yield [false, 'pl', '1234'];
        yield [false, 'pl', '123456'];

        yield [true, 'pt', '1234'];
        yield [true, 'pt', '1234-123'];
        yield [false, 'pt', '12345-123'];
        yield [false, 'pt', '1234-12'];
        yield [false, 'pt', '12345-123'];
        yield [false, 'pt', '1234-1234'];
        yield [false, 'pt', '1234123'];

        yield [true, 'pr', '12345'];
        yield [false, 'pr', '1234'];
        yield [false, 'pr', '123456'];

        yield [true, 're', '12345'];
        yield [false, 're', '1234'];
        yield [false, 're', '123456'];

        yield [true, 'ro', '123456'];
        yield [false, 'ro', '12345'];
        yield [false, 'ro', '1234567'];

        yield [true, 'ru', '123456'];
        yield [false, 'ru', '12345'];
        yield [false, 'ru', '1234567'];

        yield [true, 'sg', '123456'];
        yield [false, 'sg', '12345'];
        yield [false, 'sg', '1234567'];

        yield [true, 'sm', '12345'];
        yield [false, 'sm', '1234'];
        yield [false, 'sm', '123456'];

        yield [true, 'rs', '12345'];
        yield [false, 'rs', '1234'];
        yield [false, 'rs', '123456'];

        yield [true, 'sk', '123 45'];
        yield [false, 'sk', '12345'];
        yield [false, 'sk', '12 345'];
        yield [false, 'sk', '1234'];
        yield [false, 'sk', '1234 56'];
        yield [false, 'sk', '123 456'];

        yield [true, 'si', '1234'];
        yield [false, 'si', '123'];
        yield [false, 'si', '12345'];

        yield [true, 'za', '1234'];
        yield [false, 'za', '123'];
        yield [false, 'za', '12345'];

        yield [true, 'es', '12345'];
        yield [false, 'es', '1234'];
        yield [false, 'es', '123456'];

        yield [true, 'xy', '12345'];
        yield [false, 'xy', '1234'];
        yield [false, 'xy', '123456'];

        yield [true, 'se', '123 45'];
        yield [false, 'se', '12345'];
        yield [false, 'se', '12 345'];
        yield [false, 'se', '1234'];
        yield [false, 'se', '1234 56'];
        yield [false, 'se', '123 456'];

        yield [true, 'sz', 'A123'];
        yield [true, 'sz', 'a123'];
        yield [false, 'sz', '1234'];
        yield [false, 'sz', 'A-123'];
        yield [false, 'sz', 'A 123'];
        yield [false, 'sz', 'AA 123'];
        yield [false, 'sz', 'A 1234'];
        yield [false, 'sz', 'A1234'];
        yield [false, 'sz', 'AA123'];
        yield [false, 'sz', 'AA12'];
        yield [false, 'sz', 'A1234'];

        yield [true, 'ch', '1234'];
        yield [false, 'ch', '123'];
        yield [false, 'ch', '12345'];

        yield [true, 'tw', '123'];
        yield [true, 'tw', '12345'];
        yield [false, 'tw', '1234'];
        yield [false, 'tw', '123456'];
        yield [false, 'tw', '12'];

        yield [true, 'tj', '123456'];
        yield [false, 'tj', '12345'];
        yield [false, 'tj', '1234567'];

        yield [true, 'th', '12345'];
        yield [false, 'th', '1234'];
        yield [false, 'th', '123456'];

        yield [true, 'tr', '12345'];
        yield [false, 'tr', '1234'];
        yield [false, 'tr', '123456'];

        yield [true, 'tn', '1234'];
        yield [false, 'tn', '123'];
        yield [false, 'tn', '12345'];

        yield [true, 'ua', '12345'];
        yield [false, 'ua', '1234'];
        yield [false, 'ua', '123456'];

        yield [true, 'us', '12345'];
        yield [false, 'us', '1234'];
        yield [false, 'us', '123456'];

        yield [true, 'vi', '12345'];
        yield [false, 'vi', '1234'];
        yield [false, 'vi', '123456'];

        yield [true, 'zu', '123456'];
        yield [false, 'zu', '12345'];
        yield [false, 'zu', '1234567'];

        yield [true, 'gb', 'A9 9AA'];
        yield [true, 'gb', 'A99 9AA'];
        yield [true, 'gb', 'A9A 9AA'];
        yield [true, 'gb', 'AA9 9AA'];
        yield [true, 'gb', 'AA99 9AA'];
        yield [true, 'gb', 'AA9A 9AA'];
        yield [true, 'gb', 'a9 9aa'];
        yield [true, 'gb', 'a99 9aa'];
        yield [true, 'gb', 'a9a 9aa'];
        yield [true, 'gb', 'aa9 9aa'];
        yield [true, 'gb', 'aa99 9aa'];
        yield [true, 'gb', 'aa9a 9aa'];
        yield [false, 'gb', 'A99AA'];
        yield [false, 'gb', 'A999AA'];
        yield [false, 'gb', 'A9A9AA'];
        yield [false, 'gb', 'AA99AA'];
        yield [false, 'gb', 'AA999AA'];
        yield [false, 'gb', 'AA9A9AA'];
        yield [false, 'gb', 'A9-9AA'];
        yield [false, 'gb', 'A99-9AA'];
        yield [false, 'gb', 'A9A-9AA'];
        yield [false, 'gb', 'AA9-9AA'];
        yield [false, 'gb', 'AA99-9AA'];
        yield [false, 'gb', 'AA9A-9AA'];
        yield [false, 'gb', '99 9AA'];
        yield [false, 'gb', '999 9AA'];
        yield [false, 'gb', 'AAA 9AA'];
        yield [false, 'gb', '9A9 9AA'];
        yield [false, 'gb', '99AA 9AA'];
        yield [false, 'gb', 'A9AA 9AA'];
        yield [false, 'gb', '123'];
        yield [false, 'gb', '1234'];
        yield [false, 'gb', '12345'];
        yield [false, 'gb', '123456'];

        yield [true, 'ie', 'A65 F4E2'];
        yield [true, 'ie', 'D02 X285'];
        yield [true, 'ie', 'T12 A7KX'];
        yield [false, 'ie', '123456'];
        yield [false, 'ie', 'A65F4E2'];
        yield [false, 'ie', 'A6 5F4E2'];
        yield [false, 'ie', 'D02X28'];
        yield [false, 'ie', 'AB12 C345'];
    }
}
