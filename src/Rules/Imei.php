<?php

namespace Intervention\Validation\Rules;

class Imei extends Luhn
{
    /**
     * Determine if current value is a valid IMEI
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        return $this->hasValidLength() && parent::isValid();
    }

    /**
     * Determine if current value has valid IMEI length
     *
     * @return boolean
     */
    private function hasValidLength()
    {
        return strlen($this->getValue()) == 15;
    }
}
