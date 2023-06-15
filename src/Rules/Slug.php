<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Validation\AbstractRegexRule;

class Slug extends AbstractRegexRule implements ValidationRule
{
    protected function pattern(): string
    {
        return "/^[a-z0-9]+(?:-[a-z0-9]+)*$/i";
    }
}
