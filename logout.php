<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/3/4
 * Time: 10:39
 */

session_start();
//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","logout");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";


setcookie('username','',time()-1);
setcookie('uniqid','',time()-1);
session_destroy();
//_is_logout('您确定要退出吗?','index.php');
_location('退出成功','index.php');
?>