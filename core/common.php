<?php
if(!function_exists("alert")){
	function alert(){
		echo 'assssssssssssssssssssss';
	}
}

if(!function_exists("dd")){
	function dd($data){
		echo "<br/>______________________________<br/><br/>";
		print_r($data);
		echo "<br/>";
		echo "______________________________<br/>";
		exit;
	}
}
