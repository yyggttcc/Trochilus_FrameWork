<?php

namespace core;
use core\config;
use core\debug;

class db{

	public $db;

	public static $connect;

	public static $instance ;

	public static $data;

	public $restful;

	public $sql;

	public function __construct(){


		if (!self::$instance ) {
			
            self::instance();
        }

        return self::$instance;
        


	}

	public static function init(){
		return new self;
	}


	//链接数据库
	public static function instance(){

		$config = config::name('database')->read();

		try {  


			$dsn="mysql:dbname=".$config['database'].";host=".$config['hostname'];  

			//启动分布式
			if($config['hadoop'] === true){
				
				$read  =  new \PDO($dsn,$config['username'],$config['password']); 
				$write  =  new \PDO($dsn,$config['username'],$config['password']); 

				self::$instance = [
					'read' => $read,
					'write' => $write,
				];

			}else{

				//生成PDO对象  
				self::$instance =  new \PDO($dsn,$config['username'],$config['password']); 	
			}

			


		} catch (PDOException $e) {  

			trigger_error($e->getMessage()); 
		    
		}

	}

	//执行sql
	public static function query($sql){


		if(stristr($sql,'select')){

			return self::select($sql);

		}

		return self::exec($sql); 
	}

	//读操作
	public  function select($sql){

		$this->sql = $sql;

		if(!stristr($sql,'select')) return self::exec($sql);

		$hadoop = config::name('database')->read('hadoop');

		$pod = (self::$instance);

		if($hadoop === true){

			$pod = $pod['read'];
		}

		return $pod->query($sql)->fetchAll();

	}

	//写操作，返回影响行数,
	public function exec($sql,$getlastid = false){

		$this->sql = $sql;

		$hadoop = config::name('database')->read('hadoop');

		$pdo = (self::$instance);

		if($hadoop === true){
			$pdo = $pdo['write'];
		}

		$res = $pdo->exec($sql);

		if($getlastid === true && $res){

			return $pdo->lastInsertId();
			
		}

		return $res;


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
	public function __destruct() {
      
     	$this->log();
    }

    //写入日志
    public function log(){

    	$text = "当前执行sql：".$this->sql;

    	debug::log($text,'sql');
    }

}