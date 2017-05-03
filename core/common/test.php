<?php
/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/18
 * Time: 14:08
 * 测试函数库
 */
function out ($var){
    if(is_bool($var)){
        var_dump($var);
    } else if (is_null($var)){
        var_dump(NULL);
    } else {
      echo"<pre style='position:relative;z-index=1000;padding:10px;
        border-radius:5px;background:#f5f5f5;border:1px; solid #aaa;
        font-size:14px;line-height:18px;opacity:0.9;'>".print_r($var,true) ."</pre>";
    }
}
function debug (){
    echo"<pre style='position:relative;z-index=1000;padding:10px;
        border-radius:5px;background:#ff0707;border:1px; solid #aaa;
        font-size:14px;line-height:18px;opacity:0.9;'>".print_r('Debug',true) ."</pre>";
}