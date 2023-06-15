<?php

namespace Intervention\Validation;

use ReflectionClass;
use Closure;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;

abstract class AbstractRule
{
    use Traits\HasCurrentLocale;

    abstract public function passes(string $attribute, mixed $value): bool;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->passes($attribute, $value)) {
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

            return $message;
        }

        return $this->translatorInstance()->get($key);
    }

    protected function translatorInstance(): Translator
    {
        $loader = new FileLoader(new Filesystem(), __DIR__ . '/lang');
        return new Translator($loader, self::getCurrentLocale());
    }
}
