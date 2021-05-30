<?php

namespace Intervention\Validation;

use Exception;

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
    abstract public function isValid(): bool;

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
    public function setValue($value): AbstractRule
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Resolve validation rule symbol
     *
     * @return string
     */
    protected function resolveSymbol(): string
    {
        preg_match("/(?P<name>[a-z0-9]+)$/i", get_class($this), $matches);
        if (! isset($matches['name'])) {
            throw new Exception(
                'Validation rule symbol can not be resolved (' . get_class($this) . ').'
            );
        }

        return strtolower($matches['name']);
    }

    /**
     * Cast to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->resolveSymbol();
    }
}
