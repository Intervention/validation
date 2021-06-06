<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Hexcolor extends AbstractRegexRule
{
    /**
     * Regular expression pattern for RGB hex color
     *
     * @var string
     */
    protected $pattern = "/^#?([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/";

    /**
     * Determine if validation was successful
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        if ($this->hasLengthAttribute() && !$this->hasCorrectLength()) {
            return false;
        }

        return parent::isValid();
    }

    protected function hasLengthAttribute(): bool
    {
        return is_numeric($this->getAttribute(0));
    }

    protected function hasCorrectLength(): bool
    {
        return strlen(trim($this->getValue(), '#')) === intval($this->getAttribute(0));
    }
}
