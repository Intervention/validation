<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Titlecase extends AbstractStringRule
{
    /**
     * Determine if current value is valid Title Case
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        foreach ($this->getWords() as $word) {
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
    private function getWords(): array
    {
        return explode(" ", parent::getValue());
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
