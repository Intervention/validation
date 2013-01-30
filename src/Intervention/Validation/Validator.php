<?php

namespace Intervention\Validation;

class Validator
{
    /**
     * Checks if given value is valid International Bank Account Number (IBAN).
     * 
     * @param  mixed  $value
     * @return boolean 
     */
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

    /**
     * Checks if given value is valid International Bank Account Number (IBAN).
     * 
     * @param  mixed  $value
     * @return boolean       
     */
    public function isBic($value)
    {
        $pattern = '/^[A-Za-z]{4,} ?[A-Za-z]{2,} ?[A-Za-z0-9]{2,} ?([A-Za-z0-9]{3,})?$/';       
        return (boolean) preg_match($pattern, $value);
    }

    /**
     * Checks if value is valid hexadecimal color code.
     * 
     * @param  mixed  $value
     * @return boolean        
     */
    public function isHexcolor($value)
    {
        $pattern = '/^#?[a-fA-F0-9]{3,6}$/';
        return (boolean) preg_match($pattern, $value);
    }

    /**
     * Checks if value is valid creditcard number.
     * 
     * @param  mixed  $value 
     * @return boolean        
     */
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


    /**
     * Checks if given value is valid International Standard Book Number (ISBN).
     * 
     * @param  mixed  $value
     * @return boolean        
     */
    public function isIsbn($value)
    {
        $value = str_replace(array(' ', '-', '.'), '', $value);
        $length = strlen($value);
        $checkdigit = substr($value, -1);

        if ($length == 10) {

            if ( ! is_numeric(substr($value, -10, 9))) {
                return false;
            }

            $checkdigit = ( ! is_numeric($checkdigit)) ? $checkdigit : strtoupper($checkdigit);
            $checkdigit = ($checkdigit == 'X') ? '10' : $checkdigit;

            $sum = 0;

            for ($i = 0; $i < 9; $i++) {
                $sum = $sum + ($value[$i] * (10 - $i));
            }

            $sum = $sum + $checkdigit;
            $mod = $sum % 11;

            return ($mod == 0);

        } elseif ($length == 13) {
            
            $sum = 0;

            $sum =  $value[0] + ($value[1] * 3) + $value[2] + ($value[3] * 3) +
                    $value[4] + ($value[5] * 3) + $value[6] + ($value[7] * 3) +
                    $value[8] + ($value[9] * 3) + $value[10] + ($value[11] * 3);

            $mod = $sum % 10;

            $correct_checkdigit = 10 - $mod;
            $correct_checkdigit = ($correct_checkdigit == "10") ? "0" : $correct_checkdigit;

            return ($checkdigit == $correct_checkdigit);

        }

        return false;
    }

    /**
     * Checks if given value is date in ISO 8601 format.
     * 
     * @param  mixed  $value 
     * @return boolean        
     */
    public function isIsodate($value)
    {
        $pattern = '/^([\+-]?\d{4}(?!\d{2}\b))((-?)((0[1-9]|1[0-2])(\3([12]\d|0[1-9]|3[01]))?|W([0-4]\d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]\d|[12]\d{2}|3([0-5]\d|6[1-6])))([T\s]((([01]\d|2[0-3])((:?)[0-5]\d)?|24\:?00)([\.,]\d+(?!:))?)?(\17[0-5]\d([\.,]\d+)?)?([zZ]|([\+-])([01]\d|2[0-3]):?([0-5]\d)?)?)?)?$/';
        return (boolean) preg_match($pattern, $value);
    }

    /**
     * Checks if value is Username
     *        
     * @param  mixed  $value
     * @return boolean
     */
    public function isUsername($value)
    {
        // username consists of alpha-numeric (a-z, A-Z, 0-9), underscores
        // starts with a alpha letter
        // and has minimum of 3 character and maximum of 20 characters
        $pattern = '/^[a-z][a-z\d_]{2,20}$/i';
        return (boolean) preg_match($pattern, $value);
    }
}