<?php

declare(strict_types=1);

namespace Intervention\Validation\Laravel;

use Illuminate\Support\ServiceProvider;
use Intervention\Validation\Exceptions\NotExistingRuleException;
use Intervention\Validation\Rule;

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
        foreach ($this->ruleShortnames() as $rulename) {
            $this->app['validator']->extend(
                $rulename,
                function ($attribute, $value, $parameters, $validator) use ($rulename): bool {
                    return $this->interventionRule($rulename, $parameters)->isValid($value);
                },
                $this->errorMessage($rulename)
            );
        }
    }

    /**
     * Return rule object for given shortname
     *
     * @param string $rulename
     * @param array<mixed> $parameters
     * @return Rule
     * @throws NotExistingRuleException
     */
    private function interventionRule(string $rulename, array $parameters): Rule
    {
        $classname = sprintf("Intervention\Validation\Rules\%s", ucfirst($rulename));

        if (!class_exists($classname)) {
            throw new NotExistingRuleException("Rule " . $rulename . " does not exist.");
        }

        return new $classname($parameters);
    }

    /**
     * List all shortnames of Intervention validation rule objects
     *
     * @return array<string>
     */
    private function ruleShortnames(): array
    {
        return array_map(
            fn(string $filename): string => mb_strtolower(substr($filename, 0, -4)),
            array_diff(scandir(__DIR__ . '/../Rules'), ['.', '..']),
        );
    }

    /**
     * Return error message of given rule shortname
     *
     * @param string $rulename
     * @return string
     */
    protected function errorMessage(string $rulename): string
    {
        return $this->app['translator']->get('validation::validation.' . $rulename);
    }

    /**
     * Return the services provided by the provider.
     *
     * @return array<string>
     */
    public function provides()
    {
        return ['validator'];
    }
}
