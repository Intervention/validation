<?php

namespace Intervention\Validation\Rules;

class Imei extends Luhn
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
     * Determine if current value has valid IMEI length
     *
     * @return boolean
     */
    private function hasValidLength($value): bool
    {
        return strlen($value) === 15;
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
