<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Lowercase extends AbstractStringRule
{
    /**
     * Determine if value is lowercase
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        return $this->getValue() === $this->getLowerCaseValue();
    }

    /**
     * Return value as lowercase
     *
     * @return string
     */
    private function getLowerCaseValue(): string
    {
        return mb_strtolower($this->getValue(), mb_detect_encoding($this->getValue()));
    }
}
