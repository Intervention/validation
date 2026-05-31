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
        $encoding = mb_detect_encoding((string) $value);

        if ($encoding === false) {
            return false;
        }

        $lowerCaseValue = mb_strtolower(strval($value), $encoding);

        return $value === $lowerCaseValue;
    }
}
