<?php

namespace Intervention\Validation\Rules;

class Gtin extends Ean
{
    /**
     * Determine if current input is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        // GTIN-13, GTIN-8 is the same as EAN-13 and EAN-8
        if (in_array(strlen($this->getValue()), [8, 13])) {
            return parent::checksumMatches();
        }

        // GTIN-14 must be 14 chars including indicator digit and must have matching checksum
        if (strlen($this->getValue()) === 14 && is_numeric(substr($this->getValue(), 0, 1))) {
            return $this->gtin14ChecksumMatches();
        }

        // GTIN-12 must be 12 chars including indicator digit and must have matching checksum
        if (strlen($this->getValue()) === 12 && is_numeric(substr($this->getValue(), 0, 1))) {
            return $this->gtin12ChecksumMatches();
        }

        return false;
    }

    /**
     * Try to calculate the modulo checksum of a
     * current value as GTIN-14.
     *
     * @return bool
     */
    protected function gtin14ChecksumMatches(): bool
    {
        $data = substr($this->getValue(), 1); // strip indicator digit

        return parent::getModuloChecksum($data) === intval(substr($this->getValue(), -1));
    }

    /**
     * Try to calculate the modulo checksum of a
     * current value as GTIN-12.
     *
     * @return bool
     */
    protected function gtin12ChecksumMatches(): bool
    {
        $data = substr($this->getValue(), 1); // strip indicator digit

        return parent::getModuloChecksum($data) === intval(substr($this->getValue(), -1));
    }
}
