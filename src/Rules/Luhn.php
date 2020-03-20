<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Luhn extends AbstractStringRule
{
    /**
     * Determine if current value has correct Luhn checksum
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        return $this->checksumMatches();
    }

    /**
     * Determine if the checksum of the current value is valid
     *
     * @return boolean
     */
    protected function checksumMatches(): bool
    {
        return $this->getChecksum() % 10 === 0;
    }

    /**
     * Calculate checksum of current value
     *
     * @return int
     */
    protected function getChecksum(): int
    {
        $checksum = 0;
        $reverse = strrev($this->getValue());

        foreach (str_split($reverse) as $num => $digit) {
            if (is_numeric($digit)) {
                $checksum += $num & 1 ? ($digit > 4 ? (int) $digit * 2 - 9 : (int) $digit * 2) : $digit;
            } else {
                return -1;
            }
        }

        return $checksum;
    }
}
