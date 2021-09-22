<?php

namespace Intervention\Validation\Rules;

class Creditcard extends Luhn
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

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'fails';
    }
}
