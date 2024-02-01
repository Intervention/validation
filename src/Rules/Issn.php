<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Issn extends AbstractRegexRule
{
    protected function pattern(): string
    {
        return "/^[0-9]{4}-[0-9]{3}[0-9xX]$/";
    }

    public function isValid(mixed $value): bool
    {
        return parent::isValid($value) && $this->checkSumMatches($value);
    }

    /**
     * Determine if checksum matches
     *
     * @return bool
     */
    private function checkSumMatches($value): bool
    {
        return $this->calculateChecksum($value) === $this->parseChecksum($value);
    }

    /**
     * Calculate checksum from the current value
     *
     * @return int
     */
    private function calculateChecksum($value): int
    {
        $checksum = 0;
        $issn_numbers = str_replace('-', '', $value);

        foreach (range(8, 2) as $num => $multiplicator) {
            $checksum += intval($issn_numbers[$num]) * $multiplicator;
        }

        $remainder = ($checksum % 11);

        return $remainder === 0 ? 0 : 11 - $remainder;
    }

    /**
     * Parse attached checksum of current value (last digit)
     *
     * @return int
     */
    private function parseChecksum($value): int
    {
        $last = substr($value, -1);

        return strtolower($last) === 'x' ? 10 : intval($last);
    }
}
