<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRule;

class Ean extends AbstractRule implements Rule
{
    /**
     * Determine if rule should check length (EAN8 or EAN13)
     *
     * @var array
     */
    protected $lengths = [
        8,
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
        return $this->hasAllowedLength($value) && $this->checksumMatches($value);
    }

    /**
     * Determine if the current value has the lenghts of EAN-8 or EAN-13
     *
     * @return boolean
     */
    public function hasAllowedLength($value): bool
    {
        return in_array(strlen($value), $this->lengths);
    }

    /**
     * Try to calculate the EAN checksum of the
     * current value and check the matching.
     *
     * @return bool
     */
    protected function checksumMatches($value): bool
    {
        return $this->getModuloChecksum($value) === $this->getValueChecksum($value);
    }

    /**
     * Get the checksum of the current value
     *
     * @return int
     */
    protected function getValueChecksum($value): int
    {
        return intval(substr($value, -1));
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
