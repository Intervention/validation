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
        $value = data_get($arguments, 1);
        $attributes = data_get($arguments, 2);

        try {
            // try to invoke rule
            $rule = $this->invokeRule(
                $this->getRuleClassnameByMethodName($name),
                $attributes
            );
        } catch (Exception $e) {
            // if intervention/validation don't has rule, call regular validator
            return call_user_func_array(['parent', $name], $arguments);
        }

        // do the validation work
        return Validator::make($rule)->validate($value);
    }

    /**
     * Return validation rule classname by given method name
     *
     * @param  string $name
     * @return string
     */
    private function getRuleClassnameByMethodName($name): string
    {
        preg_match("/^validate((?P<rule>[a-zA-Z0-9]+))$/", $name, $matches);

        return 'Intervention\\Validation\\Rules\\' . data_get($matches, 'rule');
    }

    /**
     * Invoke new rule object
     *
     * @param  string $classname
     * @param  array  $attributes
     * @return AbstractRule
     */
    private function invokeRule($classname, $attributes = []): AbstractRule
    {
        if (! class_exists($classname)) {
            throw new BadMethodCallException(
                "Validation rule (" . $classname . ") does not exist."
            );
        }

        return new $classname(null, $attributes);
    }
}
