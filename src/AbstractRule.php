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
        // try key for application custom translation
        $key = 'validation.' . $this->shortname();

        if (function_exists('trans')) {
            // if message is same as key, there is no
            // tranlation so we will use internal
            $message = trans($key);
            if ($message === $key) {
                return trans('validation::' . $key);
            }

            return $message;
        }

        return $key;
    }
}
