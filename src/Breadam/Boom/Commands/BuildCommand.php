<?php namespace Breadam\Boom\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class BuildCommand extends Command{
	
	protected $name = "boom:build";
	
	public function getOptions(){
		return array(
			array("js","",InputOption::VALUE_NONE,"gulp js",),
			array("css","",InputOption::VALUE_NONE,"gulp css"),
			array("coffee","",InputOption::VALUE_NONE,"gulp coffee"),
			array("scss","",InputOption::VALUE_NONE,"gulp scss"),
			array("less","",InputOption::VALUE_NONE,"gulp less"),
			array("img","",InputOption::VALUE_NONE,"gulp img"),
		);
	}
	
	public function fire(){
		
		$o = $this->option();
		$isset = false;
		
		if($o["js"]){
			$isset = true;
			$this->info("Building js");
			chdir(app("boom")->boomPath());
			shell_exec("gulp js");
		}
		
		if($o["css"]){
			$isset = true;
			$this->info("Building css");
			chdir(app("boom")->boomPath());
			shell_exec("gulp css");
		}
		
		if($o["coffee"]){
			$isset = true;
			$this->info("Building coffee");
			chdir(app("boom")->boomPath());
			shell_exec("gulp coffee");
		}
		
		if($o["scss"]){
			$isset = true;
			$this->info("Building scss");
			chdir(app("boom")->boomPath());
			shell_exec("gulp scss");
		}
		
		if($o["less"]){
			$isset = true;
			$this->info("Building less");
			chdir(app("boom")->boomPath());
			shell_exec("gulp less");
		}
		
		if($o["img"]){
			$isset = true;
			$this->info("Building img");
			chdir(app("boom")->boomPath());
			shell_exec("gulp imgs");
		}
		
		if($isset === false){
		
			$this->info("Building default");
			chdir(app("boom")->boomPath());
			shell_exec("gulp");

		}
	}
	
}