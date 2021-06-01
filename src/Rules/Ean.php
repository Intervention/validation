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
        return $this->hasEanLength() && $this->checksumMatches();
    }

    /**
     * Determine if the current value has the lenghts of EAN-8 or EAN-13
     *
     * @return boolean
     */
    public function hasEanLength(): bool
    {
        return in_array(strlen($this->getValue()), [8, 13]);
    }

    /**
     * Try to calculate the EAN checksum of the
     * current value and check the matching.
     *
     * @return bool
     */
    protected function checksumMatches(): bool
    {
        return $this->getModuloChecksum($this->getValue()) === $this->getValueChecksum();
    }

    /**
     * Get the checksum of the current value
     *
     * @return int
     */
    protected function getValueChecksum(): int
    {
        return intval(substr($this->getValue(), -1));
    }

    /**
     * Calculate modulo checksum of given value
     *
     * @param  mixed $value
     * @return int
     */
    protected function getModuloChecksum($value): int
    {
        $checksum = 0;
        $chars = array_reverse(str_split(substr($value, 0, -1), 1));
        foreach ($chars as $key => $char) {
            $checksum += ($key % 2 === 1) ? intval($char) * 1 : intval($char) * 3;
        }

        return 10 - $checksum % 10;
    }
}
