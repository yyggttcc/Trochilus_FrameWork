<?php

namespace core\cache;

class redis implements specs{

	public $redis;

	public $config;

	public function __construct($config){

		$this->redis = new Ridis();

		$this->config =array_merge($,$config);

	}

	//写入缓存
	public function write($key,$value,$expire=""){

		$key = $this->config[$key];

		$res = $this->redis->set($key,serialize($value));

		if(empty($expire)){
			$this->redis->expire($key,$expire);
		}

		return $res;

	}

	//读取缓存
	public function read($key){

		$key = $this->config[$key];

		if(!$this->has($key)){
			return false;
		}

		return unserialize($this->redis->get($key));

	}

	public function has($key){

		$key = $this->config[$key];

		return $this->redis->exists($key);

	}

	//更新缓存
	public function pull($key,$value,$expire=""){

		$key = $this->config[$key];

		return $this->write($key,$value,$expire="");

	}
	//删除缓存
	public function delete($key){

		$key = $this->config[$key];

		return $this->redis->del($key);

	}

	//设置缓存有效期
	public function expire($key,$time="90000000000"){

		$key = $this->config[$key];

		return $this->redis->expire($key,$time);


	}

	//缓存表示
	public function key(){



	}
}