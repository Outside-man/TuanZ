<?php
/**
 * Created by PhpStorm.
 * User: tuanzi
 * Date: 2017/5/13
 * Time: 下午6:09
 */

namespace app\php\service;

class FileService{
    static $fileManage = null;
    static $fileDao = null;
    public function __construct(){
        self::$fileManage = new \core\lib\FileManager();
        self::$fileDao = new \app\php\dao\FileDao();
    }
    public function uploadFile($tmp_file, $target_path, $file_name){
        if(self::$fileDao->insert($file_name, time().mt_rand(),$target_path)&&self::$fileManage->upload($tmp_file, FILE.$target_path, $file_name))return true;
        else return false;
    }
    public function downloadFile($path, $filename){
    }

}