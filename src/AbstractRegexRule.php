<?php

declare(strict_types=1);

namespace Intervention\Validation;

abstract class AbstractRegexRule extends AbstractRule
{
    /**
     * REGEX pattern of rule
     *
     * @return string
     */
    abstract protected function pattern(): string;

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        return (bool) preg_match($this->pattern(), $value);
    }
}
