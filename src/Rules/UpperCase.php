<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Uppercase extends AbstractRegexRule
{
    /**
     * Regular expression pattern for UPPER CASE string
     *
     * @var string
     */
    protected $pattern = "/^\p{Lu}+$/u";
}
