<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/3/9
 * Time: 7:30
 */
//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","member");
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
    <div id="member">
        <?php require ROOT_PATH."includes/member.inc.php"; ?>

        <div class="member_main">
            <h2>会员管理中心</h2>

        </div>
    </div>

    <?php
        require ROOT_PATH."includes/footer.inc.php";
    ?>
</body>
</html>