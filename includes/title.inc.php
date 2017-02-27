<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/23
 * Time: 20:19
 */
//防止恶意调用
if(!defined("IN_TG")){
    exit("Access Defined!");
}
//防止非HTML文件调用
if(!defined("SCRIPT")){
    exit("NO HTML!");
}
?>
<link rel="shotcut icon" href="images/1.ico">
<link rel="stylesheet" type="text/css" href="styles/basic.css">
<link rel="stylesheet" type="text/css" href="styles/<?php echo SCRIPT; ?>.css">