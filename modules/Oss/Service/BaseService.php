<?php
namespace Ugs\Service;

use Plume\Core\Service;
use Ugs\Dao\BaseDao;
class BaseService extends Service
{
    public function __construct($app, $tablename, $dao = null){
        parent::__construct($app, $dao? $dao : new BaseDao($app, $tablename));
    }
    /**
     * 获取4或6位验证码
     * @param bool $default false:4, true:6  
     * @return string 
     */
    public function captcha($default = false){
        $chars = array ("0","1","2","3","4","5","6","7","8","9");
        shuffle ( $chars );
        $max = count($chars) - 1;
        $l = $default ? 6 : 4;
        $rand = "";
        for ($i=0; $i<$l; $i++){
            $rand .= $chars[mt_rand(0, $max)];
        }
        return $rand;
    }    
    /**
     * 通过表名插入
     * @param array $insertArr
     */
    public function insertByTable($tablename, $insertArr){
        return $this->dao->insertByTable($tablename, $insertArr);
    }
    /**
     * 批量插入
     * @param $tablename
     * @param $insertArrs
     * @return mixed
     */
    public function insertMultiByTable($tablename, $insertArrs){
        return $this->dao->insertMultiByTable($tablename, $insertArrs) ;
    }
    /**
     *
     * @param string $tablename
     * @param array $set
     * @param array $where
     */
    public function updateByTable($tablename, $set, $where){
        return $this->dao->updateByTable($tablename, $set, $where);
    }
    /**
     * 通过表名删除
     * @param string $tablename
     * @param array $where
     */
    public function deleteByTable($tablename, $where){
        return $this->dao->deleteByTable($tablename, $where);
    }
    /**
     * 通过表名查询
     * @$tablename string
     * @$where  array
     */
    public function fetchByTable($tablename, $where, $order = array(), $skipNum=0, $fetchNum=-1){
        return $this->dao->fetchByTable($tablename, $where,$order , $skipNum, $fetchNum);
    }
    /**
     * 查询总条数
     * @param $tablename
     * @param $where
     * @param array $order
     * @return mixed
     */
    public function fetchCountByTable($tablename, $where, $order = array()){
        return $this->dao->fetchCountByTable($tablename, $where, $order);
    }
    /**
     * 模糊查询
     * @param $tablename
     * @param array $likes
     * @param array $orders
     * @param int $offset
     * @param int $count
     * @return mixed
     */
    public function likeByTable($tablename,  $likes = array(), $orders = array(), $offset = 0, $count = -1){
        return $this->dao->likeByTable($tablename,  $likes, $orders, $offset, $count);
    }

    /**
     * 模糊查询总条数
     * @param $tablename
     * @param array $likes
     * @param array $orders
     * @return mixed
     */
    public function likeCountByTable($tablename,  $likes = array(), $orders = array()){
        return $this->dao->likeCountByTable($tablename, $likes, $orders);
    }
    /**
     * 组装in信息
     * @param  array params
     * @return string
     */
    protected  function params_in($params){
        $in = "";
        foreach ($params as $param){
            if($param){
                $in .= " '{$param}', ";
            }            
        }
        if($in){
            $last = strrpos($in, ',');
            $in = substr($in, 0, $last);
            $in = "(".$in.")";
        }
        return $in;
    }
    /**
     * 组装and信息
     * @param  array params
     * @return string
     */
    protected function params_add($params){
       $and = " "; 
       foreach ($params as $param){
           if($param){
               $and .= " {$param}  and  ";
           }           
       }
       if($and){
           $last = strrpos($and, 'and');
           $and = substr($and, 0, $last);
       }
       return $and;
    }
    /**
     * 将一个数组添加到另一个数组
     * @param array   $resutlArr    结果数组集
     * @param array   $paramArr     参数数组
     * @return array
     */
    protected function addArr($resutlArr, $paramArr){
        foreach ($paramArr as $p){
            $resutlArr[] = $p;
        }
        return $resutlArr;
    }
}

?>