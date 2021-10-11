<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;
use Illuminate\Contracts\Validation\Rule;

class Hexcolor extends AbstractRegexRule implements Rule
{
    /**
     * Allowed lengths of hexcolor
     *
     * @var array
     */
    protected $lengths = [
        3,
        6,
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
        return "/^#?([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/";
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (! $this->hasAllowedLength($value)) {
            return false;
        }

        return parent::passes($attribute, $value);
    }

    /**
     * Determine if the current value has the lenghts of EAN-8 or EAN-13
     *
     * @return boolean
     */
    public function hasAllowedLength($value): bool
    {
        return in_array(strlen(trim($value, '#')), $this->lengths);
    }
}
