<?php

namespace framework;

class session {


	public $config;

	public function __construct($config=''){

		$this->config = array_merge($config,$config);

		session_start();
	}

	public function set($name , $value){
			
		$name = $this->config['prefix'].$name;

		$_SESSION[$name] = $value;

	}

	public function get($name){

		$name = $this->config['prefix'].$name;

		return $_SESSION[$name];

	}

	public function del($name){

		$name = $this->config['prefix'].$name;
		
		return unset($_SESSION[$name]);

	}


}