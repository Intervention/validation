<?php

namespace Intervention\Validation\Laravel;

use BadMethodCallException;
use Exception;
use Illuminate\Validation\Validator as IlluminateValidator;
use Intervention\Validation\AbstractRule;
use Intervention\Validation\Validator;

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
        try {
            // try to invoke rule
            $rule = $this->invokeRule(
                $this->getRuleClassnameByMethodName($name)
            );
        } catch (Exception $e) {
            // if intervention/validation don't has rule, call regular validator
            return call_user_func_array(['parent', $name], $arguments);
        }
        
        // do the validation work, first argument is value
        return Validator::make($rule)->validate(data_get($arguments, 1));
    }

    /**
     * Return validation rule classname by given method name
     *
     * @param  string $name
     * @return string
     */
    private function getRuleClassnameByMethodName($name): string
    {
        preg_match("/^validate((?P<rule>[a-zA-Z]+))$/", $name, $matches);

        return 'Intervention\\Validation\\Rules\\' . data_get($matches, 'rule');
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
                "Validation rule (" . $classname . ") does not exist."
            );
        }

        return new $classname();
    }
}
