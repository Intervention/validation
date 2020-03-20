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
     *  - minimum of 3 character and maximum of 20 characters
     *
     * @var string
     */
    protected $pattern = "/^[a-z][a-z0-9]*(?:[_\-][a-z0-9]+)*$/i";

    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        return $this->hasValidLength() && parent::isValid();
    }

    /**
     * Check if the given value has the proper length
     *
     * @return boolean
     */
    private function hasValidLength(): bool
    {
        return (strlen($this->getValue()) >= 3 && strlen($this->getValue()) <= 20);
    }
}
