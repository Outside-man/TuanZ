<?php
/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/18
 * Time: 14:48
 */
namespace core\lib;
class route{
    public $ctrl;
    public $action;
    function __construct(){
        if(isset($_SERVER['REQUEST_URI'])&&$_SERVER['REQUEST_URI']!='/'){
            $path = $_SERVER['REQUEST_URI'];
            $patharr = explode('/',trim($path,'/'));
            if(isset($patharr[0])){
                $this->ctrl = $patharr[0];
                unset($patharr[0]);
            }
            if(isset($patharr[1])){
                $this->action = $patharr[1];
                unset($patharr[1]);
            }else{
                $this->action = 'index';
            }
            $count = count($patharr)+2;
            $i = 2;
            while($i<$count){
                if(isset($patharr[$i+1]))
                $_GET[$patharr[$i]] = $patharr[$i+1];
                $i+=2;
            }
        } else {
            $this->ctrl = 'index';
            $this->action = 'index';
        }
    }
}