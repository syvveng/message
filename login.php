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
define("SCRIPT","login");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";
if(_get("action") == 'login'){
    $_username = $_POST['username'];
    $_password = $_POST['password'];
    $result = $mysqli->query("SELECT * FROM m_user WHERE m_username='$_username'");
    $_user = $result->fetch_array(MYSQLI_ASSOC);
//    print_r($_user);
    if($_user['m_username'] == $_username){
            if($_user['m_password'] == sha1($_password)){
                $mysqli->close();
                _location('恭喜您，登录成功！','index.php');
            }else{
                $mysqli->close();
                _location('密码错误，请重新填写！','login.php');
            }
        }else{
            $mysqli->close();
            _location('用户不存在，请注册！','register.php');
        }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>用户登录</title>
    <?php require ROOT_PATH."includes/title.inc.php";  ?>
    <script type="text/javascript" src="js/login.js" ></script>
</head>
<body>
<?php require ROOT_PATH."includes/header.inc.php"; ?>
    <div id="login">
        <form method="post" name="login" action="login.php?action=login">
            <h2>用户登录</h2>
            <div id="main">
                <div id="log">
                    <label for="username">用户名:</label>
                    <input type="text" name="username">
                </div>
                <div id="log">
                    <label for="username">密码:</label>
                    <input type="password" name="password">
                </div>
                <div id="log">
                    <label for="code">验证码:</label>
                    <input type="text" name="code" class="code">
                    <img src="code.php" id="code" />
                </div>
            </div>
            <div id="sub">
                <input type="submit" name="submit" value="登录" class="pointer">
                <input type="reset" name="reset" value="重置" class="pointer">
            </div>
        </form>
    </div>
<?php require ROOT_PATH."includes/footer.inc.php"; ?>
</body>
</html>