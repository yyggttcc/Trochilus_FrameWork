<?php

namespace core;
//注册类

trait jump{

	//成功
	public function success($data="操作成功~",$code="1"){

		$arr= array(

			'data' =>$data,
			'code' =>$code

		);
		echo json_encode($arr);
		exit;
	}

	//失败
	public function error($data="操作成功~",$code="1"){

		$arr= array(

			'data' =>$data,
			'code' =>$code

		);

		echo json_encode($arr);

		exit;

	}
	//跳转
	public function redirect($url){
		header('Location: '.$url);exit;
	}

	//加载模板
	//模板名称，参数
	public function fetch($name='',$vars=[]){

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

		include ($file);


	}

} 