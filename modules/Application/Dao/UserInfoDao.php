<?php

namespace Application\Dao;

use Plume\Core\Dao;

class UserInfoDao extends Dao{

    public function __construct($app) {
        parent::__construct($app, 'user_info', 'id');
    }

    public function info(){
        $sql = "SELECT * FROM user_info where id=? and username=?";
        $param = array("id0","光头强");
        return $this->queryBySql($sql,$param);
    }
}