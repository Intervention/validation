<?php

namespace Intervention\Validation\Laravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
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
        foreach ($this->getAdditionalRuleNames() as $rulename) {
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
     * Get all intervention validation rules
     *
     * @return array
     */
    protected function getAdditionalRuleNames(): array
    {
        return array_map(function ($filename) {
            return mb_strtolower(substr($filename, 0, -4));
        }, array_diff(scandir(__DIR__ . '/../Rules'), ['.', '..']));
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
