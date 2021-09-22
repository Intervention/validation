<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Lowercase implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
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

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'fails';
    }
}
