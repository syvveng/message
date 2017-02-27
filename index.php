<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/21
 * Time: 20:13
 */

//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","index");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>多用户留言系统</title>
    <?php require ROOT_PATH."includes/title.inc.php"; ?>
</head>

<body>
    <?php
        require ROOT_PATH."includes/header.inc.php";
    ?>

    <div id="list">
        <h2>帖子列表</h2>
    </div>
    <div id="vip">
        <h2>新进会员</h2>
    </div>
    <div id="pics">
        <h2>最新图片</h2>
    </div>

    <?php
        require ROOT_PATH."includes/footer.inc.php";
    ?>
</body>

</html>
