<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Htmlclean extends AbstractRule
{
    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        if (is_null($value)) {
            return true;
        }

        return (strip_tags($value) ==  $value);
    }
}
