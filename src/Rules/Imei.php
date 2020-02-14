<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractLuhnRule;

class Imei extends AbstractLuhnRule
{
    /**
     * Determine if current value is a valid IMEI
     *
     * @return boolean
     */
    public function isValid()
    {
        return $this->hasValidLength() && parent::isValid();
    }

    private function hasValidLength()
    {
        return strlen($this->getValue()) == 15;
    }
}
