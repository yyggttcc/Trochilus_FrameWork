<?php

namespace core\request;

class  request{

	public $server;

	public function __construct(){

		$this->request = $_SERVER;
	}

	//请求方式
	public function method(){

		return strtolower($this->request['REQUEST_METHOD']);

	}
	//是否get
	public function isget(){
		return  'get'== $this->method();
	}
	//是否post
	public function ispost(){
		return  'post'== $this->method();
	}
	//是否put
	public function isput(){
		return  'put'== $this->method();
	}
	//是否delete
	public function isdelete(){
		return  'delete'== $this->method();
	}
	//请求参数
	public function input($name=''){

		$input = htmlspecialchars($this->request['QUERY_STRING']);

		if(!empty($input)){

			$data= explode("&", $input);

			$arr = [];

			foreach ($data as $key => $value) {
				
				$res = explode("=", $value);
				$arr[$res[0]] = $res[1];

			}


		}


		return empty($name) ? $arr : $arr[$name];
	}
	//post 请求
	public function post($name=''){

		$post = htmlspecialchars($_POST);

		return empty($name) ? $post : $post[$name];
	}

	public function module(){

		$data =explode("/", $this->request['PATH_INFO']);

		return $data[1];

	}
	
	public function controller(){

		$data =explode("/", $this->request['PATH_INFO']);

		return $data[2];

	}

	public function action(){

		$data =explode("/", $this->request['PATH_INFO']);

		return $data[3];

	}
	public function http_code(){

		return $this->request['REDIRECT_STATUS'];
		
	}


}
