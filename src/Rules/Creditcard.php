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

    private function getChecksum($value)
    {
        $sum = 0;
        $weight = 2;
        $length = strlen($value);

        for ($i = $length - 2; $i >= 0; $i--) {
            $digit = $weight * $value[$i];
            $sum += floor($digit / 10) + $digit % 10;
            $weight = $weight % 2 + 1;
        }

        return $sum;
    }

    private function checksumMatches($value, $checksum)
    {
        $length = strlen($value);
        $mod = (10 - $checksum % 10) % 10;


        return ($mod == $value[$length - 1]);
    }

    private function hasValidLength($value)
    {
        return (strlen($value) >= 13 || strlen($value) <= 19);
    }
}
