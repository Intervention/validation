<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Username extends AbstractRegexRule
{
    /**
     * Pattern for "valid" username
     *  - only alpha-numeric (a-z, A-Z, 0-9), underscore and minus
     *  - starts with an letter (alpha)
     *  - minimum of 3 character and maximum of 20 characters
     *
     * @var string
     */
    protected $pattern = "/^[a-z][a-z\d_\-]{2,19}$/i";
}
