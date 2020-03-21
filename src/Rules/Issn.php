<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Issn extends AbstractRegexRule
{
    /**
     * Regular expression pattern for ISSN
     *
     * @var string
     */
    protected $pattern = "/^[0-9]{4}-[0-9]{3}[0-9xX]$/";

    /**
     * Determine if current value is valid ISSN
     * Check regex pattern and checksum
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return parent::isValid() && $this->checkSumMatches();
    }

    /**
     * Determine if checksum matches
     *
     * @return bool
     */
    private function checkSumMatches(): bool
    {
        return $this->calculateChecksum() === $this->parseChecksum();
    }

    /**
     * Calculate checksum from the current value
     *
     * @return int
     */
    private function calculateChecksum(): int
    {
        $checksum = 0;
        $issn_numbers = str_replace('-', '', $this->getValue());

        foreach (range(8, 2) as $num => $multiplicator) {
            $checksum += $issn_numbers[$num] * $multiplicator;
        }

        $remainder = ($checksum % 11);

        return $remainder === 0 ? 0 : 11 - $remainder;
    }

    /**
     * Parse attached checksum of current value (last digit)
     *
     * @return int
     */
    private function parseChecksum(): int
    {
        $last = substr($this->getValue(), -1);
        
        return strtolower($last) === 'x' ? 10 : intval($last);
    }
}
