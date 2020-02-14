<?php

namespace Intervention\Validation;

abstract class AbstractLuhnRule extends AbstractStringRule
{
    public function isValid()
    {
        return $this->checksumMatches($this->getChecksum());
    }

    /**
     * Calculate and return Luhn checksum
     *
     * @return int
     */
    private function getChecksum()
    {
        $sum = 0;
        $weight = 2;
        $length = strlen($this->getValue());

        for ($i = $length - 2; $i >= 0; $i--) {
            if (is_numeric($this->getValue()[$i])) {
                $digit = $weight * $this->getValue()[$i];
                $sum += floor($digit / 10) + $digit % 10;
                $weight = $weight % 2 + 1;
            } else {
                return -1;
            }
        }

        return $sum;
    }

    /**
     * Determines if Luhn checksum matches to the current value
     *
     * @param  string $checksum
     * @return boolean
     */
    private function checksumMatches($checksum)
    {
        $length = strlen($this->getValue());
        $mod = (10 - $checksum % 10) % 10;


        return ($mod == $this->getValue()[$length - 1]);
    }
}
