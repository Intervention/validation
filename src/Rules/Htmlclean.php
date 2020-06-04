<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Htmlclean extends AbstractStringRule
{
    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        return (strip_tags($this->getValue()) == $this->getValue());
    }
}
