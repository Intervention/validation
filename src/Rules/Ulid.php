<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;
use Intervention\Validation\Rules\Base64;

class Ulid extends AbstractRegexRule
{
    /**
     * Data url pattern
     *
     * @var string
     */
    protected $pattern = "/^[0123456789ABCDEFGHJKMNPQRSTVWXYZ]{10}[0123456789ABCDEFGHJKMNPQRSTVWXYZ]{16}$/i";

    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        if (! parent::isValid()) {
            return false;
        }

        if ($this->ulidTooLarge()) {
            return false;
        }

        return true;
    }

    /**
     * Determine if current ulid has exceeded maximum size
     *
     * @return bool
     */
    protected function ulidTooLarge(): bool
    {
        return $this->getValue()[0] > 7;
    }
}
