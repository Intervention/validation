<?php

namespace Intervention\Validation\Rules;

use Intervention\Validation\AbstractStringRule;

class Cidr extends AbstractStringRule
{
    /**
     * Determine if current input is valid
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        // A CIDR should consist of an IP part and a mask bit number delimited by a `/`

        // split in by the slash that should be there
        $sCidr = explode('/', $this->getValue(), 2);
        // we should have 2 parts (the ip and mask)
        if (count($sCidr) !== 2) {
            return false;
        }

        // validate the ip part
        if (filter_var($sCidr[0], FILTER_VALIDATE_IP) === false) {
            return false;
        }

        // check the mask part
        // first of all, this should be an integer
        if (filter_var($sCidr[1], FILTER_VALIDATE_INT) === false) {
            return false;
        }

        // and it should be between 0 and 32 inclusive
        if ($sCidr[1] < 0 || $sCidr[1] > 32) {
            return false;
        }
        
        return true;
    }
}
