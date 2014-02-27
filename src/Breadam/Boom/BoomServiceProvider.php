<?php namespace Breadam\Boom;

use Illuminate\Support\ServiceProvider;

class BoomServiceProvider extends ServiceProvider {

	protected $defer = false;

	public function boot(){
    $this->package("breadam/boom");
	}
	
	public function register(){
		
		$this->app->bind("boom", function($app){
			return new \Breadam\Boom\Boom($app["config"],$app["files"]);
		});
		
		$this->app->booting(function(){
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias("Boom", "Breadam\Boom\Facades\Boom");
		});
		
		$this->registerGenerate();
		$this->registerInstall();
		$this->registerUpdate();
		$this->registerBuild();
		$this->registerWatch();
		
		$this->commands(
			"boom.generate",
			"boom.install",
			"boom.update",
			"boom.build",
			"boom.watch"
		);
	}

	protected function registerGenerate(){
	
		$this->app["boom.generate"] = $this->app->share(function($app){
			
			return new Commands\GenerateCommand();
		});
	}
	
	protected function registerInstall(){
	
		$this->app["boom.install"] = $this->app->share(function($app){
			
			return new Commands\InstallCommand();
		});
	}
	
	protected function registerUpdate(){
	
		$this->app["boom.update"] = $this->app->share(function($app){
			
			return new Commands\UpdateCommand();
		});
	}
	
	protected function registerBuild(){
	
		$this->app["boom.build"] = $this->app->share(function($app){
			
			return new Commands\BuildCommand();
		});
	}
	
	protected function registerWatch(){
	
		$this->app["boom.watch"] = $this->app->share(function($app){
			
			return new Commands\WatchCommand();
		});
	}
}