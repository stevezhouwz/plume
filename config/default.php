<?php 
return array(
    'redis' => array(
        'host' => '3911_ugsservice_redis_ip',
        'port' => '3911_ugsservice_redis_port',
    ),
    'redis_slave' => array(
        'host' => '3911_ugsservice_redis_ip',
        'port' => '3911_ugsservice_redis_port',
    ),
    'arkapi' => array(
        'domain' => "http://1601_ark_api_domain",        //ark api 域名
        'token_verify' => "/arkapi/api/getcompinfo",  //token verify
    ),
    //积分接口地址
    'growth'=>array(
        'domain'=>'3911_ugsservice_web_domain',
        'get_score_single' => '/action/get_score_single',  //获取积分记录
        'get_score_stat' => '/action/get_score_stat', //手机端积分记录
        'get_score_all' => '/action/get_score_all',  //获取积分记录
        'get_class_list' => "/action/get_action_config", //行为列表
        'get_class_ruler' => "/action/get_rule_class", //行为列表
        'add_class_ruler' => "/action/add_action_rule",
        'update_class_ruler' => "/action/modify_action_rule",
        'get_action_rule_byid' => "/action/get_action_rule_byid", //获取规则
        'get_action_rule' => '/action/get_action_rule', //获取行为配置规则列表
        'change' => '/search/change', //积分明细
    )
);