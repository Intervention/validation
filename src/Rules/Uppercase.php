<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Validation\AbstractRule;

class Uppercase extends AbstractRule implements ValidationRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes(string $attribute, mixed $value): bool
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
