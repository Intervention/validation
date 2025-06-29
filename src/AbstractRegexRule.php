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
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        return (bool) preg_match($this->pattern(), (string) $value);
    }
}
