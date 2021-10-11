<?php

namespace Intervention\Validation;

use ReflectionClass;

abstract class AbstractRule
{
    /**
     * Return shortname of current rule
     *
     * @return string
     */
    protected function shortname(): string
    {
        return strtolower((new ReflectionClass($this))->getShortName());
    }

    /**
     * Return localized error message
     *
     * @return string
     */
    public function message()
    {
        $key = 'validation::validation.' . $this->shortname();
        if (function_exists('trans')) {
            return trans($key);
        }

        return $key;
    }
}
