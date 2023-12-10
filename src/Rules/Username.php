<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Username extends AbstractRegexRule
{
    /**
     * Pattern for "valid" username
     *  - only alpha-numeric (a-z, A-Z, 0-9), underscore and minus
     *  - starts with an letter (alpha)
     *  - underscores and minus are not allowed at the beginning or end
     *  - multiple underscores and minus are not allowed (-- or _____)
     */
    protected function pattern(): string
    {
        return "/^[a-z][a-z0-9]*(?:[_\-][a-z0-9]+)*$/i";
    }
}
