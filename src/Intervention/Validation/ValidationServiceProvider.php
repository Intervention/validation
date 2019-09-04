<?php

namespace Intervention\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Actual provider
     *
     * @var \Illuminate\Support\ServiceProvider
     */
    protected $provider;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct($app);

        $this->provider = $this->getProvider();
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->provider->boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->provider->register();
    }

    /**
     * Return ServiceProvider according to Laravel version
     *
     * @return \Intervention\Image\Provider\ProviderInterface
     */
    private function getProvider()
    {
        $app = $this->app;
        $version = intval($app::VERSION);
        $provider = sprintf(
            '\Intervention\Validation\ValidationServiceProviderLaravel%d',
            $version
        );

        return new $provider($app);
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
