<?php
namespace app\index\controller;

use app\index\controller\index as in;

class index extends common{

	public function user(){


		$this->fetch('index'); 

	}
	public function ceshi(){
		$class = new \app\index\controller\index;
		$class ->data("asasssssssssss","____","asdas");
		//echo "我是测试";
	}
	public function data($name,$aa){



		echo "传入的数据是".$name.$aa;

	}

}