<?php
/**
 * Created by PhpStorm.
 * User: TuanZ
 * Date: 2017/4/19
 * Time: 15:38
 */
class DataBase extends \PDO {
    public function __construct(){
        //获取config里的DataSourceConfig.xml中的配置
        $mysql = core\tuanz::getConfig('DataSourceConfig.xml');
        $dsn = 'mysql:host='.$mysql['host'].';dbname='.$mysql['dbname'];
        $username = $mysql['username'];
        if(isset($mysql['password']))
            $passwd = $mysql['password'];
        else
            $passwd = '';
        parent::__construct($dsn, $username, $passwd);

    }
    public static function getConn(){
        return new self();
    }
}