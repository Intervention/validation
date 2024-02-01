<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Ulid extends AbstractRegexRule
{
    protected function pattern(): string
    {
        return "/^[0123456789ABCDEFGHJKMNPQRSTVWXYZ]{10}[0123456789ABCDEFGHJKMNPQRSTVWXYZ]{16}$/i";
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param mixed $value
     * @return bool
     */
    public function isValid(mixed $value): bool
    {
        if (!parent::isValid($value)) {
            return false;
        }

        if ($this->ulidTooLarge($value)) {
            return false;
        }

        return true;
    }

    /**
     * Determine if current ulid has exceeded maximum size
     *
     * @return bool
     */
    protected function ulidTooLarge($value): bool
    {
        return intval($value[0]) > 7;
    }
}
