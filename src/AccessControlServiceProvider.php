<?php

namespace LaravelHrabac\AccessControl;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AccessControlServiceProvider extends ServiceProvider
{

protected $commands = [
    'LaravelHrabac\AccessControl\Commands\LaravelrolesCommand'
];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
       	$this->commands($this->commands);
		//custom blade directive
		\Blade::if('path', function($routeName){
			return auth()->user()->canAccess($routeName);
		});
		\Blade::if('owns', function($routeName, $model){
			return auth()->user()->isOwned($routeName) && auth()->user()->ownModel($model);
		});
		\Blade::if('has', function($routeName){
			return auth()->user()->canAccess($routeName) || auth()->user()->isOwned($routeName);
		});
		//load and publish translations
		$this->loadTranslationsFrom(__DIR__.'/lang', 'lang');
		$this->publishes([__DIR__.'/lang'=> base_path('resources/lang')]);

		//publish views
		$this->publishes([__DIR__.'/views'=> base_path('resources/views/rolespermissions')]
		);
		//publish error views
		$this->publishes([__DIR__.'/views/errors'=> base_path('resources/views/errors')]);
		//publish migrations
		$this->publishes([
		__DIR__. '/migrations'=>$this->app->databasePath().'/migrations'], 'migrations');
		//publish seeds
		$this->publishes([
		__DIR__. '/seeders'=>$this->app->databasePath().'/seeders'], 'seeders');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

		include __DIR__."/routes.php";

		$this->app->make('LaravelHrabac\AccessControl\Controllers\RoleController');
		$this->app->make('LaravelHrabac\AccessControl\Controllers\PermissionController');
		$this->app->make('LaravelHrabac\AccessControl\Controllers\UserController');


    }

}
