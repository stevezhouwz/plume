<?php
/**
 * Created by PhpStorm.
 * User: zeyu
 * Date: 2019/3/1
 * Time: 16:30
 */

namespace Ugs\Service;


class IndexService extends BaseService
{
    public function __construct($app) {
        parent::__construct($app, "job_basic_info");
    }

    public function getuser(){
        $sql = "select * from user_info";
        return $this->queryBySql($sql);
    }
}