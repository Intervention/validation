<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Titlecase extends AbstractRule
{
    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        foreach ($this->getWords($value) as $word) {
            if (!$this->isValidWord($word)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get array of words from current value
     *
     * @param mixed $value
     * @return array<string>
     */
    private function getWords(mixed $value): array
    {
        return explode(" ", $value);
    }

    /**
     * Determine if given word starts with upper case letter or number
     *
     * @param string $word
     * @return bool
     */
    private function isValidWord(string $word): bool
    {
        return (bool) preg_match("/^[\p{Lu}0-9]/u", $word);
    }
}
