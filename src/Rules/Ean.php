<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Ean extends AbstractRule
{
    /**
     * Create a new rule instance.
     *
     * @param array<int> $lengths
     * @return void
     */
    public function __construct(private array $lengths = [8, 13])
    {
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        return is_numeric($value) && $this->hasAllowedLength($value) && $this->checksumMatches($value);
    }

    /**
     * Determine if the current value has the lengths of EAN-8 or EAN-13
     *
     * @param mixed $value
     * @return bool
     */
    protected function hasAllowedLength(mixed $value): bool
    {
        return in_array(strlen(strval($value)), $this->lengths);
    }

    /**
     * Try to calculate the EAN checksum of the
     * current value and check the matching.
     *
     * @param mixed $value
     * @return bool
     */
    protected function checksumMatches(mixed $value): bool
    {
        return $this->calculateChecksum($value) === $this->cutChecksum($value);
    }

    /**
     * Cut out the checksum of the current value and return
     *
     * @param mixed $value
     * @return int
     */
    private function cutChecksum(mixed $value): int
    {
        return intval(substr(strval($value), -1));
    }

    /**
     * Calculate modulo checksum of given value
     *
     * @param mixed $value
     * @return int
     */
    private function calculateChecksum(mixed $value): int
    {
        $checksum = 0;

        // chars without check digit in reverse
        $chars = array_reverse(str_split(substr(strval($value), 0, -1)));

        foreach ($chars as $key => $char) {
            $multiplier = $key % 2 ? 1 : 3;
            $checksum += intval($char) * $multiplier;
        }

        $remainder = $checksum % 10;

        if ($remainder === 0) {
            return 0;
        }

        return 10 - $remainder;
    }
}
