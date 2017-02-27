<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/25
 * Time: 9:56
 */

//会话开始
session_start();

//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","verificationCode");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";

//有四个可选参数为$_width:图像长度,$_height:图像高度,$_num:验证码个数,$_flag:是否设置黑色边框
verification_code();
?>