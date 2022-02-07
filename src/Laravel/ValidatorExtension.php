<?php

namespace Intervention\Validation\Laravel;

class ValidatorExtension
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        return false;
    }
}
