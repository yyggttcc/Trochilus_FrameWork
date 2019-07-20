<?php

namespace core\nosql;


class redis{


	public $redis;

	public $config = [

		'ip' => '127.0.0.1'

	];

	public function __construct(){

		$this->redis = new \Redis();

		$this->redis->connect('127.0.0.1', 6379); //连接Redis
   		//$this->redis->auth('mypasswords123sdfeak'); //密码验证


	}

	public function set($name,$value){

		return $this->redis->set($name,$value);

	}

	public function get($name){

		return $this->redis->get($name);

	}

	//k长度
	public function strlen($key){
		return $this->redis->strlen($key);
	}

	public function exists($key){
		return $this->redis->exists($key);
	}

	public function del($key){
		return $this->redis->del($key);	
	}

	public function expire($key){
		return $this->redis->expire($key);
	}

	public function ttl($key){
		return $this->redis->ttl($key);
	}

	public function select($name){
		return $this->redis->select($name);
	}

	public function type($key){
		return $this->redis->type($key);
	}

	//list 操作
	public function lpush($name,$valye){
		return $this->redis->lpush($name,$valye);
	}

	public function rpush($name,$valye){
		return $this->redis->rpush($name,$valye);
	}

	public function lpop($name){
		return $this->redis->lpop($name);
	}

	public function rpop($name){
		return $this->redis->rpop($name);
	}

	//集合操作

	public function sadd($name,$valye){
		return $this->redis->sadd($name,$valye);
	}

	public function srem($name,$valye){
		return $this->redis->srem($name,$valye);
	}

	public function sismember($name,$valye){
		return $this->redis->sismember($name,$valye);
	}

	public function smembers($name){
		return $this->redis->smembers($name);
	}

	public function scard($key){
		return $this->redis->scard($key);
	}

	public function spop($name){
		return $this->redis->spop($name);
	}


	//有序集合

	public function zadd($key,$score,$valye){
		return $this->redis->zadd($key,$score,$valye);
	}

	public function zrange($key,$start,$num){
		return $this->redis->zrange ($key,$start,$num);
	}

	public function zrank($key,$value){
		return $this->redis->zrange ($key,$value);
	}

	public function zrevrank($$key,$value){
		return $this->redis->zrange ($$key,$value);
	}

	//hash
	public function hset($key,$filed,$value){
		return $this->redis->hset($key,$filed,$value);
	}

	public function hget($key,$filed){
		return $this->redis->hget($key,$filed);
	}

	public function hlen($key){
		return $this->redis->hlen($key);
	}

	public function hkeys($key){
		return $this->redis->hkeys($key);
	}

	public function hvals($key){
		return $this->redis->hvals($key);
	}

	public function hgetall($key){
		return $this->redis->hgetall($key);
	}

	public function hmset($key,$arr){
		return $this->redis->hget($key,$arr);
	}

	public function hmget($key,$arr){
		return $this->redis->hget($key,$arr);
	}

	//发布订阅

	public function publish($name,$value){
		return $this->redis->publish($name,$value);
	}

	public function subscribe($name,$callback){
		return $this->redis->subscribe(array($name), $callback);
	}

	





















}