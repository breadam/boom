<?php namespace Breadam\Boom;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Config\Repository as Config;

use View;

class Boom{
	
	private $config;
	private $filesystem;
	private $avaliableAssets = array("js","css");
	private $generators = array();
	private $assets = array();
	
	public function __construct(Config $config,Filesystem $filesystem){
		$this->config = $config;
		$this->filesystem = $filesystem;
		
	}
	
	public function generate($overwrite = false){
		$this->generateNpm($overwrite);
		$this->generateBower($overwrite);
		$this->generateGulp($overwrite);
		$this->generateImport("scss",$overwrite);
		$this->generateImport("less",$overwrite);
		$this->generateImport("css",$overwrite);
	}
	
	public function generateBower($overwrite = false){
		$content = View::make("boom::bower",array(
			"dependencies" => $this->toJson($this->config("bower.dependencies"))
		));
		$this->createFile($this->boom(),"bower.json",$content,$overwrite);
	}
	
	public function generateGulp($overwrite = false){
		$content = View::make("boom::gulpfile",array(
			"assets" => $this->toJson(array(
				"js" => $this->jsConfig(),
				"css" => $this->cssConfig(),
				"coffee" => $this->coffeeConfig(),
				"less" => $this->lessConfig(),
				"scss" => $this->scssConfig(),
			))
		));
		$this->createFile($this->boom(),"gulpfile.js",$content,$overwrite);
	}
	
	public function generateNpm($overwrite = false){
		$content = View::make("boom::package");
		$this->createFile($this->boom(),"package.json",$content,$overwrite);
		
	}
	
	public function generateImport($asset,$overwrite = false){
		
		$imports = $this->config("assets.$asset.imports");
		if(isset($imports)){
			$content = View::make("boom::import",array(
				"boom" => $this->boom(),
				"imports" => $imports
			));
			$this->createFile($this->source($asset),"master.$asset",$content,$overwrite);
		}
	}
	
	public function boom($sub = null){
		return $this->path($this->config("boom"),$sub);
	}
	
	public function source($sub = null){
		return $this->path($this->config("source"),$sub);
	}
	
	public function target($sub = null){
		return $this->path($this->config("target"),$sub);
	}
	
	private function jsConfig(){
		
		$imports = $this->config("assets.js.imports");
		$order = $this->config("assets.js.order");
		$includes = array();
		
		foreach($imports as $import){
			$includes[] = $this->boom("bower_components/$import");
		}
		
		foreach($order as $file){
			$includes[] = $this->source($this->config("assets.js.source")."/$file");
		}
		
		return array(
			"source" => $this->source($this->config("assets.js.source")),
			"target" => $this->target($this->config("assets.js.target")),
			"order" => $includes
		);
	}
	
	private function coffeeConfig(){
		$imports = $this->config("assets.coffee.imports");
		$includes = array();
		
		foreach($imports as $import){
			$includes[] = $this->boom("bower_components/$import");
		}
		
		return array(
			"source" => $this->source($this->config("assets.coffee.source")),
			"target" => $this->source($this->config("assets.js.source")."/".$this->config("assets.coffee.target")),
			"order" => $includes
		);
	}
	
	private function cssConfig(){
		return array(
			"source" => $this->source($this->config("assets.css.source")),
			"target" => $this->target($this->config("assets.css.target")),
		);
	}
	
	private function scssConfig(){
		return array(
			"source" => $this->source($this->config("assets.scss.source")),
			"target" => $this->source($this->config("assets.css.source")."/".$this->config("assets.scss.target")),
		);
	}
	
	private function lessConfig(){
		return array(
			"source" => $this->source($this->config("assets.less.source")),
			"target" => $this->source($this->config("assets.css.source")."/".$this->config("assets.less.target")),
		);
	}
	
	private function toJson(array $arr){
		return json_encode($arr);
	}
	
	private function createDirs(){
		$this->createDir($this->config("boom"));
		$this->createDir($this->config("source"));
		$this->createDir($this->config("target"));
	}
	
	private function config($key){
		return $this->config->get("boom::config.$key");
	}
	
	private function path($base,$sub = null){
		$ret = $base;
		if(isset($sub)){
			$ret .= "/$sub";
		}
		return $ret;
	}
	
	private function createFile($path,$file,$content,$overwrite = false){
		
		if($overwrite === false && $this->filesystem->exists($path)){
			return;
		}
		
		$this->createDir($path);
		$this->filesystem->put("$path/$file",$content);
	}
	
	private function createDir($path){
		if(!$this->filesystem->exists($path)){
			$this->filesystem->makeDirectory($path, 0777, true);
		}
	}
}