<?php

namespace Intervention\Validation;

class ValidatorExtension extends \Illuminate\Validation\Validator
{
    protected $validator;

    public function __construct($translator, $data, $rules, $messages) 
    {
        parent::__construct($translator, $data, $rules, $messages);
        $this->validator = new Validator;
    }

    public function validateIban($attribute, $value, $parameters)
    {
        return $this->validator->isIban($value);
    }

    public function validateBic($attribute, $value, $parameters)
    {
        return $this->validator->isBic($value);
    }

    public function validateHexcolor($attribute, $value, $parameters)
    {
        return $this->validator->isHexcolor($value);
    }

    public function validateCreditcard($attribute, $value, $parameters)
    {
        return $this->validator->isCreditcard($value);
    }

    public function validateIsbn($attribute, $value, $parameters)
    {
        return $this->validator->isIsbn($value);
    }

    public function validateIsodate($attribute, $value, $parameters)
    {
        return $this->validator->isIsodate($value);
    }
}