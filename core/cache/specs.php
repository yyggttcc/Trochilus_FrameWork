<?php
namespace core\cache;
//缓存接口类
interface  specs{

	//写入缓存
	public function write($key,$value,$expire="");

	//读取缓存
	public function read($key);

	//更新缓存
	public function pull($key,$value,$expire="");

	//删除缓存
	public function delete();

	//判断缓存是否存在
	public function has($key);

	//设置缓存有效期
	public function expire($key,$time="00000000000");

	//缓存标识
	public function key();

}