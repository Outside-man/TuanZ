<?php
/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/18
 * Time: 14:37
 */
namespace core;
class tuanz{
    //记录加载过的类库
    public static $classMap = array();

    public static function run(){
        //加载路由 解析路径及参数
        $route = new \core\lib\route();
        $ctrl = $route->ctrl;
        $action = $route->action;
        $controller_path = CONTROLLER.$ctrl.'Controller.php';
        $ctrlClass = '\\'.$ctrl.'Controller';
        //跳转至控制器
        if(is_file($controller_path)){
            include $controller_path;
            $controller = new $ctrlClass();
            $controller->$action();
        } else {
            throw new \Exception("找不到控制器".$ctrl.'Controller');
        }
    }
    public static function load($class){
        //自动加载类库
        if(isset($classMap[$class])) {
            return true;
        }else{
            $class = str_replace('\\', '/', $class);
            $fileName = TuanZ . $class . '.php';
            if (is_file($fileName)) {
                include $fileName;
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }
    //获取配置信息
    public static function getConfig($configfile){
        $reader = new \XMLReader();
        $reader->open(CONFIG.$configfile,'utf-8');
        $mysql = array();
        while ($reader->read()) {
            if ($reader->nodeType == \XMLReader::ELEMENT) {
                $nodename = $reader->name;
            }
            if ($reader->nodeType == \XMLReader::TEXT) {
                $mysql[$nodename] = $reader->value;
            }
        }
        $reader->close();
        return $mysql;
    }

}