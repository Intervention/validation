<?php

namespace Intervention\Validation\Rules;

class Creditcard extends Luhn
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  mixed  $value
     * @return bool
     */
    public function isValid(mixed $value): bool
    {
        return $this->hasValidLength($value) && parent::isValid($value);
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
