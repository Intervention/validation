<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Base64 extends AbstractRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid(mixed $value): bool
    {
        $decoded = base64_decode($value, true);

        return $decoded ? base64_encode($decoded) === $value : false;
    }
}
