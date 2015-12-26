<?php namespace Ericmuigai\Pesapal;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator as URL;
class PesapalServiceProvider extends ServiceProvider {

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
        global $enabled,$consumer_key,$consumer_secret,$currency,$controller,$key,$redirectTo,$email,$mail,$name;

//		$this->package('ericmuigai/pesapal');

        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('pesapal.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../../migrations/' => database_path('migrations')
        ], 'migrations');
        $this->loadViewsFrom(__DIR__ . '/../../views', 'pesapal');
        include __DIR__.'/../../routes.php';
        $app = $this->app;
// Config
        $this->mergeConfigFrom( __DIR__.'/../../config/config.php', 'pesapal');

        $enabled         = config('pesapal.enabled');;
        $consumer_key    = config('pesapal.consumer_key');
        $consumer_secret = config('pesapal.consumer_secret');
        $currency        = config('pesapal.currency');
        $controller      = config('pesapal.controller');
        $key             = config('pesapal.currency');
        $redirectTo      = config('pesapal.redirectTo');
        $email           = config('pesapal.email');
        $mail            = config('pesapal.mail');
        $name            = config('pesapal.name');



        $this->app['pesapal'] = $this->app->share(function($app)
        {
            return new Pesapal($app['view']);
        });
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/../../config/config.php', 'pesapal');
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Pesapal', 'Ericmuigai\Pesapal\Facades\Pesapal');
        });
        $this->app['pesapal'] = $this->app->share(function($app)
        {
            return new Pesapal($app['view']);
        });

    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}