<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Snakecase extends AbstractRegexRule
{
    protected function pattern(): string
    {
        return "/^(?:\p{Ll}+_)*\p{Ll}+$/u";
    }
}
