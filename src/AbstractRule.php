<?php

namespace Intervention\Validation;

use ReflectionClass;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

abstract class AbstractRule implements Rule, ValidationRule
{
    abstract public function isValid(mixed $value): bool;

    /**
     * Laravel Framwork validation method
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isValid($value)) {
            $fail($this->message())->translate();
        }
    }

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
        }

        return $key;
    }
}
