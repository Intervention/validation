<?php

namespace Intervention\Validation;

class Validator
{
    /**
     * Checks if given value is
     * International Securities Identification Number (ISIN)
     *
     * @param  mixed  $value
     * @return boolean
     */
    public static function isIsin($value)
    {
        $chars = array(
             10 => 'A',
             11 => 'B',
             12 => 'C',
             13 => 'D',
             14 => 'E',
             15 => 'F',
             16 => 'G',
             17 => 'H',
             18 => 'I',
             19 => 'J',
             20 => 'K',
             21 => 'L',
             22 => 'M',
             23 => 'N',
             24 => 'O',
             25 => 'P',
             26 => 'Q',
             27 => 'R',
             28 => 'S',
             29 => 'T',
             30 => 'U',
             31 => 'V',
             32 => 'W',
             33 => 'X',
             34 => 'Y',
             35 => 'Z',
        );

        $checkdigit = substr($value, -1);

        $value = substr($value, 0, -1);
        $value = str_replace($chars, array_keys($chars), $value);

        $g1 = array();
        $g2 = array();

        foreach (str_split($value) as $key => $num) {
            if ($key % 2 == 0) {
                $g1[] = intval($num);
            } else {
                $g2[] = intval($num);
            }
        }

        foreach ($g1 as $key => $num) {
            $g1[$key] = $num * 2;
        }

        $checksum = array_sum(str_split(implode('', $g1).implode('', $g2)));
        $checksum = 10 - ($checksum % 10);
        $checksum = $checksum % 10;

        return $checksum == $checkdigit;
    }

    /**
     * Checks if given value is valid International Bank Account Number (IBAN).
     *
     * @param  mixed  $value
     * @return boolean
     */
    public static function isIban($value)
    {
        // build replacement arrays
        $iban_replace_chars = range('A', 'Z');
        foreach (range(10, 35) as $tempvalue) {
            $iban_replace_values[] = strval($tempvalue);
        }

        // prepare string
        $tempiban = strtoupper($value);
        $tempiban = str_replace(' ', '', $tempiban);

        // check iban length
        if (self::getIbanLength($tempiban) != strlen($tempiban)) {
            return false;
        }

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
     * Returns the designated length of IBAN for given IBAN
     *
     * @param  string $iban
     * @return integer
     */
    private static function getIbanLength($iban)
    {
        $countrycode = substr($iban, 0, 2);

        $lengths = array(
            'AL' => 28,
            'AD' => 24,
            'AT' => 20,
            'AZ' => 28,
            'BH' => 22,
            'BE' => 16,
            'BA' => 20,
            'BR' => 29,
            'BG' => 22,
            'CR' => 21,
            'HR' => 21,
            'CY' => 28,
            'CZ' => 24,
            'DK' => 18,
            'DO' => 28,
            'TL' => 23,
            'EE' => 20,
            'FO' => 18,
            'FI' => 18,
            'FR' => 27,
            'GE' => 22,
            'DE' => 22,
            'GI' => 23,
            'GR' => 27,
            'GL' => 18,
            'GT' => 28,
            'HU' => 28,
            'IS' => 26,
            'IE' => 22,
            'IL' => 23,
            'IT' => 27,
            'JO' => 30,
            'KZ' => 20,
            'XK' => 20,
            'KW' => 30,
            'LV' => 21,
            'LB' => 28,
            'LI' => 21,
            'LT' => 20,
            'LU' => 20,
            'MK' => 19,
            'MT' => 31,
            'MR' => 27,
            'MU' => 30,
            'MC' => 27,
            'MD' => 24,
            'ME' => 22,
            'NL' => 18,
            'NO' => 15,
            'PK' => 24,
            'PS' => 29,
            'PL' => 28,
            'PT' => 25,
            'QA' => 29,
            'RO' => 24,
            'SM' => 27,
            'SA' => 24,
            'RS' => 22,
            'SK' => 24,
            'SI' => 19,
            'ES' => 24,
            'SE' => 24,
            'CH' => 21,
            'TN' => 24,
            'TR' => 26,
            'AE' => 23,
            'GB' => 22,
            'VG' => 24,
            'DZ' => 24,
            'AO' => 25,
            'BJ' => 28,
            'BF' => 27,
            'BI' => 16,
            'CM' => 27,
            'CV' => 25,
            'IR' => 26,
            'CI' => 28,
            'MG' => 27,
            'ML' => 28,
            'MZ' => 25,
            'SN' => 28,
            'UA' => 29
        );

        return isset($lengths[$countrycode]) ? $lengths[$countrycode] : false;
    }

    /**
     * Checks if given value is valid International Bank Account Number (IBAN).
     *
     * @param  mixed  $value
     * @return boolean
     */
    public static function isBic($value)
    {
        $pattern = '/^[A-Za-z]{4} ?[A-Za-z]{2} ?[A-Za-z0-9]{2} ?([A-Za-z0-9]{3})?$/';
        return (boolean) preg_match($pattern, $value);
    }

    /**
     * Checks if value is valid hexadecimal color code.
     *
     * @param  mixed  $value
     * @return boolean
     */
    public static function isHexcolor($value)
    {
        $pattern = '/^#?([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/';
        return (boolean) preg_match($pattern, $value);
    }

    /**
     * Checks if value is valid creditcard number.
     *
     * @param  mixed  $value
     * @return boolean
     */
    public static function isCreditcard($value)
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
    public static function isIsbn($value)
    {
        $value = str_replace(array(' ', '-', '.'), '', $value);
        $length = strlen($value);
        $checkdigit = substr($value, -1);

        if ($length == 10) {
            if (! is_numeric(substr($value, -10, 9))) {
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
    public static function isIsodate($value)
    {
        $pattern = '/^([\+-]?\d{4}(?!\d{2}\b))((-?)((0[1-9]|1[0-2])(\3([12]\d|0[1-9]|3[01]))?|W([0-4]\d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]\d|[12]\d{2}|3([0-5]\d|6[1-6])))([T\s]((([01]\d|2[0-3])((:?)[0-5]\d)?|24\:?00)([\.,]\d+(?!:))?)?(\17[0-5]\d([\.,]\d+)?)?([zZ]|([\+-])([01]\d|2[0-3]):?([0-5]\d)?)?)?)?$/';

        return (boolean) preg_match($pattern, @strval($value));
    }

    /**
     * Checks if value is Username
     *
     * @param  mixed  $value
     * @return boolean
     */
    public static function isUsername($value)
    {
        // username consists of alpha-numeric (a-z, A-Z, 0-9), underscores
        // starts with a alpha letter
        // and has minimum of 3 character and maximum of 20 characters
        $pattern = '/^[a-z][a-z\d_]{2,20}$/i';
        return (boolean) preg_match($pattern, $value);
    }

    /**
     * Checks if value is free of HTML code
     *
     * @param  mixed  $value
     * @return boolean
     */
    public static function isHtmlclean($value)
    {
        return (strip_tags($value) == $value);
    }

    /**
     * Checks if password has certain strength
     *
     * @param  mixed $value
     * @return boolean
     */
    public static function isPassword($value)
    {
        $pattern = "/^((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{6,64})$/";
        return (boolean) preg_match($pattern, $value);
    }

    /**
     * Checks if value only has alphabetic characters and/or spaces
     *
     * @param  mixed  $value
     * @return boolean
     */
    public static function isAlphaSpace($value)
    {
        return (bool) preg_match('/^[\pL\s]+$/u', $value);
    }

    /**
     * Checks if value is domainname
     *
     * @param  mixed  $value
     * @return boolean
     */
    public static function isDomainname($value)
    {
        if (strlen($value) > 253) {
            return false;
        }

        $pattern = "/^(?!\-)(?:[a-zA-Z\d\-]{0,62}[a-zA-Z\d]\.){1,126}(?!\d+)[a-zA-Z\d]{1,63}$/";

        return (boolean) preg_match($pattern, $value);
    }

    public static function isEmptyWith($value, $values)
    {
        if (strlen($value) === 0) {
            return true;
        }

        $values = array_filter($values, function ($item) {
            return strlen($item) > 0;
        });

        return empty($values);
    }
}
