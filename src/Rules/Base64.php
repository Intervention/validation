<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Base64 extends AbstractRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function isValid(mixed $value): bool
    {
        return base64_encode(base64_decode($value, true)) === $value;
    }
}
