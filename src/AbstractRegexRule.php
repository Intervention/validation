<?php

namespace Intervention\Validation;

abstract class AbstractRegexRule extends AbstractRule
{
    /**
     * REGEX pattern of rule
     */
    abstract protected function pattern(): string;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes(string $attribute, mixed $value): bool
    {
        return (bool) preg_match($this->pattern(), $value);
    }
}
