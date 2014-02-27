<?php namespace Breadam\Boom\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class WatchCommand extends Command{
	
	protected $name = "boom:watch";
	
	protected $description = "watch changes";
	
	public function fire(){
		
		$this->info("Watching for changes");
		
		chdir(app("boom")->boomPath());
		shell_exec("gulp watch");
	}
}