<?php

namespace core\db;
use core\config\config;

class db{

	public $db;

	public static $connect;

	public static $instance = '';

	public static $data;

	public $restful;


	public function __construct(){


		if (!self::$instance ) {
			
            self::instance();
        }
        


	}

	//链接数据库
	public static function instance(){

		$config = config::name('database')->read();

		try {  


			$dsn="mysql:dbname=".$config['database'].";host=".$config['hostname'];  
			//数据库的用户名  

			//生成PDO对象  
			self::$instance =  new \PDO($dsn,$config['username'],$config['password']); 


		} catch (PDOException $e) {  

			trigger_error($e->getMessage()); 
		    
		}

	}

	//执行sql
	public static  function query($sql){

		return  (self::$instance)->query($sql)->fetchAll();

	}

	//返回影响行数
	public static function exec($sql){

		return (self::$instance)->exec($sql);

	}


	public function tojson(){

		/*$this->data = json_encode($this->data->toarray());
		return $this;*/

	}

	// public static function __callStatic($method, $args){

	// 	$class = new $this;

	//  	return call_user_func_array([$class, $method], $args);
	// }
	//返回数值
	/*public function __destruct(){

		return self::$data;

	}*/

}