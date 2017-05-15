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
        $afterName = time().mt_rand();
        if(self::$fileDao->insert($file_name, $afterName,$target_path)&&self::$fileManage->upload_file($tmp_file, FILE.$target_path, $afterName))return true;
        else return false;
    }
    public function downloadFile($id){
        $file = self::$fileDao->selectById($id);
        return self::$fileManage->download_file(FILE.$file['folder'].$file['after_name'], $file['pre_name']);
    }
    public function deleteFile($id){
        $file = self::$fileDao->selectById($id);
        self::$fileDao->deleteById($id);
        return self::$fileManage->delete_file(FILE.$file['folder'], $file['after_name']);
    }
    public function listCurrentFile($path){
        $f = self::$fileManage->list_current_file(FILE.$path);
        $files = array();
        forEach($f as $key){
            $k = self::$fileDao->selectByAfterNameByFolder($key, $path);
            if($k!=null) {
                array_push($files, $k);
            }
        }
        return $files;
    }
    public function listAllFile($path){
        return self::$fileManage->list_all_file($path);
    }

}