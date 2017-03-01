<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/26
 * Time: 17:30
 */
//防止恶意调用
if(!defined("IN_TG")){
    exit("Access Defined!");
}
//检查函数_alert_back是否存在
if(!function_exists('_alert_back')){
    exit("_alert_back函数不存在，请检查!");
}
//检查_mysql_string是否存在
if(!function_exists('_mysql_string')){
    exit("_mysql_string函数不存在，请检查!");
}

/**
 * @param $str
 * @return mixed
 * 返回唯一标识符
 */
function _check_uniqid($str1,$str2){
    if((strlen($str1) != 40) || ($str1 != $str2) ){
        _alert_back("唯一标识符错误!");
    }
    return $str1;
}

//检查用户名
/**
 * $str:表示提交的username
 * $mix:用户名最小值
 * $max:用户名最大值
 * trim()去掉头部和尾部的空格
 */
function _check_username($str,$mix=6,$max=18){
    $_str = trim($_POST[$str]);
    //mysql_real_escape_string():转义 SQL 语句中使用的字符串中的特殊字符，并考虑到连接的当前字符集
    return $_str;
}


//密码检测
function _check_password($str,$mix=6,$max=18){
    $_str = $_POST[$str];
    //加密返回
    return sha1($_str);
}

//密码提示
function _check_question($str,$mix=3,$max=18){
    $_str = $_POST[$str];
    return $_str;
}
function _check_answer($str){
    return  $_POST[$str];
}

function _check_sex($str){
    return $_POST[$str];
}

function _check_face($str){
    return $_POST[$str];
}
//邮箱验证
/**
 * @param $str
 * @return mixed
 * ^开始符，$结束符
 * [a-zA-Z0-9_]{1,20}表示@前面为1-20个字母或者数字或者下划线
 * [a-zA-Z0-9_]{1,10}表示@后面为1-10个字母或者数字或者下划线
 * (com|cn|net|com.cn)表示点后面为其中一个
 */
function _check_email($str){
    $_str = $_POST[$str];
    return $_str;
}

//QQ
function _check_qq($str){
    $_str = $_POST[$str];
    return $_str;
}

//个人主页
function _check_url($str){
    $_str = $_POST[$str];
    return $_str;
}


?>