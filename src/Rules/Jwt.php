<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Jwt extends AbstractRegexRule
{
    /**
     * Regular expression pattern of JWT
     *
     * @var string
     */
    protected $pattern = "/^[a-zA-Z0-9-_]+\.[a-zA-Z0-9-_]+\.[a-zA-Z0-9-_]+$/";
}
