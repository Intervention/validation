<?php

namespace Intervention\Validation\Laravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        foreach ($this->getAllRules() as $rule) {
            $this->app['validator']->extend(
                $rule,
                ValidatorExtension::class . '@validate',
                $this->app['translator']->get('validation::validation.' . $rule)
            );
        }
    }

    protected function getAllRules(): array
    {
        return array_map(function ($filename) {
            return mb_strtolower(substr($filename, 0, -4));
        }, array_diff(scandir(__DIR__ . '/../Rules'), ['.', '..']));
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
