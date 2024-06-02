<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

class Isbn extends Ean
{
    /**
     * @param array<int> $lengths
     * @return void
     */
    public function __construct(private array $lengths = [10, 13])
    {
        parent::__construct($this->lengths);
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        // normalize value
        $value = preg_replace("/[^0-9x]/i", '', $value);

        if (!$this->hasAllowedLength($value)) {
            return false;
        }

        switch (strlen($value)) {
            case 10:
                return $this->shortChecksumMatches($value);

            case 13: // isbn-13 is a subset of ean-13
                return preg_match("/^(978|979)/", $value) && parent::checksumMatches($value);
        }

        return false;
    }

    /**
     * Determine if checksum for ISBN-10 numbers is valid
     *
     * @param string $value
     * @return bool
     */
    private function shortChecksumMatches(string $value): bool
    {
        return $this->getShortChecksum($value) % 11 === 0;
    }

    /**
     * Calculate checksum of short ISBN numbers
     *
     * @param string $value
     * @return int
     */
    private function getShortChecksum(string $value): int
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
