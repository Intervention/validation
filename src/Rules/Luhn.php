<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Luhn extends AbstractRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function isValid(mixed $value): bool
    {
        return $this->checksumIsValid($this->getChecksum($value));
    }

    /**
     * Determine if the given checksum is valid
     *
     * @param  mixed $checksum
     * @return bool
     */
    protected function checksumIsValid($checksum): bool
    {
        return $checksum % 10 === 0;
    }

    /**
     * Calculate checksum for the given value
     *
     * @param  mixed $value
     * @return int
     */
    protected function getChecksum($value): int
    {
        $checksum = 0;
        $reverse = strrev($value);

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
