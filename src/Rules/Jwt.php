<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Validation\AbstractRegexRule;

class Jwt extends AbstractRegexRule implements ValidationRule
{
    protected function pattern(): string
    {
        return "/^[a-zA-Z0-9-_]+\.[a-zA-Z0-9-_]+\.[a-zA-Z0-9-_]+$/";
    }
}
