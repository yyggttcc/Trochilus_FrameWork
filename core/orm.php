<?php

namespace core;
use core\db;

class  orm{

    public $arr = array('select'=>'','from'=>'','where'=>'');
    public $getsql = false;

    public function from($from){

        $this->arr['from'] = " from ". $from[0];

        return $this;
    }

    public function where($where=[]){
        $this->arr['where'] = " where ".implode(" ",$where);
        return $this;

    }
    public  function select($field = "*"){
        $this->arr['select']  = "select ".$field;
        return $this;
    }

    public static function __callStatic($name, $arguments){

        if($name == 'table'){
            $class = new self;
            $class->from($arguments);
            return $class;
        }

    }

    public function getsql(){

        $this->getsql = true;
        return $this;
    }

    public function __destruct(){

        if(empty($this->arr['from'])){

            trigger_error('请输入正确的表名');

        }

        $sql =  implode("",$this->arr);

        if($this->getsql == true){
            echo $sql;exit;
        }else{
            db::query($sql);
        }

    }



}





