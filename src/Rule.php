<?php

declare(strict_types=1);

namespace Intervention\Validation;

interface Rule
{
    /**
     * Checks if the given value is valid in the scope of the current rule
     */
    public function isValid(mixed $value): bool;
}
