<?php

namespace Intervention\Validation\Test\Rules;

use Intervention\Validation\Rules\Postalcode;
use Intervention\Validation\Traits\CanValidate;
use PHPUnit\Framework\TestCase;

class PostalcodeTest extends TestCase
{
    use CanValidate;

    /**
     * @dataProvider dataProvider
    */
    public function testValidationConstructor($result, $countrycode, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [new Postalcode($countrycode)]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProvider
    */
    public function testValidationStatic($result, $countrycode, $value)
    {
        $validator = $this->getValidator(['value' => $value], ['value' => [Postalcode::countrycode($countrycode)]]);
        $this->assertEquals($result, $validator->passes());
    }

    /**
     * @dataProvider dataProvider
    */
    public function testValidationStaticCallback($result, $countrycode, $value)
    {

        $validator = $this->getValidator(['value' => $value], ['value' => [Postalcode::resolve(function () use ($countrycode) {
            return $countrycode;
        })]]);
        $this->assertEquals($result, $validator->passes());
    }

    public function dataProvider()
    {
        return [
            [false, 'non-existing-country-code', '0'],
            [true, 'de', '44141'],
            [true, 'de', '25746'],
            [false, 'de', '2240'],
            [false, 'de', '123456'],
            [true, 'dz', '44141'],
            [true, 'dz', '25746'],
            [false, 'dz', '2240'],
            [false, 'dz', '123456'],
            [true, 'as', '44141'],
            [true, 'as', '25746'],
            [false, 'as', '2240'],
            [false, 'as', '123456'],
            [true, 'ad', '44141'],
            [true, 'ad', '25746'],
            [false, 'ad', '2240'],
            [false, 'ad', '123456'],
            [true, 'ar', '4414'],
            [true, 'ar', '2574'],
            [false, 'ar', '224'],
            [false, 'ar', '12345'],
            [true, 'am', '4414'],
            [true, 'am', '2574'],
            [false, 'am', '224'],
            [false, 'am', '12345'],
            [true, 'au', '4414'],
            [true, 'au', '2574'],
            [false, 'au', '224'],
            [false, 'au', '12345'],
            [true, 'at', '4414'],
            [true, 'at', '2574'],
            [false, 'at', '224'],
            [false, 'at', '12345'],

            [true, 'az', '1234'],
            [true, 'az', '123456'],
            [false, 'az', '12345'],
            [false, 'az', '224'],
            [false, 'az', '1234567'],

            [true, 'bd', '4414'],
            [true, 'bd', '2574'],
            [false, 'bd', '224'],
            [false, 'bd', '12345'],

            [true, 'by', '123456'],
            [false, 'by', '12345'],
            [false, 'by', '1234567'],

            [true, 'be', '1234'],
            [false, 'be', '123'],
            [false, 'be', '12345'],

            [true, 'ba', '12345'],
            [false, 'ba', '1234'],
            [false, 'ba', '123456'],

            [true, 'br', '12345'],
            [false, 'br', '1234'],
            [false, 'br', '123456'],
            [true, 'br', '12345678'],
            [false, 'br', '123456789'],
            [false, 'br', '1234567'],
            [true, 'br', '12345-123'],
            [false, 'br', '1234-123'],
            [false, 'br', '12345-12'],

            [true, 'bn', 'AA1234'],
            [false, 'bn', '001234'],
            [false, 'bn', 'AAAAAA'],
            [false, 'bn', 'A1234'],
            [false, 'bn', 'AA123'],
            [false, 'bn', 'AAA1234'],
            [false, 'bn', 'AA12345'],

            [true, 'bg', '1234'],
            [false, 'bg', '123'],
            [false, 'bg', '12345'],

            [true, 'ca', 'A9A 9A9'],
            [true, 'ca', 'A9A 9A'],
            [false, 'ca', '9A9 A9A'],
            [false, 'ca', '9A9 A9'],
            [false, 'ca', 'A9A9A9'],
            [false, 'ca', 'A9A9A'],
            [false, 'ca', 'AAA 9A9'],
            [false, 'ca', 'AAA 9A'],
            [false, 'ca', '999 9A9'],
            [false, 'ca', 'A9A 99'],
            [false, 'ca', 'A9A 9A99'],
            [false, 'ca', '99999'],
            [false, 'ca', '9999'],

            [true, 'ic', '12345'],
            [false, 'ic', '1234'],
            [false, 'ic', '123456'],

            [true, 'cn', '123456'],
            [false, 'cn', '12345'],
            [false, 'cn', '1234567'],

            [true, 'mp', '12345'],
            [false, 'mp', '1234'],
            [false, 'mp', '123456'],

            [true, 'hr', '12345'],
            [false, 'hr', '1234'],
            [false, 'hr', '123456'],

            [true, 'cu', '12345'],
            [false, 'cu', '1234'],
            [false, 'cu', '123456'],

            [true, 'cy', '1234'],
            [false, 'cy', '123'],
            [false, 'cy', '12345'],

            [true, 'cz', '123 45'],
            [false, 'cz', '12345'],
            [false, 'cz', '12 345'],
            [false, 'cz', '1234'],
            [false, 'cz', '1234 56'],
            [false, 'cz', '123 456'],

            [true, 'gr', '123 45'],
            [false, 'gr', '12345'],
            [false, 'gr', '12 345'],
            [false, 'gr', '1234'],
            [false, 'gr', '1234 56'],
            [false, 'gr', '123 456'],

            [true, 'dk', '1234'],
            [false, 'dk', '123'],
            [false, 'dk', '12345'],

            [true, 'ec', '123456'],
            [false, 'ec', '12345'],
            [false, 'ec', '1234567'],

            [true, 'ee', '12345'],
            [false, 'ee', '1234'],
            [false, 'ee', '123456'],

            [true, 'fo', '123'],
            [false, 'fo', '1234'],
            [false, 'fo', '12'],
            [false, 'fo', '1245'],

            [true, 'fi', '12345'],
            [false, 'fi', '1234'],
            [false, 'fi', '123456'],

            [true, 'fr', '12345'],
            [false, 'fr', '1234'],
            [false, 'fr', '123456'],

            [true, 'gf', '12345'],
            [false, 'gf', '1234'],
            [false, 'gf', '123456'],

            [true, 'ge', '1234'],
            [false, 'ge', '123'],
            [false, 'ge', '12345'],

            [true, 'gl', '1234'],
            [false, 'gl', '123'],
            [false, 'gl', '12345'],

            [true, 'gp', '12345'],
            [false, 'gp', '1234'],
            [false, 'gp', '123456'],

            [true, 'gu', '12345'],
            [false, 'gu', '1234'],
            [false, 'gu', '123456'],

            [true, 'gg', 'AA9 9AA'],
            [true, 'gg', 'aa9 9aa'],
            [true, 'gg', 'AA99 9AA'],
            [true, 'gg', 'aa99 9aa'],
            [false, 'gg', 'AA99AA'],
            [false, 'gg', 'AA9 99AA'],
            [false, 'gg', '123 1234'],
            [false, 'gg', '123456'],
            [false, 'gg', '12345'],
            [false, 'gg', '1234'],
            [false, 'gg', '123'],

            [true, 'hu', '1234'],
            [false, 'hu', '123'],
            [false, 'hu', '12345'],

            [true, 'is', '123'],
            [false, 'is', '12'],
            [false, 'is', '1234'],

            [true, 'in', '123456'],
            [false, 'in', '12345'],
            [false, 'in', '1234567'],

            [true, 'id', '12345'],
            [false, 'id', '1234'],
            [false, 'id', '123456'],

            [true, 'il', '12345'],
            [true, 'il', '1234567'],
            [false, 'il', '123456'],
            [false, 'il', '1234'],
            [false, 'il', '123'],
            [false, 'il', '12345678'],

            [true, 'it', '12345'],
            [false, 'it', '1234'],
            [false, 'it', '123456'],

            [true, 'jp', '123-4567'],
            [false, 'jp', '1234567'],
            [false, 'jp', '12-4567'],
            [false, 'jp', '123-456'],
            [false, 'jp', '1234-4567'],
            [false, 'jp', '123-45678'],
            [false, 'jp', '12345'],
            [false, 'jp', '123-456-7'],

            [true, 'je', 'AA9 9AA'],
            [true, 'je', 'aa9 9aa'],
            [true, 'je', 'AA99 9AA'],
            [true, 'je', 'aa99 9aa'],
            [false, 'je', 'AA99AA'],
            [false, 'je', 'AA9 99AA'],
            [false, 'je', '123 1234'],
            [false, 'je', '123456'],
            [false, 'je', '12345'],
            [false, 'je', '1234'],
            [false, 'je', '123'],

            [true, 'kz', '123456'],
            [false, 'kz', '12345'],
            [false, 'kz', '1234567'],

            [true, 'kr', '12345'],
            [false, 'kr', '1234'],
            [false, 'kr', '123456'],

            [true, 'kv', '12345'],
            [false, 'kv', '1234'],
            [false, 'kv', '123456'],

            [true, 'kg', '123456'],
            [false, 'kg', '12345'],
            [false, 'kg', '1234567'],

            [true, 'lv', '1234'],
            [false, 'lv', '123'],
            [false, 'lv', '12345'],

            [true, 'li', '1234'],
            [false, 'li', '123'],
            [false, 'li', '12345'],

            [true, 'lt', '12345'],
            [false, 'lt', '1234'],
            [false, 'lt', '123456'],

            [true, 'lu', '1234'],
            [false, 'lu', '123'],
            [false, 'lu', '12345'],

            [true, 'mk', '1234'],
            [false, 'mk', '123'],
            [false, 'mk', '12345'],

            [true, 'mg', '123'],
            [false, 'mg', '12'],
            [false, 'mg', '1234'],

            [true, 'my', '12345'],
            [false, 'my', '1234'],
            [false, 'my', '123456'],

            [true, 'mv', '12345'],
            [true, 'mv', '1234'],
            [false, 'mv', '123'],
            [false, 'mv', '123456'],

            [true, 'mh', '12345'],
            [false, 'mh', '1234'],
            [false, 'mh', '123456'],

            [true, 'mq', '12345'],
            [false, 'mq', '1234'],
            [false, 'mq', '123456'],

            [true, 'yt', '12345'],
            [false, 'yt', '1234'],
            [false, 'yt', '123456'],

            [true, 'mx', '12345'],
            [true, 'mx', '1234'],
            [false, 'mx', '123'],
            [false, 'mx', '123456'],

            [true, 'fm', '12345'],
            [false, 'fm', '1234'],
            [false, 'fm', '123456'],

            [true, 'md', '1234'],
            [false, 'md', '123'],
            [false, 'md', '12345'],

            [true, 'mc', '12345'],
            [false, 'mc', '1234'],
            [false, 'mc', '123456'],

            [true, 'mn', '12345'],
            [true, 'mn', '123456'],
            [false, 'mn', '1234'],
            [false, 'mn', '1234567'],

            [true, 'me', '12345'],
            [false, 'me', '1234'],
            [false, 'me', '123456'],

            [true, 'ma', '12345'],
            [false, 'ma', '1234'],
            [false, 'ma', '123456'],

            [true, 'nl', '1234'],
            [true, 'nl', '1234 AA'],
            [true, 'nl', '1234 aa'],
            [false, 'nl', '1234AA'],
            [false, 'nl', '123 AA'],
            [false, 'nl', '1234 AAA'],
            [false, 'nl', '12345'],
            [false, 'nl', '123'],
            [false, 'nl', '1234-AA'],
            [false, 'nl', '123456'],

            [true, 'nc', '12345'],
            [false, 'nc', '1234'],
            [false, 'nc', '123456'],

            [true, 'nz', '1234'],
            [false, 'nz', '123'],
            [false, 'nz', '12345'],

            [true, 'no', '1234'],
            [false, 'no', '123'],
            [false, 'no', '12345'],

            [true, 'pk', '12345'],
            [false, 'pk', '1234'],
            [false, 'pk', '123456'],

            [true, 'pw', '12345'],
            [false, 'pw', '1234'],
            [false, 'pw', '123456'],

            [true, 'pg', '123'],
            [false, 'pg', '12'],
            [false, 'pg', '1234'],

            [true, 'ph', '1234'],
            [false, 'ph', '123'],
            [false, 'ph', '12345'],

            [true, 'pl', '12-345'],
            [false, 'pl', '12345'],
            [false, 'pl', '123-345'],
            [false, 'pl', '12-3456'],
            [false, 'pl', '1-345'],
            [false, 'pl', '12-34'],
            [false, 'pl', '1234'],
            [false, 'pl', '123456'],

            [true, 'pt', '1234'],
            [true, 'pt', '1234-123'],
            [false, 'pt', '12345-123'],
            [false, 'pt', '1234-12'],
            [false, 'pt', '12345-123'],
            [false, 'pt', '1234-1234'],
            [false, 'pt', '1234123'],

            [true, 'pr', '12345'],
            [false, 'pr', '1234'],
            [false, 'pr', '123456'],

            [true, 're', '12345'],
            [false, 're', '1234'],
            [false, 're', '123456'],

            [true, 'ro', '123456'],
            [false, 'ro', '12345'],
            [false, 'ro', '1234567'],

            [true, 'ru', '123456'],
            [false, 'ru', '12345'],
            [false, 'ru', '1234567'],

            [true, 'sg', '123456'],
            [false, 'sg', '12345'],
            [false, 'sg', '1234567'],

            [true, 'sm', '12345'],
            [false, 'sm', '1234'],
            [false, 'sm', '123456'],

            [true, 'rs', '12345'],
            [false, 'rs', '1234'],
            [false, 'rs', '123456'],

            [true, 'sk', '123 45'],
            [false, 'sk', '12345'],
            [false, 'sk', '12 345'],
            [false, 'sk', '1234'],
            [false, 'sk', '1234 56'],
            [false, 'sk', '123 456'],

            [true, 'si', '1234'],
            [false, 'si', '123'],
            [false, 'si', '12345'],

            [true, 'za', '1234'],
            [false, 'za', '123'],
            [false, 'za', '12345'],

            [true, 'es', '12345'],
            [false, 'es', '1234'],
            [false, 'es', '123456'],

            [true, 'xy', '12345'],
            [false, 'xy', '1234'],
            [false, 'xy', '123456'],

            [true, 'se', '123 45'],
            [false, 'se', '12345'],
            [false, 'se', '12 345'],
            [false, 'se', '1234'],
            [false, 'se', '1234 56'],
            [false, 'se', '123 456'],

            [true, 'sz', 'A123'],
            [true, 'sz', 'a123'],
            [false, 'sz', '1234'],
            [false, 'sz', 'A-123'],
            [false, 'sz', 'A 123'],
            [false, 'sz', 'AA 123'],
            [false, 'sz', 'A 1234'],
            [false, 'sz', 'A1234'],
            [false, 'sz', 'AA123'],
            [false, 'sz', 'AA12'],
            [false, 'sz', 'A1234'],

            [true, 'ch', '1234'],
            [false, 'ch', '123'],
            [false, 'ch', '12345'],

            [true, 'tw', '123'],
            [true, 'tw', '12345'],
            [false, 'tw', '1234'],
            [false, 'tw', '123456'],
            [false, 'tw', '12'],

            [true, 'tj', '123456'],
            [false, 'tj', '12345'],
            [false, 'tj', '1234567'],

            [true, 'th', '12345'],
            [false, 'th', '1234'],
            [false, 'th', '123456'],

            [true, 'tr', '12345'],
            [false, 'tr', '1234'],
            [false, 'tr', '123456'],

            [true, 'tn', '1234'],
            [false, 'tn', '123'],
            [false, 'tn', '12345'],

            [true, 'ua', '12345'],
            [false, 'ua', '1234'],
            [false, 'ua', '123456'],

            [true, 'us', '12345'],
            [false, 'us', '1234'],
            [false, 'us', '123456'],

            [true, 'vi', '12345'],
            [false, 'vi', '1234'],
            [false, 'vi', '123456'],

            [true, 'zu', '123456'],
            [false, 'zu', '12345'],
            [false, 'zu', '1234567'],

            [true, 'gb', 'A9 9AA'],
            [true, 'gb', 'A99 9AA'],
            [true, 'gb', 'A9A 9AA'],
            [true, 'gb', 'AA9 9AA'],
            [true, 'gb', 'AA99 9AA'],
            [true, 'gb', 'AA9A 9AA'],
            [true, 'gb', 'a9 9aa'],
            [true, 'gb', 'a99 9aa'],
            [true, 'gb', 'a9a 9aa'],
            [true, 'gb', 'aa9 9aa'],
            [true, 'gb', 'aa99 9aa'],
            [true, 'gb', 'aa9a 9aa'],
            [false, 'gb', 'A99AA'],
            [false, 'gb', 'A999AA'],
            [false, 'gb', 'A9A9AA'],
            [false, 'gb', 'AA99AA'],
            [false, 'gb', 'AA999AA'],
            [false, 'gb', 'AA9A9AA'],
            [false, 'gb', 'A9-9AA'],
            [false, 'gb', 'A99-9AA'],
            [false, 'gb', 'A9A-9AA'],
            [false, 'gb', 'AA9-9AA'],
            [false, 'gb', 'AA99-9AA'],
            [false, 'gb', 'AA9A-9AA'],
            [false, 'gb', '99 9AA'],
            [false, 'gb', '999 9AA'],
            [false, 'gb', 'AAA 9AA'],
            [false, 'gb', '9A9 9AA'],
            [false, 'gb', '99AA 9AA'],
            [false, 'gb', 'A9AA 9AA'],
            [false, 'gb', '123'],
            [false, 'gb', '1234'],
            [false, 'gb', '12345'],
            [false, 'gb', '123456'],
        ];
    }
}
