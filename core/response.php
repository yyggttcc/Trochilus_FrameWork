<?php

namespace core\request;

class  response{


	//下载文件
	public function down($file){

		header("Content-Disposition:attachment;filename='".$file."'");

	}
	
}