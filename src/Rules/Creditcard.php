<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class Creditcard extends Luhn implements ValidationRule
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
     * Check if the given value has the proper length for creditcards
     *
     * @return boolean
     */
    private function hasValidLength($value): bool
    {
        return (strlen($value) >= 13 && strlen($value) <= 19);
    }
}
