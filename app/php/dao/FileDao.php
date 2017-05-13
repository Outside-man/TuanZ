<?php
/**
 * Created by PhpStorm.
 * User: tuanzi
 * Date: 2017/5/13
 * Time: 下午10:39
 */

namespace app\php\dao;


class FileDao extends \core\lib\BaseDao {
    public function selectAllByFolder($folder){
        return $this->select_all_by_one_condition("b_file", "folder", $folder);
    }
    public function insert($pre_name, $after_name, $folder){
        $sql = \DataBase::getConn()->prepare('insert into b_file (pre_name, after_name, folder) values (:pre_name, :after_name, :folder)');
        return $sql->execute(array(
            ':pre_name' => $pre_name,
            ':after_name' => $after_name,
            ':folder' => $folder
        ));
    }
}