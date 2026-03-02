<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

class EuropeanVatNumber extends Luhn
{
    /**
     * @link http://ec.europa.eu/taxation_customs/vies/faq.html?locale=en#item_11
     *
     * @var array<string, string>
     */
    private array $patternExpressions = [
        'AT' => 'U[A-Z\d]{8}',
        'BE' => '(0\d{9}|\d{10})',
        'BG' => '\d{9,10}',
        'CH' => '^\d{6}$|^[E]\d{9}\s?(TVA|MWST|IVA)$',
        'CY' => '\d{8}[A-Z]',
        'CZ' => '\d{8,10}',
        'DE' => '\d{9}',
        'DK' => '(\d{2} ?){3}\d{2}',
        'EE' => '\d{9}',
        'EL' => '\d{9}',
        'ES' => '[A-Z]\d{7}[A-Z]|\d{8}[A-Z]|[A-Z]\d{8}',
        'FI' => '\d{8}',
        'FR' => '([A-Z]{2}|\d{2})\d{9}',
        'GB' => '\d{9}|\d{12}|(GD|HA)\d{3}',
        'HR' => '\d{11}',
        'HU' => '\d{8}',
        'IE' => '[A-Z\d]{8}|[A-Z\d]{9}',
        'IT' => '\d{11}',
        'LT' => '(\d{9}|\d{12})',
        'LU' => '\d{8}',
        'LV' => '\d{11}',
        'MT' => '\d{8}',
        'NL' => '\d{9}B\d{2}',
        'PL' => '\d{10}',
        'PT' => '\d{9}',
        'RO' => '\d{2,10}',
        'SE' => '\d{12}',
        'SI' => '\d{8}',
        'SK' => '\d{10}',
    ];

    public function isValid(mixed $value): bool
    {
        $vatNumber = strtoupper(trim((string) $value));
        [$country, $number] = $this->splitVat($vatNumber);

        if (!isset($this->patternExpressions[$country])) {
            return false;
        }

        $hasMatch = preg_match('/^' . $this->patternExpressions[$country] . '$/', (string) $number) > 0;

        if ($hasMatch && $country === 'IT') {
            return parent::isValid($number);
        }

        if ($hasMatch && $country === 'HU') {
            return $this->validateHuVat($number);
        }

        return $hasMatch;
    }

    private function validateHuVat(string $vatNumber): bool
    {
        $checksum = (int) $vatNumber[7];
        $weights = [9, 7, 3, 1, 9, 7, 3];
        $sum = 0;

        foreach ($weights as $i => $weight) {
            $sum += (int) $vatNumber[$i] * $weight;
        }

        $calculatedChecksum = (10 - ($sum % 10)) % 10;

        return $calculatedChecksum === $checksum;
    }

    /**
     * @return array{0: string, 1: string}
     */
    private function splitVat(string $vatNumber): array
    {
        return [
            substr($vatNumber, 0, 2),
            substr($vatNumber, 2),
        ];
    }
}
