<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Lowercase extends AbstractRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid(mixed $value): bool
    {
        return $value === $this->getLowerCaseValue($value);
    }

    /**
     * Return value as lowercase
     *
     * @return string
     */
    private function getLowerCaseValue($value): string
    {
        return mb_strtolower($value, mb_detect_encoding($value));
    }
}
