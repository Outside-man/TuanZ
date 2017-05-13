<?php
/**
 * Created by PhpStorm.
 * User: tuanzi
 * Date: 2017/5/12
 * Time: 下午5:20
 */

class fileController extends \core\lib\BaseController {
    public function upload(){
        $fname=$_FILES['file']['name'];
        $tagArrr = explode('.',$fname);
        $fileext = array_pop($tagArrr);

        $fileService = new \app\php\service\FileService();
        if($fileService->uploadFile($_FILES['file']['tmp_name'], 'test/', $_FILES['file']['name'])){
            $this->ajaxReturn($_FILES,'aaa',0);
        }
        return ;
    }
    public function download(){
        if(!isset($_POST['path'])||!isset($_POST['file'])){
            echo "shit";
            return ;
        }
        $path=FILE."test/".$_POST['path'];
        $filename = $_POST['file'];
        //新文件名，就是下载后的名字
        //判断给定的文件存在与否
        if(!file_exists($path)){
            die("您要下载的文件已不存在，可能是被删除");
        }
        $fp = fopen($path,"r");
        $file_size = filesize($path);

        //下载文件需要用到的头
        header("Content-type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length:".$file_size);
        header("Content-Disposition: attachment; filename=".$filename);
        $buffer = 1024;
        $file_count = 0;
        //向浏览器返回数据
        while(!feof($fp) && $file_count < $file_size){
            $file_con = fread($fp,$buffer);
            $file_count += $buffer;
            echo $file_con;
        }
        fclose($fp);

    }


}