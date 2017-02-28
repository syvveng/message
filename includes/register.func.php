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

    if(strlen($_str)<$mix || strlen($_str)>$max){

        _alert_back('用户名长度必须在'.$mix.'-'.$max.'之间');
    }

    //限制敏感字符
    $_char_pattern = '/[<>\'\"\ \     ]/';
    if(preg_match($_char_pattern,$_str)){
        _alert_back("用户名不能包含以下敏感字符!");
    }

    //限制敏感用户名
    //弹框中要换行需用\n,但是\n不能用双引号("")，只能用单引号'';
    $_num[0] = "weng";
    $_num[1] = "张三风";
    $val = null;
    foreach($_num as $value){
       $val .=$value;
    }
    //in_array — 检查数组中是否存在某个值
    if(in_array($_str,$_num)){
       _alert_back("不能使用以下敏感用户名:".'\n'.$val);
    }

    //mysql_real_escape_string():转义 SQL 语句中使用的字符串中的特殊字符，并考虑到连接的当前字符集
    return $_str;
}


//密码检测
function _check_password($_first_pass,$_comfirm_pass,$mix=6,$max=18){
    $_str1 = $_POST[$_first_pass];
    $_str2 = $_POST[$_comfirm_pass];

    if(strlen($_str1)<$mix || strlen($_str1)>$max){
        _alert_back("密码长度必须在".$mix."-".$max."之间!");
    }

    if($_str1 != $_str2){
        _alert_back("密码确认错误!");
    }
    //加密返回
    return sha1($_str1);
}

//密码提示
function _check_question($str,$mix=4,$max=18){
    $_str = $_POST[$str];

    //strlen：单个中文和单个英文字母的长度不一样;mb_strlen：单个中文和单个英文字母的长度一样
   if(mb_strlen($_str,'utf-8')<$mix || mb_strlen($_str,'utf-8')>$max){
        _alert_back("密码提示长度必须在".$mix."-".$max."之间!");
    }
    return $_str;
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
    if(!empty($_str)) {
        $_arr = '/^[a-zA-Z0-9_]{1,20}@[a-zA-Z0-9_]{1,10}(\.)(com|cn|net|com.cn)$/';
        if (!preg_match($_arr, $_str)) {
            _alert_back('邮箱地址格式错误!');
        }
    }
    return $_str;
}

//QQ验证
function _check_qq($str){
    $_str = $_POST[$str];
    if(!empty($_str)){
        $_arr = '/^[1-9]{1,}[0-9]$/';
        if(!preg_match($_arr,$_str)){
            _alert_back("QQ输入错误，第一位不能为0!");
        }
    }

    return $_str;
}

//个人主页验证
function _check_url($str){
    $_str = $_POST[$str];
    if(empty($_str) || $_str == 'http://'){
        $_str = null;
    }else{
        $_arr = '/^https?:\/\/[a-zA-Z0-9_]{0,}(\.){0,}[a-zA-Z0-9_]{1,}(\.)[a-zA-Z0-9_]{1,}(\.){0,}[a-zA-Z0-9_]{0,}$/';
        if(!preg_match($_arr,$_str)){
            _alert_back("主页地址格式错误!");
        }
    }

    return $_str;
}


?>