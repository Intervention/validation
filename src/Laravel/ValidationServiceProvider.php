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

        $this->app['validator']->resolver(function ($translator, $data, $rules, $messages, $customAttributes) {
            // add error messages for custom rules
            foreach ($this->getRuleClassnames() as $classname) {
                $this->attachErrorMessage($messages, $classname, $translator);
            }
            
            // add validator extension, to resolve custom rules
            return new ValidationExtension($translator, $data, $rules, $messages, $customAttributes);
        });
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

    /**
     * Return array of validation rule classnames
     *
     * @return array
     */
    private function getRuleClassnames()
    {
        $files = array_diff(scandir(__DIR__ . '/../Rules'), ['.', '..']);

        return array_map(function ($filename) {
            return substr($filename, 0, -4);
        }, $files);
    }

    /**
     * Return the matching error message for the key
     *
     * @param  string $key
     * @return string
     */
    private function getErrorMessage($translator, $messages, $key)
    {
        // return error messages passed directly to the validator
        if (isset($messages[$key])) {
            return $messages[$key];
        }

        // return error message from validation translation file
        if ($translator->has("validation.{$key}")) {
            return $translator->get("validation.{$key}");
        }

        // return packages default message
        return $translator->get("validation::validation.{$key}");
    }

    /**
     * Attach error message for given rule classname to messages array
     *
     * @param  array                             $messages
     * @param  string                            $classname
     * @param  \Illuminate\Translation\Translator $translator
     * @return void
     */
    private function attachErrorMessage(&$messages, $classname, $translator)
    {
        $key = strtolower($classname);
        $message = $this->getErrorMessage($translator, $messages, $key);
        $messages[$key] = $message;
    }
}
