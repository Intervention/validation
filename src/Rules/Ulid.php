<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRegexRule;

class Ulid extends AbstractRegexRule
{
    /**
     * {@inheritdoc}
     *
     * @see AbstractRegexRule::pattern()
     */
    protected function pattern(): string
    {
        return "/^[0123456789ABCDEFGHJKMNPQRSTVWXYZ]{10}[0123456789ABCDEFGHJKMNPQRSTVWXYZ]{16}$/i";
    }

    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        if (!parent::isValid($value)) {
            return false;
        }

        if ($this->ulidTooLarge($value)) {
            return false;
        }

        return true;
    }

    /**
     * Determine if current ulid has exceeded maximum size

     * @param string $value
     * @return bool
     */
    private function ulidTooLarge(string $value): bool
    {
        return intval($value[0]) > 7;
    }
}
