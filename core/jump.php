<?php
namespace core;
//注册类

trait jump{

	public $lode;

	//成功
	public function success($data="操作成功~",$code="1"){

		$arr= array(

			'data' =>$data,
			'code' =>$code

		);

		echo json_encode($arr);

		return false;
	}

	//失败
	public function error($data="操作失败~",$code="0"){

		$arr= array(

			'data' =>$data,
			'code' =>$code

		);

		echo json_encode($arr);

		return false;

	}
	
	//跳转
	public function redirect($url){
		header('Location: '.$url);exit;
	}

	//加载模板
	//模板名称，参数
	public function fetch($name='',$vars=[]){


		if(empty($name)){
			$name = get_class_methods($this)[0];
		}
	
		$arr= explode("/", $name);

		switch (count($arr)) {
			case '3':
				$file = DIR.'app/'.$arr['0'].'/view/'.$arr['1'].'/'.$arr['2'].'.php';
				break;
			case '2':
				$file = DIR.'app/index/view/'.$arr['0'].'/'.$arr['1'].'.php';
				break;
			case '1':
				$file = DIR.'app/index/view/index/'.$name.'.php';
				break;
			default:
				$file = DIR.'app/index/view/index/index.php';
				break;
		}

		if(is_file($file)){

			if(!empty($vars)){
				extract($vars);
			}
			
			include_once ($file);
			
		}
		



	}

	public function __call($name, $arg){

		$name = "\core\\$name\\$name";

		return call_user_func_array([new $name, array_shift($arg)], $arg);
  	 	
    }

    public function __set($name,$value){
    	
    	
    }

    public function __get($name){

    	if('load' == $name) return $this;
    	
    }

} 