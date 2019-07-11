<?php

namespace core\cache;
use core\config\config;

class cache{

	public static $type = '';

	//定义使用缓存类型
	public static function init($type='file'){

		self::$type =  $type;

		/*$class = '\core\cache\/'.$type;
		return new $class;



*/
	}



	public static function __callStatic($method, $args){
		

		$type = config::name('cache')->read('type');

		if(!empty($type)){

			$class =  '\core\cache\\'.$type;

		} else if(!empty(self::$type)){

			$class =  '\core\cache\\'.self::$type;

	 	}else {

	 		$class =  '\core\cache\file';

	 	}

	 	$class = new $class;

	 	return call_user_func_array([$class, $method], $args);
	
	}
	

}