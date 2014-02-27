<?php namespace Breadam\Boom\Facades;

use Illuminate\Support\Facades\Facade;

class Boom extends Facade{
	
	 protected static function getFacadeAccessor(){ 
		return "boom"; 
	}
	
}