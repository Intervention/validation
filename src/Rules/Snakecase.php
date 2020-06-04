<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Snakecase extends AbstractRegexRule
{
    /**
     * Regular expression pattern for snake_case string
     *
     * @var string
     */
    protected $pattern = "/^(?:\p{Ll}+_)*\p{Ll}+$/u";
}
