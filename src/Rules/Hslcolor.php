<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Hslcolor extends AbstractRegexRule
{
    /**
     * {@inheritdoc}
     *
     * @see AbstractRegexRule::pattern()
     */
    protected function pattern(): string
    {
        return '/^hsl\((?P<h>[0-9\.]+), ?(?P<s>[0-9\.]+%?), ?(?P<l>[0-9\.]+%?)?\)$/i';
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        $result = preg_match($this->pattern(), strval($value), $matches);

        if ($result !== 1) {
            return false;
        }

        if (!in_array(intval($matches['h']), range(0, 360))) {
            return false;
        }

        if (!in_array(intval($matches['s']), range(0, 100))) {
            return false;
        }

        if (!in_array(intval($matches['l']), range(0, 100))) {
            return false;
        }

        return true;
    }
}
