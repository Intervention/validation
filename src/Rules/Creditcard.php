<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Creditcard extends AbstractStringRule
{
    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid()
    {
        $value = $this->getValue();

        if (! $this->hasValidLength($value)) {
            return false;
        }

        return $this->checksumMatches($value, $this->getChecksum($value));
    }

    /**
     * Calculate and return checksum from given creditcard number
     *
     * @param  mixed $value
     * @return int
     */
    private function getChecksum($value)
    {
        $sum = 0;
        $weight = 2;
        $length = strlen($value);

        for ($i = $length - 2; $i >= 0; $i--) {
            if (is_numeric($value[$i])) {
                $digit = $weight * $value[$i];
                $sum += floor($digit / 10) + $digit % 10;
                $weight = $weight % 2 + 1;
            } else {
                return -1;
            }
        }

        return $sum;
    }

    /**
     * Determines if checksum matches to the given creditcard number
     *
     * @param  mixed  $value
     * @param  string $checksum
     * @return boolean          
     */
    private function checksumMatches($value, $checksum)
    {
        $length = strlen($value);
        $mod = (10 - $checksum % 10) % 10;


        return ($mod == $value[$length - 1]);
    }

    /**
     * Check if the given value has the proper length for creditcards
     *
     * @param  mixed  $value
     * @return boolean
     */
    private function hasValidLength($value)
    {
        return (strlen($value) >= 13 || strlen($value) <= 19);
    }
}
