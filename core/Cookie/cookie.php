<?php

class  cookie{


	public function __construct($config){

	}

	public function set($name,$value,$expire='',$domain='/'){

		setcookie($name, $value, time()+60*60*24*365, '/', $domain, false);
	}

	public function get($name){
		return $_COOKIE[$name];
	}

	//删除
	public function del($name){
		return $this->set($name,'',time()-3600);
	}
}
