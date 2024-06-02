<?php

declare(strict_types=1);

namespace Intervention\Validation;

use ReflectionClass;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

abstract class AbstractRule implements Rule, ValidationRule
{
    /**
     * {@inheritdoc}
     *
     * @see Rule::isValid()
     */
    abstract public function isValid(mixed $value): bool;

    /**
     * {@inheritdoc}
     *
     * @see ValidationRule::validate()
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
            // translation so we will use internal
            $message = trans($key);
            if ($message === $key) {
                return trans('validation::' . $key);
            }
        }

        return $key;
    }
}
