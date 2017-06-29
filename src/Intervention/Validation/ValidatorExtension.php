<?php

namespace Intervention\Validation;

class ValidatorExtension extends \Illuminate\Validation\Validator
{
    /**
     * Creates new instance of ValidatorExtension
     *
     */
    public function __construct($translator, $data, $rules, $messages, $customAttributes)
    {
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);
    }

    /**
     * Provides 'isin' validation rule for Laravel
     *
     * @return bool
     */
    public function validateIsin($attribute, $value, $parameters)
    {
        return Validator::isIsin($value);
    }

    /**
     * Provides 'iban' validation rule for Laravel
     *
     * @return bool
     */
    public function validateIban($attribute, $value, $parameters)
    {
        return Validator::isIban($value);
    }

    /**
     * Proved 'bic' validation rule for Laravel
     *
     * @return bool
     */
    public function validateBic($attribute, $value, $parameters)
    {
        return Validator::isBic($value);
    }

    /**
     * Provides 'hexcolor' validation rule for Laravel
     *
     * @return bool
     */
    public function validateHexcolor($attribute, $value, $parameters)
    {
        return Validator::isHexcolor($value);
    }

    /**
     * Provides 'creditcard' validation rule for Laravel
     *
     * @return bool
     */
    public function validateCreditcard($attribute, $value, $parameters)
    {
        return Validator::isCreditcard($value);
    }

    /**
     * Provides 'isbn' validation rule for Laravel
     *
     * @return bool
     */
    public function validateIsbn($attribute, $value, $parameters)
    {
        return Validator::isIsbn($value);
    }

    /**
     * Provides 'isoddate' validation rule for Laravel
     *
     * @return bool
     */
    public function validateIsodate($attribute, $value, $parameters)
    {
        return Validator::isIsodate($value);
    }

    /**
     * Provides 'username' validation rule for Laravel
     *
     * @return bool
     */
    public function validateUsername($attribute, $value, $parameters)
    {
        return Validator::isUsername($value);
    }

    /**
     * Provides 'htmlclean' validation rule for Laravel
     *
     * @return bool
     */
    public function validateHtmlclean($attribute, $value, $parameters)
    {
        return Validator::isHtmlclean($value);
    }

    /**
     * Provides 'password' validation rule for Laravel
     *
     * @return bool
     */
    public function validatePassword($attribute, $value, $parameters)
    {
        return Validator::isPassword($value);
    }

    /**
     * Provides 'alpha_space' validation rule for Laravel
     *
     * @return bool
     */
    public function validateAlphaSpace($attribute, $value, $parameters)
    {
        return Validator::isAlphaSpace($value);
    }

    public function validateDomainname($attribute, $value, $parameters)
    {
        return Validator::isDomainname($value);
    }

    /**
     * Provides 'empty_with' validation rule for Laravel
     *
     * @return bool
     */
    public function validateEmptyWith($attribute, $value, $parameters)
    {
        $values = [];

        foreach ($parameters as $parameter) {
            $values[] = $this->getValue($parameter);
        }

        return Validator::isEmptyWith($value, $values);
    }
}
