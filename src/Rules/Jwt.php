<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRegexRule;

class Jwt extends AbstractRegexRule
{
    protected function pattern(): string
    {
        return "/^[a-zA-Z0-9-_]+\.[a-zA-Z0-9-_]+\.[a-zA-Z0-9-_]+$/";
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
