<?php

/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/23
 * Time: 20:11
 */
namespace app\php\dao;


class UserDao extends \core\lib\BaseDao {
    public function selectAll(){
        return $this->select_all('b_user');
    }
    public function selectByUsername($username){
        return $this->select_one_by_one_condition('b_user', 'username', $username);
    }
    public function insert($username, $password){
        try {
            if(self::selectByUsername($username)==null) {
                $sql = \DataBase::getConn()->prepare('insert into b_user (username, password) values (:username,:password)');
                $sql->execute(array(':username' => $username, ':password' => $password));
            }else{
                throw new \Exception('用户名存在');
            }
        }catch (\Exception $e){
           return false;
        }
        return true;
    }
}