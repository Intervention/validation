<?php

namespace Intervention\Validation;

abstract class AbstractRegexRule extends AbstractStringRule
{
    /**
     * REGEX pattern of rule
     *
     * @var string
     */
    protected $pattern;

    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid()
    {
        return (boolean) preg_match($this->pattern, $this->getValue());
    }
}
