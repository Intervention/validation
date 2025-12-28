<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class EuropeanVatNumber extends AbstractRule
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

    public function __construct(private readonly bool $withApi = false)
    {
    }

    /**
     * @throws \SoapFault
     */
    public function isValid(mixed $value): bool
    {
        $vatNumber = $this->vatCleaner((string) $value);
        [$country, $number] = $this->splitVat($vatNumber);


        $isValidFormat = $this->isValidFormat($country, $number);

        if (!$this->withApi) {
            return $isValidFormat;
        }

        return $this->checkVatViaApi($country, $number);
    }

    private function isValidFormat(string $country, string $number): bool
    {
        if (!isset($this->patternExpressions[$country])) {
            return false;
        }

        $validateRule = preg_match('/^' . $this->patternExpressions[$country] . '$/', (string) $number) > 0;

        if ($validateRule && $country === 'IT') {
            $result = self::luhnCheck($number);

            return $result % 10 == 0;
        }

        if ($validateRule && $country === 'HU') {
            return $this->validateHuVat($number);
        }

        return $validateRule;
    }

    /** @link https://en.wikipedia.org/wiki/Luhn_algorithm */
    private function luhnCheck(string $vat): int
    {
        $sum = 0;
        $vat_array = str_split($vat);
        $counter = count($vat_array);
        for ($index = 0; $index < $counter; ++$index) {
            $value = intval($vat_array[$index]);
            if ($index % 2 !== 0) {
                $value *= 2;
                if ($value > 9) {
                    $value = 1 + ($value % 10);
                }
            }

            $sum += $value;
        }

        return $sum;
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

    private function vatCleaner(string $vatNumber): string
    {
        $vatNumber_no_spaces = trim($vatNumber);

        return strtoupper($vatNumber_no_spaces);
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

    /**
     * @throws \SoapFault
     */
    private function checkVatViaApi(string $country, string $number): bool
    {
        $client = new \SoapClient(
            'https://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl',
            ['connection_timeout' => 10],
        );
        $response = $client->checkVat(
            [
                'countryCode' => $country,
                'vatNumber' => $number,
            ]
        );

        return $response->valid;
    }
}
