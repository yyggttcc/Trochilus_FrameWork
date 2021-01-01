<?php
namespace app\index\controller;

use core\captcha;
use core\db;
use app\protecteds\controller\index as inde;


class index extends common{


	public function index($name='0000'){


		exit("<br><br><br><br><br><br><br><center><b><h2>php 框架</h2></b></center>");

		$this->fetch(); 

	}
	public function user(){
		$this->index();
	}


}
