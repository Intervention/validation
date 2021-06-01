<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Ean extends AbstractStringRule
{
    /**
     * Determine if current input is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        if (in_array(strlen($this->getValue()), [8, 13])) {
            return $this->checksumMatches();
        }

        return false;
    }

    /**
     * Try to calculate the EAN checksum of the
     * current value and check the matching.
     *
     * @return bool
     */
    protected function checksumMatches(): bool
    {
        $checksum = 0;
        $chars = array_reverse(str_split(substr($this->getValue(), 0, -1), 1));
        foreach ($chars as $key => $char) {
            $checksum += ($key % 2 === 1) ? intval($char) * 1 : intval($char) * 3;
        }

        return 10 - $checksum % 10 === intval(substr($this->getValue(), -1));
    }
}
