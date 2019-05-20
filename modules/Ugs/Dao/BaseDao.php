<?php
namespace Ugs\Dao;
/**
 * 扩展Dao
 */
use Plume\Core\Dao;
class BaseDao extends Dao
{
    public function __construct($app, $tableName){
        parent::__construct($app, $tableName);
    }
    /**
     * 通过表名插入
     * @param array $insertArr
     * @return int
     */
    public function insertByTable($tablename, $insertArr){
       return $this->_insertByTable($tablename, $insertArr);
    }

    /**
     * 批量插入
     * @param $tablename
     * @param $insertArrs
     * @return mixed
     */
    public function insertMultiByTable($tablename, $insertArrs){
       return $this->_insertMultiByTable($tablename, $insertArrs) ;
    }
    /**
     * 通过表名更新
     * @param string $tablename
     * @param array $set
     * @param array $where
     * @return int
     */
    public function updateByTable($tablename, $set, $where){
        return $this->_updateByTable($tablename, $set, $where);
    }
    /**
     * 通过表名删除
     * @param string $tablename
     * @param array $where
     * @return int
     */
    public function deleteByTable($tablename, $where){
        return $this->_deleteByTable($tablename, $where);
    }

    /**
     * 通过表名查询
     * @param $tablename
     * @param $where
     * @param array $order
     * @param int $skipNum
     * @param int $fetchNum
     * @return array|\MysqliDb
     */
    public function fetchByTable($tablename, $where, $order = array(), $skipNum=0, $fetchNum=-1){
        return  $this->_fetchByTable($tablename, $where, $order, $skipNum, $fetchNum);
    }

    /**
     * 查询总条数
     * @param $tablename
     * @param $where
     * @param array $order
     * @return mixed
     */
    public function fetchCountByTable($tablename, $where, $order = array()){
        return $this->_fetchCount($tablename, $where, $order);
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
        return $this->_like($tablename,  $likes, $orders, $offset, $count);
    }

    /**
     * 模糊查询总条数
     * @param $tablename
     * @param array $likes
     * @param array $orders
     * @return mixed
     */
    public function likeCountByTable($tablename,  $likes = array(), $orders = array()){
        return $this->_likeCount($tablename, $likes, $orders);
    }
    /**
     * 私有化
     */
    private  function _insertByTable($tablename, $insertArr){  
        $this->_cacheClear($tablename);
        if(empty($insertArr)){
            return false;
        }
        $obj = $this->getDB();
        return $obj->insert($tablename, $insertArr);
    }
    /**
     * @param $tablename
     * @param $insertArrs
     * @return array|bool
     */
    private function _insertMultiByTable($tablename, $insertArrs){
        $obj = $this->getDB();
        return $obj->insertMulti($tablename, $insertArrs);
    }
    /**
     * 私有化
     * @param $tablename
     * @param $set
     * @param $where
     * @return bool
     */
    private function _updateByTable($tablename, $set, $where){
        $this->_cacheClear($tablename);
        if(empty($where)){
            return false;
        }
        $obj = $this->getDB();
        foreach ($where as $key => $value){
            $obj->where($key, $value);
        }
        return $obj->update($tablename, $set);
    }

    /**
     * 私有化
     * @param $tablename
     * @param $where
     * @return bool
     */
    private function _deleteByTable($tablename, $where){
        $this->_cacheClear($tablename);
        if(empty($where)){
            return false;
        }
        $obj = $this->getDB();
        foreach ($where as $key => $value) {
            $obj->where($key, $value);
        }
        return $obj->delete($tablename);
    }

    /**
     * 私有化
     * @param $tablename
     * @param $where
     * @param array $order
     * @param int $skipNum
     * @param int $fetchNum
     * @return array|\MysqliDb
     */
    private function _fetchByTable($tablename, $where, $order = array(), $skipNum=0, $fetchNum=-1){
        $obj = $this->getDB();
        if(empty($where)){
            return array();
        }
        foreach ($where as $key => $value){
            $obj->where($key, $value);
        }
        if(empty($order) == false){
            foreach ($order as $key => $value){
                $obj->orderBy($key, $value);
            }
        }
        $limits = array();
        if($fetchNum >0){
            if($skipNum>=0){
                array_push($limits, $skipNum);
            }
            array_push($limits, $fetchNum);
        }
        if(empty($limits)){
            return $obj->get($tablename);
        }
        return $obj->get($tablename, $limits);
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
    public function _like($tablename,  $likes = array(), $orders = array(), $offset = 0, $count = -1){
        $obj = $this->getDB();
        //条件
        if(!empty($likes)){
            foreach ($likes as $key => $value){
                if(is_array($value)){
                    foreach ($value as $k => $v){
                        $obj->where($key, $v, $k);
                    }
                }else{
                    $obj->where($key, $value);
                }
            }
        }
        //排序
        if(!empty($orders)){
            foreach ($orders as $key => $value){
                $obj->orderBy($key, $value);
            }
        }
        //查询限制
        $limits = array();
        if($count > 0 && $offset >= 0){
            $limits = array($offset, $count);
        }
        //
        if(empty($limits)){
            return $obj->get($tablename);
        }
        return $obj->get($tablename, $limits);
    }

    /**
     * 模糊查询总条数
     * @param $tablename
     * @param array $likes
     * @param array $orders
     * @return mixed
     */
    public function _likeCount($tablename,  $likes = array(), $orders = array()){
        $obj = $this->getDB();
        //条件
        if(!empty($likes)){
            foreach ($likes as $key => $value){
                if(is_array($value)){
                    foreach ($value as $k => $v){
                        $obj->where($key, $v, $k);
                    }
                }else{
                    $obj->where($key, $value);
                }
            }
        }
        //排序
        if(!empty($orders)){
            foreach ($orders as $key => $value){
                $obj->orderBy($key, $value);
            }
        }
        return $obj->getValue ($tablename, 'count(*)');
    }
    /**
     * 查询总条数
     * @param $tablename
     * @param array $wheres
     * @param array $orders
     * @return mixed
     */
    public function _fetchCount($tablename,  $wheres = array(), $orders = array()){
        $obj = $this->getDB();
        //条件
        if(!empty($wheres)){
            foreach ($wheres as $key => $value){
                $obj->where($key, $value);
            }
        }
        //排序
        if(!empty($orders)){
            foreach ($orders as $key => $value){
                $obj->orderBy($key, $value);
            }
        }
        return $obj->getValue ($tablename, 'count(*)');
    }
    /**
     * 清除缓存
     * @param $tablename
     */
    private function _cacheClear($tablename){
        $this->provider('cache')->cacheClear('db', $tablename);
    }
}

?>