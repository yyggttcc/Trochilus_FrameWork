<?php
namespace app\index\controller;

use core\captcha;
use core\db;
use app\protecteds\controller\index as inde;
/** 
* A test class
*
* @param  foo bar
* @return baz
*/
class index extends common{

	/*public function __construct(){
		parent::__construct();
		echo '子类';
	}*/

	/** 
	* A test class
	*
	* @param  foo bar
	* @return baz
	*/
	public function index($name='0000'){
		
		exit($name);
	/*	$index= new inde();
		$index->index();
		exit;*/
		//dd($db);
		$this->fetch(); 

	}
	public function user(){
		$this->index();
	}

	public function jwt(){




	}


	

}
