<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Hexadecimalcolor extends AbstractRegexRule
{
    /**
     * Create a new rule instance.
     *
     * @param array<int> $lengths
     * @return void
     */
    public function __construct(protected array $lengths = [3, 4, 6, 8])
    {
    }

    protected function pattern(): string
    {
        return '/^#?(?P<hex>[a-f\d]{3}(?:[a-f\d]?|(?:[a-f\d]{3}(?:[a-f\d]{2})?)?)\b)$/i';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid(mixed $value): bool
    {
        if (!$this->hasAllowedLength($value)) {
            return false;
        }

        return parent::isValid($value);
    }

    /**
     * Determine if the current value has correct length
     *
     * @param mixed $value
     * @return bool
     */
    public function hasAllowedLength(mixed $value): bool
    {
        return in_array(strlen(trim(strval($value), '#')), $this->lengths);
    }
}
