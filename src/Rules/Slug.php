<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRegexRule;

class Slug extends AbstractRegexRule implements Rule
{
    protected function pattern(): string
    {
        return "/^[a-z0-9]+(?:-[a-z0-9]+)*$/i";
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
