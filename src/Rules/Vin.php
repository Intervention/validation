<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Vin extends AbstractRegexRule
{
    /**
     * Create new rule.
     */
    public function __construct(protected bool $checkDigit = false)
    {
        //
    }

    /**
     * {@inheritdoc}
     *
     * @see AbstractRegexRule::pattern()
     */
    protected function pattern(): string
    {
        return "/^[A-HJ-NPR-Z0-9]{17}$/";
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        if (!parent::isValid($value)) {
            return false;
        }

        if ($this->checkDigit) {
            return $this->validateCheckDigit((string) $value);
        }

        return true;
    }

    /**
     * Validate the VIN check digit using the North American standard.
     */
    private function validateCheckDigit(string $vin): bool
    {
        // weights for each position (position 8 has weight 0 as it's the check digit)
        $weights = [8, 7, 6, 5, 4, 3, 2, 10, 0, 9, 8, 7, 6, 5, 4, 3, 2];

        // transliteration values for letters
        $transliteration = [
            'A' => 1, 'B' => 2, 'C' => 3, 'D' => 4, 'E' => 5, 'F' => 6, 'G' => 7, 'H' => 8,
            'J' => 1, 'K' => 2, 'L' => 3, 'M' => 4, 'N' => 5, 'P' => 7, 'R' => 9, 'S' => 2,
            'T' => 3, 'U' => 4, 'V' => 5, 'W' => 6, 'X' => 7, 'Y' => 8, 'Z' => 9,
        ];

        $sum = 0;
        foreach (str_split($vin) as $i => $char) {
            $value = is_numeric($char) ? (int) $char : $transliteration[$char];
            $sum += $value * $weights[$i];
        }

        $checkDigit = $sum % 11;
        $expectedCheckDigit = $checkDigit === 10 ? 'X' : (string) $checkDigit;

        return $vin[8] === $expectedCheckDigit;
    }
}
