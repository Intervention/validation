<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Validation\AbstractRegexRule;

class Snakecase extends AbstractRegexRule implements ValidationRule
{
    protected function pattern(): string
    {
        return "/^(?:\p{Ll}+_)*\p{Ll}+$/u";
    }
}
