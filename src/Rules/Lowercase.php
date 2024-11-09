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
        $lowerCaseValue = mb_strtolower(strval($value), mb_detect_encoding($value));

        return $value === $lowerCaseValue;
    }
}
