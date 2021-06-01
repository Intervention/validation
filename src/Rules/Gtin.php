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
        // GTIN-14 or GTIN-12 must be 14 or 12 chars including indicator digit and must have matching checksum
        $valid = $this->hasGtinLength() && $this->hasValidIndicatorDigit() && $this->gtinChecksumMatches();

        // GTIN-13, GTIN-8 is the same as EAN-13 and EAN-8
        return parent::isValid() || ($valid);
    }

    /**
     * Determine if current value has valid indicator digit
     *
     * @return boolean
     */
    protected function hasValidIndicatorDigit(): bool
    {
        return is_numeric(substr($this->getValue(), 0, 1));
    }

    /**
     * Determine if current value has length of GTIN-12 or GTIN-14
     *
     * @return boolean
     */
    protected function hasGtinLength(): bool
    {
        return in_array(strlen($this->getValue()), [12, 14]);
    }

    /**
     * Try to calculate the modulo checksum of a
     * current value as GTIN.
     *
     * @return bool
     */
    protected function gtinChecksumMatches(): bool
    {
        $data = substr($this->getValue(), 1); // strip indicator digit

        return parent::getModuloChecksum($data) === parent::getValueChecksum();
    }
}
