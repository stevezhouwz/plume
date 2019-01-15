<?php

return array(
    //数据库配置信息
	'db' => array(
        'driver' => 'mysql',
        'host' => 'localhost',
        'username'=>'root',
        'password'=>'123456',
        'database'=>'plume',
        'port' => '3306',
        'charset'=>'utf8'
	),
    'redis' => array(
        'host' => '127.0.0.1',
        'port' => '6379'
    ),
    'redis_slave' => array(
        'host' => '127.0.0.1',
        'port' => '6379'
    ),


);