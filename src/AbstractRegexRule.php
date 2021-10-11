<?php

namespace Intervention\Validation;

abstract class AbstractRegexRule extends AbstractRule
{
    /**
     * REGEX pattern of rule
     *
     * @var string
     */
    abstract protected function pattern(): string;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return (bool) preg_match($this->pattern(), $value);
    }
}
