<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Isbn extends AbstractStringRule
{
    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        switch (strlen($this->getValue())) {
            case 10:
                return $this->shortChecksumMatches();
            
            case 13:
                return $this->longChecksumMatches();
        }

        return false;
    }

    /**
     * Determine if checksum for short ISBN numbers is valid
     *
     * @return bool
     */
    private function shortChecksumMatches()
    {
        return $this->getShortChecksum() % 11 === 0;
    }

    /**
     * Calculate checksum of short ISBN numbers
     *
     * @return int
     */
    private function getShortChecksum()
    {
        $checksum = 0;
        $multiplier = 10;
        foreach (str_split($this->getValue()) as $digit) {
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
    private function longChecksumMatches()
    {
        return $this->getLongChecksum() % 10 === 0;
    }

    /**
     * Calculate checksum for long ISBN numbers
     *
     * @return int
     */
    private function getLongChecksum()
    {
        $checksum = 0;
        foreach (str_split($this->getValue()) as $num => $digit) {
            $multiplier = $num % 2 ? 3 : 1;
            $checksum += intval($digit) * $multiplier;
        }

        return $checksum;
    }

    /**
     * Prepare value to validate
     *
     * @return string
     */
    public function getValue()
    {
        return preg_replace("/[^0-9x]/i", '', parent::getValue());
    }
}
