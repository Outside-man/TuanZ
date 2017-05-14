<?php
/**
 * Created by PhpStorm.
 * User: tuanzi
 * Date: 2017/5/11
 * Time: 上午10:59
 */

namespace core\lib;


class FileManager{

    public function upload_file($tmp_file, $target_path, $file_name){
        if(is_file($tmp_file)){
            if(!is_dir($target_path)){
                if(mkdir($target_path, 0777)) chmod($target_path, 0777);
                else return false;
            }
            move_uploaded_file($tmp_file, $target_path.$file_name);
            //设置上传的文件的文件权限
            chmod($target_path.$file_name, 0777);
            return true;
        }else{
            return false;
        }
    }

    public function download_file($file_path, $save_name){
        //$save_name 新文件名，下载后的名字
        //判断给定的文件存在与否
        if(!file_exists($file_path)){
            die("您要下载的文件已不存在，可能是被删除");
        }
        $fp = fopen($file_path,"r");
        $file_size = filesize($file_path);
        //下载文件需要用到的头
        header("Content-type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length:".$file_size);
        header("Content-Disposition: attachment; filename=".$save_name);
        //缓存区大小
        $buffer = 1024;
        $file_count = 0;
        //向浏览器返回数据
        $str = "";
        while(!feof($fp) && $file_count < $file_size){
            $file_con = fread($fp,$buffer);
            $file_count += $buffer;
            $str .=$file_con;
        }
        fclose($fp);
        return $str;
    }
    public function delete_file($file_path, $file_name){
        $file = $file_path.$file_name;
        if(is_file($file))
            return unlink($file);
        return false;
    }
    public function list_current_file($path){
        //opendir()返回一个目录句柄,失败返回false
        $current_dir = opendir($path);
        //路径下的文件数组
        $files = array();
        //readdir()返回打开目录句柄中的一个条目
        while(($file = readdir($current_dir)) !== false) {
            //构建子目录路径 $sub_dir = $path . DIRECTORY_SEPARATOR . $file;
            if($file == '.' || $file == '..'||$file == '.DS_Store')
                continue;
            else
                array_push($files, $file);
        }
        return $files;
    }
    public function list_all_file($path){
        //路径下的文件数组
        $files = array();
        function list_files(&$files, $path) {
            //opendir()返回一个目录句柄,失败返回false
            $current_dir = opendir($path);
            //readdir()返回打开目录句柄中的一个条目
            while(($file = readdir($current_dir)) !== false) {
                $sub_dir = $path . DIRECTORY_SEPARATOR . $file;    //构建子目录路径
                if($file == '.' || $file == '..'||$file == '.DS_Store') {
                    continue;
                } else if(is_dir($sub_dir)) {
                    //如果是目录,进行递归
                    $files[$file] = array();
                    list_files($files[$file], $sub_dir);
                } else {
                    array_push($files, $file);
                }
            }
        }
        list_files($files, $path);
        return $files;
    }

}