<?php

namespace Intervention\Validation;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator as IlluminateValidator;
use Intervention\Validation\Exceptions\ValidationException;

class Validator
{
    public static function make(array $data, array $rules, string $locale = 'en'): IlluminateValidator
    {
        return self::factory($locale)->make($data, $rules);
    }

    /**
     * Magic method for static calls, to call single rules directly
     *
     * @param  string $name
     * @param  array  $arguments
     * @return boolean
     */
    public static function __callStatic(string $name, array $arguments): bool
    {
        $delegation = new CallDelegator($name, $arguments);
        $rules = ['required', $delegation->getRule()];
        $passes = self::make(['value' => $delegation->getValue()], ['value' => $rules])->passes();

        if ($delegation->isAssertion() && $passes === false) {
            throw new ValidationException('Validation Error');
        }

        return $passes;
    }

    protected static function factory(string $locale): Factory
    {
        $loader = new FileLoader(new Filesystem(), __DIR__ . '/lang');
        $translator = new Translator($loader, $locale);
        $factory = new Factory($translator, new Container());
        $factory->resolver(function ($translator, $data, $rules, $messages, $customAttributes) {
            return new IlluminateValidator($translator, $data, $rules, $messages, $customAttributes);
        });

        return $factory;
    }
}
