<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Validation\AbstractRegexRule;

class Kebabcase extends AbstractRegexRule implements ValidationRule
{
    protected function pattern(): string
    {
        return "/^(?:\p{Ll}+\-)*\p{Ll}+$/u";
    }
}
