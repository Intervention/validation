<?php

namespace Intervention\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Validation\AbstractRule;

class Titlecase extends AbstractRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->getWords($value) as $word) {
            if (! $this->isValidWord($word)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get array of words from current value
     *
     * @return array
     */
    private function getWords($value): array
    {
        return explode(" ", $value);
    }

    /**
     * Determine if given word starts with upper case letter or number
     *
     * @param  string  $word
     * @return boolean
     */
    private function isValidWord(string $word): bool
    {
        return (bool) preg_match("/^[\p{Lu}0-9]/u", $word);
    }
}
