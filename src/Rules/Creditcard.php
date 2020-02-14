<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractLuhnRule;

class Creditcard extends AbstractLuhnRule
{
    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid()
    {
        return $this->hasValidLength() && parent::isValid();
    }

    /**
     * Check if the given value has the proper length for creditcards
     *
     * @param  mixed  $value
     * @return boolean
     */
    private function hasValidLength()
    {
        return (strlen($this->getValue()) >= 13 && strlen($this->getValue()) <= 19);
    }
}
