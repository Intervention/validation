<?php

namespace Intervention\Validation;

abstract class AbstractRule
{
    /**
     * Value to be validated
     *
     * @var mixed
     */
    private $value;

    /**
     * Determine if current value is valid
     *
     * @return boolean
     */
    abstract public function isValid();

    /**
     * Create new instance
     *
     * @param mixed $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    /**
     * Return current value
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set current value
     *
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
