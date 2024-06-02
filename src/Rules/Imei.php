<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

class Imei extends Luhn
{
    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        return $this->hasValidLength($value) && parent::isValid($value);
    }

    /**
     * Determine if current value has valid IMEI length
     *
     * @param string $value
     * @return bool
     */
    private function hasValidLength(string $value): bool
    {
        return strlen($value) === 15;
    }
}
