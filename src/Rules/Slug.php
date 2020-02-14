<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Slug extends AbstractRegexRule
{
    protected $pattern = "/^[a-z0-9]+(?:-[a-z0-9]+)*$/i";
}
