<?php namespace Intervention\Validation;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Factory;

class ValidationServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('intervention/validation');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['validator'] = $this->app->share(function($app)
		{
			$validator = new Factory($app['translator']);

			$validator->resolver(function($translator, $data, $rules, $messages) {
				return new ValidatorExtension($translator, $data, $rules, $messages);
			});	

			return $validator;
		});

		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('validator');
	}

}