<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Validation\AbstractRegexRule;

class Camelcase extends AbstractRegexRule implements ValidationRule
{
    protected function pattern(): string
    {
        return "/^(?:\p{Lu}?\p{Ll}+)(?:\p{Lu}\p{Ll}+)*$/u";
    }
}
