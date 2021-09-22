<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Htmlclean implements Rule
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
        return (strip_tags($value) == $value);
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
