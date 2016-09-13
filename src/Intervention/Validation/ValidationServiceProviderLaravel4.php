<?php

namespace Intervention\Validation;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;

class ValidationServiceProviderLaravel4 extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('intervention/validation');

        // registering intervention validator extension
        $this->app['validator']->resolver(function($translator, $data, $rules, $messages, $customAttributes) {

            // set the package validation error messages
            $messages['isin'] = $translator->get('validation::validation.isin');
            $messages['iban'] = $translator->get('validation::validation.iban');
            $messages['bic'] = $translator->get('validation::validation.bic');
            $messages['hexcolor'] = $translator->get('validation::validation.hexcolor');
            $messages['creditcard'] = $translator->get('validation::validation.creditcard');
            $messages['isbn'] = $translator->get('validation::validation.isbn');
            $messages['isodate'] = $translator->get('validation::validation.isodate');
            $messages['username'] = $translator->get('validation::validation.username');
            $messages['htmlclean'] = $translator->get('validation::validation.htmlclean');
            $messages['password'] = $translator->get('validation::validation.password');

            return new ValidatorExtension($translator, $data, $rules, $messages, $customAttributes);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        # code...
    }
}
