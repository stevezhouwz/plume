<?php
/*
 * * 首页
 * author:liubb
 * time:2019/4/22
 * */
namespace Ugs\Controller;
use Plume\Core\Controller;
use Plume\Util\HttpUtils;
use Ugs\Service\IndexService;

class IndexController extends Controller
{
    public function __construct($app){
        parent::__construct($app, new IndexService($app));
    }
	
    public function indexAction(){
        $res = $this->service->getUser();
        $user = isset($res[0])?$res[0]:"";
        return $this->result(array('user'=>$user))->response();
    }
}