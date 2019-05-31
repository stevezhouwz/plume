<?php 
return array(
    //数据库配置信息
    'db' => array(
        'driver' => 'mysql',
        'host' => '120.24.187.47',
        'username'=>'root',
        'password'=>'29OiEWly6zI1ZXBcUVk3',
        'database'=>'growth_db',
        'port' => '21011',
        'charset'=>'utf8'
    ),
    'redis' => array(
        'host' => '120.76.112.135',
        'port' => '56379',
        'database' => 2
    ),
	'redis_slave' => array(
        'host' => '120.76.112.135',
        'port' => '56379',
        'database' => 2
	),
    'ark'=>array(
        'domain'=>'http://www.funzhou.cn',//开发(服务方舟域名)
        'reg_path' => "/application/register/register",//企业注册
        'getcompinfo_path' => "/application/login/getCompinfo",//获取企业信息
        'compreg_path' => "/application/compregist/compregister",//企业注册
        'validatemobile_path'=>"/application/register/validateMobile",//验证手机号
        'validateemail_path'=>"/application/register/validateemail",//验证邮箱
        'compUpdate' => "/application/compregist/compperfect", //更新企业信息
        'compAddUser' => "/application/register/addcompuser", //企业使用人员注册接口
    ),
    'arkapi' => array(
        'domain' => "http://api.funzhou.cn",        //ark api 域名
        'token_verify' => "/arkapi/api/getcompinfo",  //token verify
        'bindcompuser' => '/arkapi/api/bindcompuser', //绑定企业
        'unbindcompuser' => '/arkapi/api/unbindcompuser' //解绑企业
    ),
    'usercenter'=>array(
        'domain'=>'https://connect.funzhou.cn',//开发(用户中心)
        'getuserinfo_path' => "/user/get_user_info",//获取用户信息
        'getuserinfo_path_login' => "/user/login",
        'setUserInfo_path' => "/user/set_user_info", //设置用户信息
        'reset_password' => "/manage/reset_password" //修改密码
    ),
    //积分接口地址
    'growth'=>array(
        'domain'=>'http://120.76.112.135:59080',
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