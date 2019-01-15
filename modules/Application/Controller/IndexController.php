<?php

namespace Application\Controller;

use Application\Service\UserInfoService;
use Plume\Core\Controller;
use Plume\Core\Service;
use Plume\Core\Dao;
use Application\Dao\UserInfoDao;

class IndexController extends Controller{

    public function __construct($app) {
        //使用自定义Service
        // parent::__construct($app, new UserInfoService($app));
        //使用默认Service和自定义DAO
        parent::__construct($app, new Service($app, new UserInfoDao($app)));
        //使用默认Service和默认DAO
        // parent::__construct($app, new Service($app, new Dao($app, 'user_info')));
    }


	public function indexAction() {
       
      return;
	}

    protected function setCookie($key, $value, $outTime, $domain = '/'){
        if ($key){
            setcookie($key, base64_encode($value), time() + $outTime, $domain);
            return true;
        }else{
            return false;
        }
    }
    protected function getCookie($key){
        if (isset($_COOKIE[$key])){
            $value = base64_decode($_COOKIE[$key]);
            return $value;
        }else{
            return false;
        }
    }
}