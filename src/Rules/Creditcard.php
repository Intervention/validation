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
        $length = strlen($value);

        if ($length < 13 || $length > 19) {
            return false;
        }

        $sum = 0;
        $weight = 2;

        for ($i = $length - 2; $i >= 0; $i--) {
            $digit = $weight * $value[$i];
            $sum += floor($digit / 10) + $digit % 10;
            $weight = $weight % 2 + 1;
        }

        $mod = (10 - $sum % 10) % 10;

        return ($mod == $value[$length - 1]);
    }
}
