<?php
namespace core;
use core\config\config;
use core\session\session;

class captcha{


	protected $config;

	public function __construct($config = []){

		$this->config = array_merge(config::name('captcha')->read(),$config);

	}

	public function width($width){

		$this->config['width'] = $width;

		return  $this;
	}

	public function height($height){

		$this->config['height'] = $height;

		return  $this;
	}

	public function length($length){

		$this->config['length'] = $length;

		return  $this;

	}

	public function type($type){

		$this->config['type'] = $type;

		return  $this;

	}

	public function expire($expire){

		$this->config['expire'] = $expire;

		return  $this;
	}

	public function fontsize($fontsize){

		$this->config['fontsize'] = $fontsize;

		return  $this;
	}

	public function isline($isline){

		$this->config['isline'] = $isline;

		return  $this;
	}

	public function ispixel($ispixel){

		$this->config['ispixel'] = $ispixel;

		return  $this;
	}

	//随机数
	public function rand_text(){


		$text = $this->config[$this->config['type'].'Set'];


		if($this->config['type'] == 'en'){
			
			return  $text[rand(0,strlen($text)-1)];

		}

		//汉字截取
		$rand = rand(0,mb_strlen($text, 'utf8')-1);
		
		return mb_substr($text,$rand,1);

	}

	//创建验证码
	public function make(){

		$config = $this->config;

		//创建画布

		$image = imagecreatetruecolor($config['width'], $config['height']);
 
		//2.为画布定义(背景)颜色
		$bgcolor = imagecolorallocate($image, 255, 255,255);

		//3.填充颜色
		imagefill($image, 0, 0, $bgcolor);

		//4.1 创建一个变量存储产生的验证码数据，便于用户提交核对
		$captcha = "";

		for ($i = 0; $i < $config['length']; $i++) {

		    // 字体大小
		    $fontsize = $config['fontsize'];
		    // 字体颜色
		    $fontcolor = imagecolorallocate($image, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120));
		    // 设置字体内容

		    $fontcontent =  iconv('utf-8','gb2312',$this->rand_text());

		    $captcha .= $fontcontent;
		    // 显示的坐标
		    $x = ($i * $config['width'] / $config['length']) + mt_rand(5, 10);

		    $y =$text_height = ($config['height']-$config['fontsize']) /2 - $fontsize;

		    $text_height  = $config['height'] / 2 + $config['fontsize'] /2;

		    $y = rand($text_height +$config['fontsize']/3, $text_height -$config['fontsize']/3);


		    // 填充内容到画布中
		    
		    imagettftext($image, $fontsize, 0, $x, $y, $fontcolor, $config['font'], $fontcontent);

		}

		$session = new session();

		$session->set($config['pxire'], $captcha);

		//4.3 设置背景干扰元素, xy 的位置
		if($config['ispixel']){

			for ($i = 0; $i < 200; $i++) {
			    $pointcolor = imagecolorallocate($image, mt_rand(50, 200), mt_rand(50, 200), mt_rand(50, 200));

			    imagesetpixel($image, mt_rand(1, $config['width']), mt_rand(1, $config['height']), $pointcolor);
			}

		}
		 
		//4.4 设置干扰线 x1 y1，x2 y2

		if($config['isline']){
		
			for ($i = 0; $i < 3; $i++) {
			    $linecolor = imagecolorallocate($image, mt_rand(50, 200), mt_rand(50, 200), mt_rand(50, 200));
			    imageline($image, mt_rand(1, $config['width']), mt_rand(1, $config['height']), mt_rand(1, $config['width']), mt_rand(1, $config['height']), $linecolor);
			}

		}


		imagepng($image);
 	
 		header('content-type:image/png');

		//7.销毁图片
		//imagedestroy($image);　


	}

	//验证验证码
	public function check($code){

		$session = new session();
		$config = new config();
		
		if($session->get($config['pxire']) !== $code || $session->get($config['pxire']) == ''){
			return false;
		}

		return true;

	}




}