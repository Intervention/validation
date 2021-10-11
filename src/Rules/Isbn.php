<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRule;

class Isbn extends AbstractRule implements Rule
{
    /**
     * Determine if rule should check length (EAN8 or EAN13)
     *
     * @var array
     */
    protected $lengths = [
        10,
        13,
    ];

    /**
     * Create a new rule instance.
     *
     * @param  int  $length
     * @return void
     */
    public function __construct(?int $length = null)
    {
        if (is_int($length)) {
            $this->lengths = [$length];
        }
    }

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

        if (! $this->hasAllowedLength($value)) {
            return false;
        }

        switch (strlen($value)) {
            case 10:
                return $this->shortChecksumMatches($value);

            case 13:
                return $this->longChecksumMatches($value);
        }

        return false;
    }

    /**
     * Determine if the current value has an allowed length
     *
     * @return boolean
     */
    public function hasAllowedLength($value): bool
    {
        return in_array(strlen($value), $this->lengths);
    }

    /**
     * Determine if checksum for short ISBN numbers is valid
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

    /**
     * Determine if long checksum is valid
     *
     * @return bool
     */
    private function longChecksumMatches($value)
    {
        return $this->getLongChecksum($value) % 10 === 0;
    }

    /**
     * Calculate checksum for long ISBN numbers
     *
     * @return int
     */
    private function getLongChecksum($value)
    {
        $checksum = 0;
        foreach (str_split($value) as $num => $digit) {
            $multiplier = $num % 2 ? 3 : 1;
            $checksum += intval($digit) * $multiplier;
        }

        return $checksum;
    }
}
