<?php
/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/25
 * Time: 11:09
 */

namespace core\lib;


class BaseDao{
    public function select_all($tablename){
        $sql = \DataBase::getConn()->prepare('select * from '.$tablename);
        $sql->execute();
        $result = $sql->fetchAll();
        return $result;
    }
    public function select_one_by_one_condition($tablename, $condition, $val){
        $sql = \DataBase::getConn()->prepare('select * from '.$tablename.' where '.$condition.' = :val');
        $sql->execute(array(':val'=>$val));
        $result = $sql->fetch();
        return $result;
    }
    public function delete_one_by_one_condition($tableName, $condition, $val){
        try {
            $sql = \DataBase::getConn()->prepare('delete from ' . $tableName . ' where ' . $condition . ' = :val');
            $sql->execute(array(':val' => $val));
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
    public function get_last_insert_id($tableName){
        $sql = \DataBase::getConn()->prepare('select id from '.$tableName.' order by id desc');
        $sql->execute();
        $result = $sql->fetchAll();
        if($result!=null) {
            return $result[0];
        }else{
            return array(0=>0);
        }
    }
    public function select_all_by_one_condition($tableName, $condition, $val){
        $sql = \DataBase::getConn()->prepare('select * from '.$tableName.' where '.$condition.' = :val');
        $sql->execute(array(':val'=>$val));
        $result = $sql->fetchAll();
        return $result;
    }
}