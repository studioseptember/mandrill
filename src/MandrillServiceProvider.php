<?php namespace Sairiz\Mandrill;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class MandrillServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
	}	

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('mandrill', function($app)
		{
			$key = config('packages.sairiz.mandrill.config.apiKey');
			return new Mandrill($key);
		});

		$this->app->booting(function()
		{
			$loader = AliasLoader::getInstance();
			$loader->alias('Email',\Sairiz\Mandrill\Facades\Mandrill::class);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('mandrill');
	}

}
