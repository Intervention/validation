<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Iban extends AbstractRule
{
    /**
     * IBAN lengths for countries
     *
     * @var array<string, int>
     */
    private $lengths = [
        'AL' => 28,
        'AD' => 24,
        'AT' => 20,
        'AZ' => 28,
        'BH' => 22,
        'BY' => 28,
        'BE' => 16,
        'BA' => 20,
        'BR' => 29,
        'BG' => 22,
        'CR' => 22,
        'HR' => 21,
        'CY' => 28,
        'CZ' => 24,
        'DK' => 18,
        'DO' => 28,
        'EG' => 29,
        'SV' => 28,
        'EE' => 20,
        'FO' => 18,
        'FI' => 18,
        'FR' => 27,
        'GE' => 22,
        'DE' => 22,
        'GI' => 23,
        'GR' => 27,
        'GL' => 18,
        'GT' => 28,
        'VA' => 22,
        'HU' => 28,
        'IS' => 26,
        'IQ' => 23,
        'IE' => 22,
        'IL' => 23,
        'IT' => 27,
        'JO' => 30,
        'KZ' => 20,
        'XK' => 20,
        'KW' => 30,
        'LV' => 21,
        'LB' => 28,
        'LI' => 21,
        'LT' => 20,
        'LU' => 20,
        'MT' => 31,
        'MR' => 27,
        'MU' => 30,
        'MD' => 24,
        'MC' => 27,
        'ME' => 22,
        'NL' => 18,
        'MK' => 19,
        'NO' => 15,
        'PK' => 24,
        'PS' => 29,
        'PL' => 28,
        'PT' => 25,
        'QA' => 29,
        'RO' => 24,
        'LC' => 32,
        'SM' => 27,
        'ST' => 25,
        'SA' => 24,
        'RS' => 22,
        'SC' => 31,
        'SK' => 24,
        'SI' => 19,
        'ES' => 24,
        'SE' => 24,
        'CH' => 21,
        'TL' => 23,
        'TN' => 24,
        'TR' => 26,
        'UA' => 29,
        'AE' => 23,
        'GB' => 22,
        'VG' => 24,

        // partial iban countries (experimental)
        'DZ' => 26,
        'AO' => 25,
        'BJ' => 28,
        'BF' => 28,
        'BI' => 16,
        'CM' => 27,
        'CV' => 25,
        'CF' => 27,
        'TD' => 27,
        'KM' => 27,
        'CG' => 27,
        'DJ' => 27,
        'GQ' => 27,
        'GA' => 27,
        'GW' => 25,
        'HN' => 28,
        'IR' => 26,
        'CI' => 28,
        'MG' => 27,
        'ML' => 28,
        'MA' => 28,
        'MZ' => 25,
        'NI' => 32,
        'NE' => 28,
        'SN' => 28,
        'TG' => 28,
    ];

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        // normalize value
        $value = str_replace(' ', '', strtoupper(strval($value)));

        // check iban length and checksum
        return $this->hasValidLength($value) && $this->getChecksum($value) === 1;
    }

    /**
     * Calculate checksum of iban
     *
     * @param string $iban
     * @return int
     */
    private function getChecksum(string $iban): int
    {
        $iban = substr($iban, 4) . substr($iban, 0, 4);
        $iban = str_replace(
            $this->getReplacementsChars(),
            $this->getReplacementsValues(),
            $iban
        );

        $checksum = intval(substr($iban, 0, 1));

        for ($strcounter = 1; $strcounter < strlen($iban); $strcounter++) {
            $checksum *= 10;
            $checksum += intval(substr($iban, $strcounter, 1));
            $checksum %= 97;
        }

        return $checksum; // only 1 is iban
    }

    /**
     * Returns the designated length of IBAN for given IBAN
     *
     * @param string $iban
     * @return int|false
     */
    private function getDesignatedIbanLength(string $iban): int|false
    {
        $countrycode = substr($iban, 0, 2);

        return isset($this->lengths[$countrycode]) ? $this->lengths[$countrycode] : false;
    }

    /**
     * Determine if given iban has the proper length
     *
     * @param string $iban
     * @return bool
     */
    private function hasValidLength(string $iban): bool
    {
        return $this->getDesignatedIbanLength($iban) == strlen($iban);
    }

    /**
     * Get chars to be replaced in checksum calculation
     *
     * @return array<string>
     */
    private function getReplacementsChars(): array
    {
        return range('A', 'Z');
    }

    /**
     * Get values to replace chars in checksum calculation
     *
     * @return array<string>
     */
    private function getReplacementsValues(): array
    {
        $values = [];
        foreach (range(10, 35) as $value) {
            $values[] = strval($value);
        }

        return $values;
    }
}
