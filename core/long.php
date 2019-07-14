<?php

namespace core;
use core/config;

class  long{

	public $config;

	public function __construct($config=[]){
		
		$this->config = array_merge(config::init('long')->read(),$config);

	}
	
	public function long(){
		
	}

}