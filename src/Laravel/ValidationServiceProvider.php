<?php

namespace Intervention\Validation\Laravel;

use Illuminate\Support\ServiceProvider;
use Intervention\Validation\Exceptions\NotExistingRuleException;
use Intervention\Validation\Rule;
use Intervention\Validation\Validator;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // load translation files
        $this->loadTranslationsFrom(
            __DIR__ . '/../lang',
            'validation'
        );

        // add rules to laravel validator
        foreach (Validator::getRuleShortnames() as $rulename) {
            $this->app['validator']->extend(
                $rulename,
                function ($attribute, $value, $parameters, $validator) use ($rulename) {
                    return $this->getInterventionRule($rulename, $parameters)
                        ->isValid($value);
                },
                $this->getErrorMessage($rulename)
            );
        }
    }

    /**
     * Return rule object for given shortname
     *
     * @param string $rulename
     * @param array $parameters
     * @return Rule
     * @throws NotExistingRuleException
     */
    private function getInterventionRule(string $rulename, array $parameters): Rule
    {
        $classname = sprintf("Intervention\Validation\Rules\%s", ucfirst($rulename));

        if (!class_exists($classname)) {
            throw new NotExistingRuleException("Rule " . $rulename . " does not exist.");
        }

        return new $classname(...$parameters);
    }

    /**
     * Return error message of given rule shortname
     *
     * @param  string $rulename
     * @return string
     */
    protected function getErrorMessage(string $rulename): string
    {
        return $this->app['translator']->get('validation::validation.' . $rulename);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['validator'];
    }
}
