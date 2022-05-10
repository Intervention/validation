<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Isbn extends Ean implements Rule
{
    /**
     * Valid lengths
     *
     * @var array
     */
    protected $lengths = [
        10,
        13,
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
        // normalize value
        $value = preg_replace("/[^0-9x]/i", '', $value);

        if (!$this->hasAllowedLength($value)) {
            return false;
        }

        switch (strlen($value)) {
            case 10:
                return $this->shortChecksumMatches($value);

            case 13:
                return parent::checksumMatches($value); // isbn-13 is a subset of ean-13
        }

        return false;
    }

    /**
     * Determine if checksum for ISBN-10 numbers is valid
     *
     * @return bool
     */
    private function shortChecksumMatches($value)
    {
        return $this->getShortChecksum($value) % 11 === 0;
    }

    /**
     * Calculate checksum of short ISBN numbers
     *
     * @return int
     */
    private function getShortChecksum($value)
    {
        $checksum = 0;
        $multiplier = 10;
        foreach (str_split($value) as $digit) {
            $digit = strtolower($digit) == 'x' ? 10 : intval($digit);
            $checksum += $digit * $multiplier;
            $multiplier--;
        }

        return $checksum;
    }
}
