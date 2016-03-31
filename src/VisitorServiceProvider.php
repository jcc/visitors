<?php namespace Cjjian\Visitors;


use Illuminate\Support\ServiceProvider;

class VisitorServiceProvider extends ServiceProvider {

	

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		
		
		$this->publishes([
				  realpath(__DIR__.'/migrations') => base_path('/database/migrations') ],
				 'migrations');
		
		$this->publishes([
				__DIR__.'/config/visitor.php' => config_path('visitor.php'),
			    ]);
		
		
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerBindings();
		
		$this->RegisterIp();
		
		$this->RegisterVisitor();
		
		$this->RegisterBooting();
	}
	
	public function RegisterVisitor()
	{
		$this->app->singleton('visitor', function($app)
			{
			   
			    
			    return new Visitor(
						 $app['Cjjian\Visitors\Storage\VisitorInterface'],
						 $app['Cjjian\Visitors\Services\Geo\GeoInterface'],
						 $app['ip'],
						 $app['Cjjian\Visitors\Services\Cache\CacheInterface']
						 
					      );
			});
		
		$this->app->bind('Cjjian\Visitors\Visitor', function($app) {
			return $app['visitor'];
		    });
	
	}
	
	
	public function RegisterIp()
	{
		$this->app->singleton('ip', function($app)
			{
			    return new Ip(
					$app->make('request'),
					array(
					       $app->make('Cjjian\Visitors\Services\Validation\Validator'),
					       $app->make('Cjjian\Visitors\Services\Validation\Checker')
					       )
						 
					      );
			});
	
	}
	
	

	
	public function registerBooting()
	{
		 $this->app->booting(function()
				{
				   $loader = \Illuminate\Foundation\AliasLoader::getInstance();
				   $loader->alias('Visitor', 'Cjjian\Visitors\Facades\VisitorFacade');
			
				    
				});
	}
	
	
	
	protected function registerBindings()
	{
		$this->app->singleton(
			'Cjjian\Visitors\Storage\VisitorInterface',
			'Cjjian\Visitors\Storage\QbVisitorRepository'
                );
		
		$this->app->singleton(
                    'Cjjian\Visitors\Services\Geo\GeoInterface',
                    'Cjjian\Visitors\Services\Geo\MaxMind'
                );
		
		$this->app->singleton(
                    'Cjjian\Visitors\Services\Cache\CacheInterface',
                    'Cjjian\Visitors\Services\Cache\CacheClass'
                );
	}
	
	
	

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('visitor');
	}

}