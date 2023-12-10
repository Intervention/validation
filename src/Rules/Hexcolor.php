<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Validation\AbstractRegexRule;

class Hexcolor extends AbstractRegexRule implements ValidationRule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes(string $attribute, mixed $value): bool
    {
        if (!$this->hasAllowedLength($value)) {
            return false;
        }

        return parent::passes($attribute, $value);
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
