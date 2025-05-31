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
        $value = preg_replace("/[^0-9x]/i", '', (string) $value);

        if (!$this->hasAllowedLength($value)) {
            return false;
        }

        return match (strlen((string) $value)) {
            10 => $this->shortChecksumMatches($value),
            13 => preg_match("/^(978|979)/", (string) $value) && parent::checksumMatches($value),
            default => false,
        };
    }

    /**
     * Determine if checksum for ISBN-10 numbers is valid
     */
    private function shortChecksumMatches(string $value): bool
    {
        return $this->shortChecksum($value) % 11 === 0;
    }

    /**
     * Calculate checksum of short ISBN numbers
     */
    private function shortChecksum(string $value): int
    {
        $checksum = 0;
        $multiplier = 10;
        foreach (str_split($value) as $digit) {
            $digit = strtolower($digit) === 'x' ? 10 : intval($digit);
            $checksum += $digit * $multiplier;
            $multiplier--;
        }

        return $checksum;
    }
}
