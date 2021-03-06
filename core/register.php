<?php
namespace core;

use core\debug;
use core\config;

defined('DIR') OR exit('No direct script access allowed');

class register{

	private $starttime ='';
	
	private $self =  '';

	public static $filenum= 1;

	public static $runtime ='';

	//初始方法
	public  static function init(){
		
		if(substr(PHP_VERSION, 0,1) < 7)  exit('PHP 版本不能小于7！');

		date_default_timezone_set("Asia/ShangHai");

		header("Content-Type: text/html; charset=UTF-8");

		return new self;

	}

	//
	public function default($action=[]){

		self::$runtime = microtime(true);

		error_reporting(E_ALL);

		//错误处理

		set_error_handler([__CLASS__,'error_handler']);

		//异常处理

		set_exception_handler([__CLASS__,'exception_handler']);

		//静默输出
		register_shutdown_function([__CLASS__,'output']); 

		//自动加载
		spl_autoload_register([__CLASS__,'autoload']);


		if(!empty($action) && is_array($action)){

			foreach ($action as $key => $value) {
				$this->require($value.'.php');
			}
		}

		$this->self = new self;

		return $this->self;

	}	

	public function run(){

		require_once ( DIR."core/common.php");

		//$PATH_INFO = $_SERVER['PATH_INFO'];

		$arr = [];

		if(isset($_SERVER['ORIG_SCRIPT_NAME']))  $arr = explode("/", $_SERVER['ORIG_SCRIPT_NAME']);	

		$module = isset($arr[3]) ?: 'index';
		$controller = isset($arr[4]) ?: 'index';
		$action = isset($arr[5]) ?: 'index';

		$class = strtolower("\app\\$module\controller\\$controller");

		//受保护目录 不可直接访问
		if('protecteds' == $module){

			$class = new \ReflectionMethod($class,$action);

			$class -> setAccessible(true);

		}
		
		//反射
	    $class = new \ReflectionClass($class);

	    //获取类注解
	    //方法是否存在
	     
	    if(!$class->hasMethod($action)){
	    	trigger_error('当前方法不存在');
	    }

	    //$res = $class->getMethod($action)->getDocComment();

	    return $class->newInstanceArgs()->$action();

	}

	public function __call($className, $arguments) {


	}


	//自动加载文件
	public static function autoload($class){
	
		$class =  str_replace('\\','/',$class);
		
		$file = DIR.$class.".php";

		if(file_exists($file)){

			$res = require_once($file);

			self::$filenum++;

		}else{

	
			trigger_error("当前引入的文件：$file不存在");
		}

	}

	//错误处理
	public static function error_handler($data,$data2,$errfile,$errline){

		if( config::name('app')->read('debug') !== true){

			return false;
		}

		echo ("File: ".$errfile."  Line:   ".$errline);
		
		dd($data2);

	


	}

	//异常处理
	public static function exception_handler($data){

		if( config::name('app')->read('debug') !== true){

			return false;
		}

		dd($data);
		

	}

	//静默输出
	public static function output(){

			$run_time = round((microtime(true)-self::$runtime),3);
			if($run_time === 0){
				$run_time = round((microtime(true)-self::$runtime),5);
			}
					
			$str1 =  "运行时间:".$run_time."秒,";


			$size = memory_get_usage(true);
			$unit=array('b','kb','mb','gb','tb','pb');
	    	$str2 =  "运行内存:". @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i].",";
	    	$str3 = "引入文件数量:".self::$filenum.",";

		    if( config::name('app')->read('debug') === true){
				debug::console($str1);
				debug::console($str2);
				debug::console($str3);
			}

			//写入日志
			debug::log($str1.$str2.$str3);


	}

	//加载方法
	public function require(){

		require_once('');

	}

	

	//静态调用方法

	public static function __callStatic($name,$avg){
	 	
	}
	


}
