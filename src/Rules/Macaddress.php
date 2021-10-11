<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRegexRule;

class Macaddress extends AbstractRegexRule implements Rule
{
    protected function pattern(): string
    {
        return "/^[0-9a-f]{12}$/i";
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
        $value = preg_replace("/[\. :-]/i", '', $value);

        return parent::passes($attribute, $value);
    }
}
