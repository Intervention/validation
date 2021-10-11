<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRegexRule;

class Isin extends Luhn implements Rule
{
    /**
     * Chars to calculate checksum
     *
     * @var array
     */
    private $chars = [
        10 => 'A',
        11 => 'B',
        12 => 'C',
        13 => 'D',
        14 => 'E',
        15 => 'F',
        16 => 'G',
        17 => 'H',
        18 => 'I',
        19 => 'J',
        20 => 'K',
        21 => 'L',
        22 => 'M',
        23 => 'N',
        24 => 'O',
        25 => 'P',
        26 => 'Q',
        27 => 'R',
        28 => 'S',
        29 => 'T',
        30 => 'U',
        31 => 'V',
        32 => 'W',
        33 => 'X',
        34 => 'Y',
        35 => 'Z',
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
        return parent::passes($attribute, $this->normalize($value));
    }

    /**
     * Get value to check against
     *
     * @return string
     */
    public function normalize($value)
    {
        return $this->replaceChars($this->getValueWithoutLastDigit($value)) . $this->getLastDigit($value);
    }

    /**
     * Replace chars in given value with corresponding numbers
     *
     * @param  string $value
     * @return string
     */
    private function replaceChars($value)
    {
        return str_replace($this->chars, array_keys($this->chars), $value);
    }

    /**
     * Return value without last digit
     *
     * @return string
     */
    private function getValueWithoutLastDigit($value)
    {
        return substr($value, 0, -1);
    }

    /**
     * Return last digit of current value
     *
     * @return string
     */
    private function getLastDigit($value)
    {
        return substr($value, -1);
    }
}
