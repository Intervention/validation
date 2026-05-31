<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Uppercase extends AbstractRule
{
    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        $encoding = mb_detect_encoding((string) $value);

        if ($encoding === false) {
            return false;
        }

        $upperCaseValue = mb_strtoupper(strval($value), $encoding);

        return $value === $upperCaseValue;
    }
}
