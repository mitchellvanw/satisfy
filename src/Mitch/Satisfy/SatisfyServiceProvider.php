<?php namespace Mitch\Satisfy;

use Illuminate\Support\ServiceProvider;

class SatisfyServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->package('mitch/satisfy');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}
}