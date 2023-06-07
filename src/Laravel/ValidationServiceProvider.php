<?php

namespace Intervention\Validation\Laravel;

use Illuminate\Support\ServiceProvider;
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
                    return forward_static_call(
                        [Validator::class, 'is' . ucfirst($rulename)],
                        $value,
                        data_get($parameters, 0)
                    );
                },
                $this->getErrorMessage($rulename)
            );
        }
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
