<?php

namespace core\cache;
use core\config\config;
use core\cache\specs;

class file implements specs{

	public $config;

	public function __construct(){

		$this->config = '';
		
	}

	
	//写入缓存
	public function write($key,$value,$expire=""){


		$file = DIR.'/return/cache/'.md5($key).'.cache';

		if(empty($expire)){
			
			$data = "0000000000|".serialize($value);
		}else{
			$data = time()+$expire."|".serialize($value);
		}

		return file_put_contents($file, $data);

	}

	//读取缓存
	public function read($key){

		
		if(!$this->has($key)){
			return false;
		}

		$file = DIR.'/return/cache/'.md5($key).'.cache';

		$file = file_get_contents($file);

		$str = substr($file,0, 10);

		$explode = explode("|", $str);

		//过期
		if($explode[1] > time()){
			return false;
		}

		return unserialize(substr($file, 11));

	}

	public function has($key){

		

		$file = DIR.'/return/cache/'.md5($key).'.cache';

		return file_exists($file);


	}

	//更新缓存
	public function pull($key,$value,$expire=""){

		

		return $this->write($key,$value,$expire="");

	}
	//删除缓存
	public function delete(){

		

		if(!$this->has($key)){
			return false;
		}

		unlink(DIR.'/return/cache/'.md5($key).'.cache');

	}

	//设置缓存有效期
	public function expire($key,$time="0000000000"){

		
		
		if(!$this->has($key)){
			return false;
		}

		$file = DIR.'/return/cache/'.md5($key).'.cache';

		$file = file_get_contents($file);

		$str = substr($file,0, 10);

		$explode = explode("|", $str);

 		$data = $time."|".serialize($explode[1]);
	
		return file_put_contents($file, $data);


	}

	//缓存表示
	public function key(){

		

	}
}