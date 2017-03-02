<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/21
 * Time: 22:14
 */
//防止恶意调用
if(!defined("IN_TG")){
    exit("Access Defined!");
}
?>

<div id="header">
    <h1><a href="index.php">header</a></h1>
    <ul>
        <li><a href="index.php">首页</a></li>
        <li><a href="register.php">注册</a></li>
        <li><a href="login.php">登录</a></li>
        <li>个人中心</li>
        <li>风格</li>
        <li>管理</li>
        <li>退出</li>
    </ul>
</div>

