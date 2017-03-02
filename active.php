<?php
/**
 * Version message0.1
 * ============================
 * Author: Weng
 * Date: 2017/2/21
 * Time: 15:14
 */

//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","active");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";

//模拟会员激活
if(!$_GET['active']){
    _alert_back("非法操作!");
}
if(isset($_GET['action']) && isset($_GET['active']) && $_GET['action'] == 'OK'){
    $_active = $_GET['active'];
    $mysqli->query("UPDATE m_user SET m_active=NULL WHERE m_active='$_active' LIMIT 1");
    if($mysqli->affected_rows == 1){
        $mysqli->close();
        _location("激活成功!","index.php");
    }else{
        $mysqli->close();
        _location("激活失败!","register.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>会员激活</title>
    <?php require ROOT_PATH."includes/title.inc.php";  ?>

</head>
<body>
<?php require ROOT_PATH."includes/header.inc.php"; ?>

    <div id="active">
        <h2>会员激活</h2>
        <p>点击以下超链接，激活账户:</p>
        <p>
            <a href="active.php?action=OK&amp;active=<?php echo $_GET['active']; ?>">active.php?action=OK&amp;active=<?php echo $_GET['active'];?></a>
        </p>
    </div>

<?php require ROOT_PATH."includes/footer.inc.php"; ?>
</body>
</html>