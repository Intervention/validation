<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class Imei extends Luhn implements ValidationRule
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
        return $this->hasValidLength($value) && parent::passes($attribute, $value);
    }

    /**
     * Determine if current value has valid IMEI length
     *
     * @return boolean
     */
    private function hasValidLength($value): bool
    {
        return strlen($value) === 15;
    }
}
