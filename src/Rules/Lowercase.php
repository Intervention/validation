<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Validation\AbstractRule;

class Lowercase extends AbstractRule implements ValidationRule
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
        return $value === $this->getLowerCaseValue($value);
    }

    /**
     * Return value as lowercase
     *
     * @return string
     */
    private function getLowerCaseValue($value): string
    {
        return mb_strtolower($value, mb_detect_encoding($value));
    }
}
