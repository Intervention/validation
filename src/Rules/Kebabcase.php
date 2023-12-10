<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Kebabcase extends AbstractRegexRule
{
    protected function pattern(): string
    {
        return "/^(?:\p{Ll}+\-)*\p{Ll}+$/u";
    }
}
