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
//定义常量，用来授权调用includes里面的文件，防止恶意调用
//define("IN_TG",true);

header("Content-Type:text/html;charset=utf-8");
//拒绝低版本
if(PHP_VERSION < '4.1.0'){
    exit("Version is too low!");
}
//创建一个自动转义状态的常量
define("GPC",get_magic_quotes_gpc());


//定义硬路径为一个常量，引入速度更快
define("ROOT_PATH",substr(dirname(__FILE__),0,-8));


require ROOT_PATH."includes/global.func.php";

//定义开始时间为常量
define("START_TIME",_runtime());


define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PWD","");
define("DB_NAME","message");

//创建数据库连接
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PWD,DB_NAME);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
}


if(!$mysqli->set_charset("UTF8")){
    exit("字符集错误!");
}

//echo $mysqli->character_set_name();

if(!empty($_COOKIE['username'])){
    $result = $mysqli->query("SELECT COUNT(m_id) AS count FROM m_message  WHERE m_state=0 AND m_to_user='{$_COOKIE['username']}' ");
    $message = $result->fetch_array(MYSQLI_ASSOC);
    if(empty($message['count'])){
        $_GLOBAL['message'] = '<a href="member_message.php"><strong class="readed">(0)</strong></a>';
    }else{
        $_GLOBAL['message'] = '<a href="member_message.php"><strong class="noread">('.$message['count'].')</strong></a>';
    }
}


?>