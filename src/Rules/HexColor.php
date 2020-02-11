<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class HexColor extends AbstractRegexRule
{
    protected $pattern = "/^#?([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/";
}
