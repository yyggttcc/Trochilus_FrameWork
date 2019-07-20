<?php

return [

	'type'            => 'mysql',
    'read' => [
        'hostname' => ['127.0.0.1', '127.0.0.1']
    ],
    'write' => [
        'hostname' => '127.0.0.1'
    ],
    // 服务器地址
    'hostname'        => '127.0.0.1',
    // 数据库名
    'database'        => '300',
    // 用户名
    'username'        => 'root',
    // 密码
    'password'        => 'root',
    // 端口
    'hostport'        => '3306',
    //分布式
    'hadoop'           => false ,
    //记录日志
    'log'           => true,
    //记录explain,true 全部 或者超过阀值
    'explain' =>    'ALL',

];