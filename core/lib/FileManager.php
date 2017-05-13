<?php
/**
 * Created by PhpStorm.
 * User: tuanzi
 * Date: 2017/5/11
 * Time: 上午10:59
 */

namespace core\lib;


class FileManager{

    public function upload($tmp_file, $target_path, $file_name){
        if(is_file($tmp_file)){
            if(!is_dir($target_path)){
                if(!mkdir($target_path))return false;
            }
            return move_uploaded_file($tmp_file, $target_path.$file_name);
        }else{
            return false;
        }
    }

    public function downloadFile($path, $file){
    }



}