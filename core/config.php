<?php

namespace core;

class config{

	public static $arr;
	public static $file;

	public static function name($name){

		self::$file = DIR.'config/'.$name.'.php';

		if(file_exists(self::$file)){

			self::$arr =  include(self::$file);

			return new self;

		}else{
			trigger_error("文件不存在"); 
		}

	}

	//读取一个配置
	public function read($name='',$default= ""){

	   if(self::$arr[$name] == ''){
            return $default;
       }

	   return self::$arr[$name];

		//return empty($name) ? self::$arr : self::$arr[$name];


	}

	public static  function __callStatic($class,$var){

        return (new self)->$class($var);
    }

	//写配置
	public function write($name,$value){

		$arr = self::$arr;

		$arr[$name] = $value;

		$text="<?php return ".var_export($arr, true).";";


        return file_put_contents(self::$file, $text);

	}	

	//是否存在
	public function has($name){
		
		return true == empty($this->read($name));
	}

}