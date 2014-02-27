<?php namespace Breadam\Boom\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateCommand extends Command{
	
	protected $name = "boom:generate";
	
	protected $description = "generates necessary files";
	
	public function getOptions(){
		return array(
			array("overwrite","o",InputOption::VALUE_NONE,"overwrite if file(s) exist(s)"),
			array("npm","",InputOption::VALUE_NONE,"generate package.json"),
			array("bower","",InputOption::VALUE_NONE,"generate bower.json"),
			array("gulp","",InputOption::VALUE_NONE,"generate gulpfile.js"),
			array("css","",InputOption::VALUE_NONE,"generate base.css"),
			array("scss","",InputOption::VALUE_NONE,"generate base.scss"),
			array("less","",InputOption::VALUE_NONE,"generate base.less")
		);
	}
	
	public function fire(){
		
		$o = $this->option();
		$overwrite = $this->option("overwrite");
		$isset = false;
		
		if($o["npm"]){
			$isset = true;
			$this->info("Generating package.json");
			app("boom")->generateNpm($overwrite);
		}
		
		if($o["bower"]){
			$isset = true;
			$this->info("Generating bower.json");
			app("boom")->generateBower($overwrite);
		}
		
		if($o["gulp"]){
			$isset = true;
			$this->info("Generating gulpfile.js");
			app("boom")->generateGulp($overwrite);
		}
		
		if($o["css"]){
			$isset = true;
			$this->info("Generating base.css");
			app("boom")->generateImport("css",$overwrite);
		}
		
		if($o["scss"]){
			$isset = true;
			$this->info("Generating base.scss");
			app("boom")->generateImport("scss",$overwrite);
		}
		
		if($o["less"]){
			$isset = true;
			$this->info("Generating base.less");
			app("boom")->generateImport("less",$overwrite);
		}
		
		if($isset === false){
		
			$this->info("Generating all");
			
			app("boom")->generate($overwrite);

		}
	}
	
}