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
        foreach ($this->words($value) as $word) {
            if (!$this->isValidWord($word)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get array of words from current value
     *
     * @return array<string>
     */
    private function words(mixed $value): array
    {
        return explode(" ", (string) $value);
    }

    /**
     * Determine if given word starts with upper case letter or number
     */
    private function isValidWord(string $word): bool
    {
        return (bool) preg_match("/^[\p{Lu}0-9]/u", $word);
    }
}
