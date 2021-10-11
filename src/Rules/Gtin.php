<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Gtin extends Ean implements Rule
{
    /**
     * Determine if rule should check length (EAN8 or EAN13)
     *
     * @var array
     */
    protected $lengths = [
        8,
        12,
        13,
        14,
    ];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // GTIN-14 or GTIN-12 must be 14 or 12 chars including indicator digit and must have matching checksum
        $valid = $this->hasAllowedLength($value) && $this->hasValidIndicatorDigit($value) && $this->gtinChecksumMatches($value);

        // GTIN-13, GTIN-8 is the same as EAN-13 and EAN-8
        return parent::passes($attribute, $value) || ($valid);
    }

    /**
     * Determine if current value has valid indicator digit
     *
     * @return boolean
     */
    protected function hasValidIndicatorDigit($value): bool
    {
        return is_numeric(substr($value, 0, 1));
    }

    /**
     * Try to calculate the modulo checksum of a
     * current value as GTIN.
     *
     * @return bool
     */
    protected function gtinChecksumMatches($value): bool
    {
        $data = substr($value, 1); // strip indicator digit

        return parent::getModuloChecksum($data) === parent::getValueChecksum($data);
    }
}
