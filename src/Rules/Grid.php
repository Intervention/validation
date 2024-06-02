<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Grid extends AbstractRegexRule
{
    /**
     * {@inheritdoc}
     *
     * @see AbstractRegexRule::pattern()
     */
    protected function pattern(): string
    {
        return "/^(GRID:)?(?P<grid>A1-?[A-Z0-9]{5}-?[A-Z0-9]{10}-?[A-Z0-9])$/";
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        return is_string($value)
            && parent::isValid(strtoupper($value))
            && $this->hasValidChecksum($value);
    }

    /**
     * Calculate checksum from given grid number
     *
     * @param string $value
     * @return bool
     */
    private function hasValidChecksum(string $value): bool
    {
        // get GRid from value
        preg_match($this->pattern(), strtoupper($value), $matches);

        // split GRid into single characters (without dashes)
        $characters = str_split(
            str_replace('-', '', $matches['grid'])
        );

        // extract last (check) character
        $checkCharacter = array_pop($characters);

        $m = 36;
        $n = 37;
        $product = $m;
        $sum = 0;

        // calculate checksum
        foreach ($characters as $char) {
            $sum = ($product + $this->charValue($char)) % $m;
            $sum = $sum === 0 ? $m : $sum;
            $product = ($sum * 2) % $n;
        }

        // compare checksum to check character value
        return $n - $product === $this->charValue($checkCharacter);
    }

    /**
     * Get character value according to GRid standard v2.1
     *
     * @param string $char
     * @return int
     */
    private function charValue(string $char): int
    {
        return is_numeric($char) ? (int) $char : (int) str_replace(range('A', 'Z'), range(10, 35), strtoupper($char));
    }
}
