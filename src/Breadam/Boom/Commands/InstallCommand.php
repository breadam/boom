<?php namespace Breadam\Boom\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallCommand extends Command{
	
	protected $name = "boom:install";
	
	protected $description = "installs dependencies";
	
	public function getOptions(){
		return array(
			array("npm","",InputOption::VALUE_NONE,"npm install",),
			array("bower","",InputOption::VALUE_NONE,"bower install")
		);
	}
	
	public function fire(){
		
		$o = $this->option();
		$isset = false;
		
		if($o["npm"]){
			$isset = true;
			$this->info("Installing Npm packages");
			chdir(app("boom")->boomPath());
			shell_exec("npm install");
		}
		
		if($o["bower"]){
			$isset = true;
			$this->info("Installing Bower packages");
			chdir(app("boom")->boomPath());
			shell_exec("bower install");
		}
		
		if($isset === false){
		
			$this->info("Installing all packages");
			
			chdir(app("boom")->boomPath());
			shell_exec("npm install");
			shell_exec("bower install");

		}
	}
	
}