<?php

namespace Intervention\Validation;

use Intervention\Validation\AbstractRule;

class Validator
{
    /**
     * Current rule
     *
     * @var Rules\AbstractRule
     */
    protected $rule;

    /**
     * Create new instance
     *
     * @param mixed $value
     */
    public function __construct(AbstractRule $rule)
    {
        $this->rule = $rule;
    }

    /**
     * Static constructor
     *
     * @param  AbstractRule $classname
     * @param  mixed        $value
     * @return self
     */
    public static function make(AbstractRule $rule): Validator
    {
        return new self($rule);
    }

    /**
     * Validate given value against current rule
     *
     * @param  mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return $this->rule->isValid($value);
    }

    /**
     * Magic method for static calls
     *
     * @param  string $name
     * @param  array  $arguments
     * @return boolean
     */
    public static function __callStatic($name, $arguments)
    {
        $value = isset($arguments[0]) ? $arguments[0] : null;

        return self::getRuleByCall($name, $value)->isValid();
    }

    /**
     * Return rule object by given static call name
     *
     * @param  string $call
     * @return AbstractRule
     */
    private static function getRuleByCall($call, $value): AbstractRule
    {
        $classname = sprintf('Intervention\Validation\Rules\%s', substr($call, 2));
        
        if (! class_exists($classname)) {
            trigger_error(
                "Error: Call to undefined method ".self::class."::".$classname,
                E_USER_ERROR
            );
        }
        
        return new $classname($value);
    }
}
