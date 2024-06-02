<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Lowercase extends AbstractRule
{
    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        return $value === $this->getLowerCaseValue($value);
    }

    /**
     * Return value as lowercase
     *
     * @param mixed $value
     * @return string
     */
    private function getLowerCaseValue(mixed $value): string
    {
        return mb_strtolower(strval($value), mb_detect_encoding($value));
    }
}
