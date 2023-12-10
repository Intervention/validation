<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Hexadecimalcolor extends AbstractRegexRule
{
    /**
     * Allowed lengths of hexcolor
     *
     * @var array
     */
    protected $lengths = [
        3,
        4,
        6,
        8,
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

    protected function pattern(): string
    {
        return '/^#?(?P<hex>[a-f\d]{3}(?:[a-f\d]?|(?:[a-f\d]{3}(?:[a-f\d]{2})?)?)\b)$/i';
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
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
     * Determine if the current value has correct lenght
     *
     * @return boolean
     */
    public function hasAllowedLength($value): bool
    {
        return in_array(strlen(trim($value, '#')), $this->lengths);
    }
}
