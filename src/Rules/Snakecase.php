<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRegexRule;

class Snakecase extends AbstractRegexRule implements Rule
{
    protected function pattern(): string
    {
        return "/^(?:\p{Ll}+_)*\p{Ll}+$/u";
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
