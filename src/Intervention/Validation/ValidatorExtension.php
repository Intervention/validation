<?php

namespace Intervention\Validation;

class ValidatorExtension extends \Illuminate\Validation\Validator
{
    /**
     * Provides the Validator to check values
     * @var Intervention\Validation\Validator
     */
    protected $validator;

    /**
     * Creates new instance of ValidatorExtension
     * 
     */
    public function __construct($translator, $data, $rules, $messages) 
    {
        parent::__construct($translator, $data, $rules, $messages);
        $this->validator = new Validator;
    }

    /**
     * Provides 'iban' validation rule for Laravel4
     * 
     * @return bool
     */
    public function validateIban($attribute, $value, $parameters)
    {
        return $this->validator->isIban($value);
    }

    /**
     * Proved 'bic' validation rule for Laravel4
     * 
     * @return bool
     */
    public function validateBic($attribute, $value, $parameters)
    {
        return $this->validator->isBic($value);
    }

    /**
     * Provides 'hexcolor' validation rule for Laravel4
     * 
     * @return bool
     */
    public function validateHexcolor($attribute, $value, $parameters)
    {
        return $this->validator->isHexcolor($value);
    }

    /**
     * Provides 'creditcard' validation rule for Laravel4
     * 
     * @return bool
     */
    public function validateCreditcard($attribute, $value, $parameters)
    {
        return $this->validator->isCreditcard($value);
    }

    /**
     * Provides 'isbn' validation rule for Laravel4
     * 
     * @return bool  
     */
    public function validateIsbn($attribute, $value, $parameters)
    {
        return $this->validator->isIsbn($value);
    }

    /**
     * Provides 'isoddate' validation rule for Laravel4
     *
     * @return bool
     */
    public function validateIsodate($attribute, $value, $parameters)
    {
        return $this->validator->isIsodate($value);
    }

    /**
     * Provides 'username' validation rule for Laravel4
     * 
     * @return bool
     */
    public function validateUsername($attribute, $value, $parameters)
    {
        return $this->validator->isUsername($value);
    }
}