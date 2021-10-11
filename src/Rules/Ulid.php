<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRegexRule;

class Ulid extends AbstractRegexRule implements Rule
{
    protected function pattern(): string
    {
        return "/^[0123456789ABCDEFGHJKMNPQRSTVWXYZ]{10}[0123456789ABCDEFGHJKMNPQRSTVWXYZ]{16}$/i";
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (! parent::passes($attribute, $value)) {
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
