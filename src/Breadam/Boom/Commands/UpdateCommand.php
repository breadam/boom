<?php namespace Breadam\Boom\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateCommand extends Command{
	
	protected $name = "boom:update";
	
	protected $description = "updates dependencies";
	
	public function getOptions(){
		return array(
			array("npm","",InputOption::VALUE_NONE,"npm update",),
			array("bower","",InputOption::VALUE_NONE,"bower update")
		);
	}
	
	public function fire(){
		
		$o = $this->option();
		$isset = false;
		
		if($o["npm"]){
			$isset = true;
			$this->info("Updating Npm packages");
			chdir(app("boom")->boom());
			shell_exec("npm update");
		}
		
		if($o["bower"]){
			$isset = true;
			$this->info("Updating Bower packages");
			chdir(app("boom")->boom());
			shell_exec("bower update");
		}
		
		if($isset === false){
		
			$this->info("Updating all packages");
			
			chdir(app("boom")->boom());
			shell_exec("npm update");
			shell_exec("bower update");

		}
	}
	
}