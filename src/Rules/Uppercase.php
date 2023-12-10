<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Uppercase extends AbstractRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function isValid(mixed $value): bool
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
