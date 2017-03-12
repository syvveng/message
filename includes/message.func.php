<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/3/11
 * Time: 15:43
 */
//防止恶意调用
if(!defined("IN_TG")){
    exit("Access Defined!");
}
//检查函数_alert_back是否存在
if(!function_exists('_alert_back')){
    exit("_alert_back函数不存在，请检查!");
}

function _check_content($str){
    if(mb_strlen($str,'utf-8') < 3 || mb_strlen($str,'utf8') > 500){
        _alert_back("信息内容长度错误!");
    }else{
        return $str;
    }
}
?>