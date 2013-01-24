<?php

namespace Intervention\Validation;

class Validator
{
    public function isIban($value)
    {
        // build replacement arrays
        $iban_replace_chars = range('A', 'Z');
        foreach (range(10, 35) as $tempvalue) {
            $iban_replace_values[] = strval($tempvalue);
        }
    
        // prepare string
        $tempiban = strtoupper($value);
        $tempiban = str_replace(' ', '', $tempiban);
    
        // build checksum
        $tempiban = substr($tempiban, 4).substr($tempiban, 0, 4);
        $tempiban = str_replace($iban_replace_chars, $iban_replace_values, $tempiban);
        $tempcheckvalue = intval(substr($tempiban, 0, 1));
        
        for ($strcounter = 1; $strcounter < strlen($tempiban); $strcounter++) {
            $tempcheckvalue *= 10; 
            $tempcheckvalue += intval(substr($tempiban,$strcounter,1));
            $tempcheckvalue %= 97;
        }
    
        // only modulo 1 is iban
        return $tempcheckvalue == 1;
    }

    public function isBic($value)
    {
        $pattern = '/^[A-Za-z]{4,} ?[A-Za-z]{2,} ?[A-Za-z0-9]{2,} ?([A-Za-z0-9]{3,})?$/';       
        return (boolean) preg_match($pattern, $value);
    }

    public function isHexcolor($value)
    {
        $pattern = '/^#?[a-fA-F0-9]{3,6}$/';
        return (boolean) preg_match($pattern, $value);
    }

    public function isCreditcard($value)
    {
        $length = strlen($value);

        if ($length < 13 || $length > 19) {
            return false;
        }

        $sum = 0;
        $weight = 2;

        for ($i = $length - 2; $i >= 0; $i--) {
            $digit = $weight * $value[$i];
            $sum += floor($digit / 10) + $digit % 10;
            $weight = $weight % 2 + 1;
        }

        $mod = (10 - $sum % 10) % 10;

        return ($mod == $value[$length - 1]);
    }
}