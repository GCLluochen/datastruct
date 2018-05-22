<?php
$rootPath = dirname(__DIR__);

/*function autoload_register($class)
{
    $class = str_replace('Datastruct\\', '', $class);//去除命名空间名称
    //$class = str_replace('\\', '', $class);//去除命名空间中的斜杠
    //$nameArr = explode('\\', $class);
    //echo __DIR__ . DIRECTORY_SEPARATOR . $class . '.php' . "\n";die;
    include __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
}

spl_autoload_register("autoload_register");*/
//引入 composer 自动加载 autoload文件
require_once($rootPath . "/datastruct/vendor/autoload.php");