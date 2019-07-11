<?php

namespace core\debug;

class  debug{

	//consolelog 提示
	public static function console($data){

		echo "<script>console.log('".$data."');</script>";
		
	}
	//写入日志
	public static function log($text){

		$text = "[".date('Y-m-d H:i:s')."]  "  .$text." \r\n";

		error_log($text, 3, DIR."/return/log/".date('Y-m-d').".log");

	}

}
