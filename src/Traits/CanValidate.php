<?php

namespace Intervention\Validation\Traits;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;
use Intervention\Validation\Validator as InterventionValidator;

trait CanValidate
{
    public function getValidator($data, $rules)
    {
        $loader = new FileLoader(new Filesystem(), 'lang');
        $translator = new Translator($loader, 'en');
        $factory = new Factory($translator, new Container());

        foreach (InterventionValidator::getRuleShortnames() as $rulename) {
            $factory->extend(
                $rulename,
                function ($attribute, $value, $parameters, $validator) use ($rulename) {
                    return forward_static_call(
                        [InterventionValidator::class, 'is' . ucfirst($rulename)],
                        $value,
                        data_get($parameters, 0)
                    );
                },
                $translator->get('validation::validation.' . $rulename)
            );
        }

        $factory->resolver(function ($translator, $data, $rules, $messages, $customAttributes) {
            return new Validator($translator, $data, $rules, $messages, $customAttributes);
        });

        return $factory->make($data, $rules);
    }
}
