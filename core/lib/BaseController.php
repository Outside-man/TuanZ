<?php
/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/19
 * Time: 14:57
 */

namespace core\lib;


class BaseController{
    public $assign;
    public function assign($name, $value){
        $this->assign[$name] = $value;
    }
    public function display($file){
        $file = VIEW.$file;
        if(is_file($file)){
            if(isset($this->assign))
                extract($this->assign);
            include $file;
        }else{
            out($file.'页面不存在');
        }
    }
    public function getCurrentUser(){
        if(isset($_SESSION['SESSION_CURRENT_USER'])&&!is_null($_SESSION['SESSION_CURRENT_USER'])){
            return $_SESSION['SESSION_CURRENT_USER'];
        }
    }
    public function assinUser(){
        if(isset($_SESSION['SESSION_CURRENT_USER'])&&!is_null($_SESSION['SESSION_CURRENT_USER']))
            self::assign('user',self::getCurrentUser());
    }
    public function clearCurrentUser(){
        session_unset();
        session_destroy();
    }
    public function ajaxReturn($data, $info, $status){
        echo json_encode(array('data'=>$data, 'info'=>$info, 'status'=>$status));
    }
}