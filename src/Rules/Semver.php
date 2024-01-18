<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Semver extends AbstractRegexRule
{
    protected function pattern(): string
    {
        return "/^(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)" .
            "(?:-((?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*)" .
            "(?:\.(?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*))*))?" .
            "(?:\+([0-9a-zA-Z-]+(?:\.[0-9a-zA-Z-]+)*))?$/";
    }
}
