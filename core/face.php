<?php

namespace core;

use core\config;


class face{


	protected $config;

	protected static $self;


	public function __construct($config = []){

		$this->config = array_merge($this->getconfig(),$config);

	}

	protected function getconfig(){

		$arr = explode('\\', get_class($this));

		return config::name($arr[1])->read();

	}
	
	public static function init($class=''){

		if(!self::$self){

			//获取子类类名
			$class =  get_called_class();

			self::$self = new $class;
		}

		return self::$self;

	}

	public function __call($method,$args){

		$this->config[$method] = $args[0];

		return self::$self;

	}

	public function __set($name,$value){

	}

}