<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Domainname extends AbstractRegexRule
{
    protected $pattern = "/^(?!\-)(?:[a-zA-Z\d\-]{0,62}[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/";

    /**
     * Determine if current input is valid
     *
     * @return boolean
     */
    public function isValid()
    {
        if (strlen($this->getValue()) > 253) {
            return false;
        }

        return parent::isValid();
    }
}
