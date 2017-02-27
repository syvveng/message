<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/21
 * Time: 22:13
 */

//防止恶意调用
if(!defined("IN_TG")){
    exit("Access Defined!");
}

header("Content-Type:text/html;charset=utf-8");
//拒绝低版本
if(PHP_VERSION < '4.1.0'){
    exit("Version is too low!");
}

//定义硬路径为一个常量，引入速度更快
define("ROOT_PATH",substr(dirname(__FILE__),0,-8));

require ROOT_PATH."includes/global.func.php";

//定义开始时间为常量
define("START_TIME",_runtime());
?>