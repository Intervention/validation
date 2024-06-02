<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

class Creditcard extends Luhn
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
     * Check if the given value has the proper length for creditcards
     *
     * @param mixed $value
     * @return bool
     */
    private function hasValidLength(mixed $value): bool
    {
        return (strlen(strval($value)) >= 13 && strlen(strval($value)) <= 19);
    }
}
