<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Intervention\Validation\AbstractRegexRule;

class Bic extends AbstractRegexRule implements ValidationRule
{
    protected function pattern(): string
    {
        return "/^[A-Za-z]{4} ?[A-Za-z]{2} ?[A-Za-z0-9]{2} ?([A-Za-z0-9]{3})?$/";
    }
}
