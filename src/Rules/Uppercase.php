<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRule;

class Uppercase extends AbstractRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value === $this->getUpperCaseValue($value);
    }

    /**
     * Return value as uppercase
     *
     * @return string
     */
    private function getUpperCaseValue($value): string
    {
        return mb_strtoupper($value, mb_detect_encoding($value));
    }
}
