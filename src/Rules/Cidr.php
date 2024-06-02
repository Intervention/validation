<?php

declare(strict_types=1);

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractRule;

class Cidr extends AbstractRule
{
    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    public function isValid(mixed $value): bool
    {
        // A CIDR should consist of an IP part and a mask bit number delimited by a `/`

        // split by the slash that should be there
        $parts = explode('/', $value, 2);
        // we should have 2 parts (the ip and mask)
        if (count($parts) !== 2) {
            return false;
        }

        // validate the ip part
        if (filter_var($parts[0], FILTER_VALIDATE_IP) === false) {
            return false;
        }

        // check the mask part
        // first of all, this should be an integer
        if (filter_var($parts[1], FILTER_VALIDATE_INT) === false) {
            return false;
        }

        // and it should be between 0 and 32 inclusive
        if ($parts[1] < 0 || $parts[1] > 32) {
            return false;
        }

        return true;
    }
}
