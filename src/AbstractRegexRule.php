<?php

declare(strict_types=1);

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
     * @param mixed $value
     * @return bool
     */
    public function isValid(mixed $value): bool
    {
        return (bool) preg_match($this->pattern(), $value);
    }
}
