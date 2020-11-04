<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Date extends AbstractRegexRule
{
    /**
     * Determine if current value is a valid Date
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        if (!$this->isInputValid()) {
            return false;
        }
        
        return strtotime($this->getValue());
    }

    /**
     * Determine if the format is valid
     *
     * @return string
     */
    private function isInputValid()
    {
        if (preg_match('/^(\d{4}|((\d{1,2}|\d{4})\.?\d{1,2}\.(\d{1,2}|\d{4}))|((\d{1,2}|\d{4})\-?\d{1,2}\-(\d{1,2}|\d{4}))|((\d{1,2}|\d{4})\/?\d{1,2}\/(\d{1,2}|\d{4})))$/', $this->getValue())) {
            return true;
        }
  
        return false;
    }
}
