<?php

namespace core\debug;

class  debug{

	//consolelog 提示
	public static function console($data){

		$data = is_array($data) ? join(",",$data) : $data;

		echo "<script>console.log('".$data."');</script>";
		
	}
	//写入日志
	public static function log($text, $type = 'info'){

		$text = "[".date('Y-m-d H:i:s')."] [".$type."]  "  .$text." \r\n";

		error_log($text, 3, DIR."/return/log/".date('Y-m-d').".log");

	}

	//不同的日志类型写入
	public static function log_error($text){
		self::log($text,'error');
	}

	public static function log_info($text){
		self::log($text,'info');
	}

	public static function log_success($text){
		self::log($text,'success');
	}
	

}
