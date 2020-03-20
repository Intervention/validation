<?php

namespace Intervention\Validation\Rules;

class Creditcard extends Luhn
{
    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        return $this->hasValidLength() && parent::isValid();
    }

    /**
     * Check if the given value has the proper length for creditcards
     *
     * @return boolean
     */
    private function hasValidLength()
    {
        return (strlen($this->getValue()) >= 13 && strlen($this->getValue()) <= 19);
    }
}
