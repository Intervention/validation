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
        $upperCaseValue = mb_strtoupper(strval($value), mb_detect_encoding($value));

        return $value === $upperCaseValue;
    }
}
