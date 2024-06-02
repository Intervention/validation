<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Hsvcolor extends AbstractRegexRule
{
    /**
     * {@inheritdoc}
     *
     * @see AbstractRegexRule::pattern()
     */
    protected function pattern(): string
    {
        return '/^hs(v|b)\((?P<h>[0-9\.]+), ?(?P<s>[0-9\.]+%?), ?(?P<v>[0-9\.]+%?)?\)$/i';
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

        if (!in_array(intval($matches['v']), range(0, 100))) {
            return false;
        }

        return true;
    }
}
