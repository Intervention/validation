<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRegexRule;

class Kebabcase extends AbstractRegexRule
{
    protected function pattern(): string
    {
        return "/^(?:\p{Ll}+\-)*\p{Ll}+$/u";
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
