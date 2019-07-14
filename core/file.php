<?php

namespace core;
use core/config;

class  file{

	public $config;

	public function __construct($config=[]){
		
		$this->config = array_merge(config::init('file')->read(),$config);

	}
	//创建文件夹
	public function mkdir(){

	}

	//验证 文件大小 后缀
	public function validate($validate = []){
		

		$this->config['size'] = $validate['size'];
		$this->config['ext'] = $validate['ext'];

	}

	//文件保存位置
	public function dir($dir){
		$this->config['dir'] = $validate['dir'];
	}

	//保存规则
	public function rule($rule){

		$this->config['rule'] = $rule;
	}

	public function upload($filename = ''){

		$config = $this->config['rule'];

		$dir = DIR.'publi/'.$config['dir'].'//'.date('Ymd');

		if(!is_dir($dir)){

			$mk = mkdir($dir);

			if(!$mk){
				return '文件夹创建失败';
			}

		}

		$file = $_FILES[$filename];

		if($file['error'] > 0){

			switch($file['error']){
		      case 1:
		        return '上传文件超过了php配置文件中upload_max_filesize选项的值';
		        break;
		      case 2:
		        return '超过了表单MAX_FILE_SIZE限制的大小';
		        break;
		      case 3:
		        return '文件部分被上传';
		        break;
		      case 4:
		        return '没有选择上传文件';
		        break;
		      case 6:
		        return '没有找到临时目录';
		        break;
		      case 7:
		      case 8:
		        return '系统错误';
		        break;
		   }

		}

		if($config['size'] !== true && $file['size'] > $config['size']){

			return '文件大小超出规定限制';
		}

		switch ($config['rule']) {
			
			case 'md5':
				$name = md5($file['name']);
				break;
			
			default:
				$name = md5($file['name']);
				break;

		}

		$type = 'txt';

		if($config['ext'] ! == '' && !in_array($type, explode(',', $config['ext']))){
			return '上传文件格式错误';
		}

		$save_file = $dir.'/'.$name.'.'.$type;

		$res = file_put_contents($save_file, file_get_contents($_FILES['tmp_name']));
		

		if($res){
			return $save_file;
		}

		return '文件保存错误';



	}
	//创建文件

}