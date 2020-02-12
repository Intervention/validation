<?php

namespace Intervention\Validation;

use Illuminate\Validation\Validator as IlluminateValidator;
use BadMethodCallException;

class ValidationExtension extends IlluminateValidator
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
     * Magic method to call validation rules
     *
     * @param  string $name
     * @param  array  $arguments
     * @return bool
     */
    public function __call($name, $arguments)
    {
        $value = data_get($arguments, 1);
        $rule = $this->invokeRule($this->getRuleClassnameByMethodName($name));
        
        return Validator::make($rule)->validate($value);
    }

    /**
     * Return validation rule classname by given method name
     *
     * @param  string $name
     * @return AbstractRule
     */
    private function getRuleClassnameByMethodName($name): string
    {
        preg_match("/^validate((?P<rule>[a-zA-Z]+))$/", $name, $matches);

        return __NAMESPACE__ . "\\Rules\\" . data_get($matches, 'rule');
    }

    /**
     * Invoke new rule object
     *
     * @param  string $classname
     * @return AbstractRule
     */
    private function invokeRule($classname): AbstractRule
    {
        if (! class_exists($classname)) {
            throw new BadMethodCallException(
                "Validation rule (".$classname.") does not exist."
            );
        }

        return new $classname;
    }
}
