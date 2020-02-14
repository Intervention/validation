<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Isin extends AbstractStringRule
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
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid()
    {
        return $this->getCheckDigit() == $this->getChecksum();
    }

    /**
     * Return check digit of current value
     *
     * @return int
     */
    private function getCheckDigit()
    {
        return substr($this->getValue(), -1);
    }

    /**
     * Get checksum of current value
     *
     * @return int
     */
    private function getChecksum()
    {
        $value = substr($this->getValue(), 0, -1);
        $value = str_replace($this->chars, array_keys($this->chars), $value);

        $g1 = [];
        $g2 = [];

        foreach (str_split($value) as $key => $num) {
            if ($key % 2 == 0) {
                $g1[] = intval($num);
            } else {
                $g2[] = intval($num);
            }
        }

        foreach ($g1 as $key => $num) {
            $g1[$key] = $num * 2;
        }

        $checksum = array_sum(str_split(implode('', $g1).implode('', $g2)));
        $checksum = 10 - ($checksum % 10);
        $checksum = $checksum % 10;

        return $checksum;
    }
}
