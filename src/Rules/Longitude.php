<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Longitude extends AbstractRegexRule
{
    protected function pattern(): string
    {
        return "/^[+-]?(180(\.0+)?|1[0-7]\d(\.\d+)?|\d{1,2}(\.\d+)?)\)?$/";
    }
}
