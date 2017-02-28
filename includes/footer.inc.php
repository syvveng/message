<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/21
 * Time: 22:14
 */
if(!defined("IN_TG")){
    exit("Access Defined!");
}
$mysqli->close();
?>
<div id="footer">
    <p>本程序加载时间为:<?php echo round((_runtime()-START_TIME),4);  ?>秒</p>
    <p>版权所有 翻版必究</p>
    <p>本程序由<span>WENG</span>所有 Copyright©[2017.2] by weng</p>
</div>
