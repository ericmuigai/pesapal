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

		$this->package('ericmuigai/pesapal');
        include __DIR__.'/../../routes.php';
        $app = $this->app;

        $enabled = $app['config']->get('pesapal::enabled');
        $consumer_key = $app['config']->get('pesapal::consumer_key');
        $consumer_secret = $app['config']->get('pesapal::consumer_secret');
        $currency = $app['config']->get('pesapal::currency');
        $controller = $app['config']->get('pesapal::controller');
        $key = $app['config']->get('pesapal::currency');
        $redirectTo = $app['config']->get('pesapal::redirectTo');
        $email = $app['config']->get('pesapal::email');
        $mail = $app['config']->get('pesapal::mail');
        $name = $app['config']->get('pesapal::name');

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