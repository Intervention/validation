<?php

namespace Intervention\Validation\Traits;

use Intervention\Validation\Validator;

trait CanValidate
{
    public function isValid($value, array $rules): bool
    {
        $validator = new Validator($rules);
        return $validator->validate($value);
    }
}
