<?php
namespace app\index\controller;

use core\captcha;
use core\db;
use core\config;
use app\protecteds\controller\index as inde;


class index extends common{


	public function index($name='0000'){

        $name = config::name('app')->read('name');

		exit("<br><br><br><br><br><br><br><center><b><h2> $name de   php 框架</h2></b></center>");

		$this->fetch(); 

	}
	public function user(){
		$this->index();
	}


}
