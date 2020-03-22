<?php

namespace Intervention\Validation;

class Validator
{
    /**
     * Current rule
     *
     * @var AbstractRule
     */
    protected $rule;

    /**
     * Create new instance
     *
     * @param AbstractRule $rule
     */
    public function __construct(AbstractRule $rule)
    {
        $this->rule = $rule;
    }

    /**
     * Overwrite current rule
     *
     * @param AbstractRule $rule
     */
    public function setRule(AbstractRule $rule): Validator
    {
        $this->rule = $rule;

        return $this;
    }

    /**
     * Return current rule
     *
     * @return AbstractRule
     */
    public function getRule(): AbstractRule
    {
        return $this->rule;
    }

    /**
     * Static constructor
     *
     * @param  AbstractRule $rule
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
    public function validate($value): bool
    {
        return $this->rule->setValue($value)->isValid();
    }

    /**
     * Throw exception if value does not validate
     *
     * @param  mixed $value
     * @return void
     */
    public function assert($value): void
    {
        if (! $this->validate($value)) {
            throw new Exception\ValidationException(
                sprintf(
                    'Error validating value (%s) against rule "%s"',
                    $value,
                    get_class($this->rule)
                )
            );
        }
    }

    /**
     * Magic method for static calls
     *
     * @param  string $name
     * @param  array  $arguments
     * @return boolean
     */
    public static function __callStatic(string $name, array $arguments): bool
    {
        return (new CallDelegator($name, $arguments))->getReturnValue();
    }
}
