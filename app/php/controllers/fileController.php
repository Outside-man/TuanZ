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
            $this->ajaxReturn($_FILES,'上传成功',0);
        }
    }
    public function download(){
        $fileService = new \app\php\service\FileService();
        echo $fileService->downloadFile($_POST['id']);
    }
    public function delete(){
        $fileService = new \app\php\service\FileService();
        if($fileService->deleteFile($_POST['id'])){
            $this->ajaxReturn(null, '删除成功', 0);
            return ;
        }else{
            die("文件不存在或已删除");
        }
    }
    public function listFile(){
        $fileService = new \app\php\service\FileService();
        out($fileService->listCurrentFile('test/'));
    }

}