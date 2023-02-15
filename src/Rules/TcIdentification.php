<?php

namespace Intervention\Validation\Rules;

use Exception;
use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRule;
use SoapClient;

class TcIdentification extends AbstractRule implements Rule
{
    /**
     * @var int
     */
    private $tcIdentificationNumber;

    /**
     * @var string
     */
    private $fullName;

    /**
     * @var int
     */
    private $birthYear;

    const LENGTH = 11;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $tcIdentificationNumber, string $fullName, int $birthYear)
    {
        $this->tcIdentificationNumber = $tcIdentificationNumber;
        $this->fullName = $fullName;
        $this->birthYear = $birthYear;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (!$this->hasAllowedLength($value)) {
            return false;
        }

        return $this->verifyTcIdentificationNumber();
    }

    private function getWords(string $fullName): array
    {
        return explode(' ', $fullName);
    }

    private function getFirstName(string $fullName): string
    {
        $words = $this->getWords($fullName);

        return $words[0];
    }

    private function getLastName(string $fullName): string
    {
        $words = $this->getWords($fullName);

        return implode(" ", array_slice($words, 1));
    }

    private function hasAllowedLength($value): bool
    {
        return strlen($value) === self::LENGTH;
    }

    private function verifyTcIdentificationNumber(): bool {
        $client = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");

        try {
            $result = $client->TCKimlikNoDogrula([
                'TCKimlikNo' => $this->tcIdentificationNumber,
                'Ad' => $this->getFirstName($this->fullName),
                'Soyad' => $this->getLastName($this->fullName),
                'DogumYili' => $this->birthYear
            ]);

            return $result->TCKimlikNoDogrulaResult;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function verify(int $tcIndentificationNumber, string $fullName, int $birthYear): self
    {
        return new self($tcIndentificationNumber, $fullName, $birthYear);
    }
}
