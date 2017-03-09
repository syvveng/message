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

//登录状态不能进入登录页面
if(empty($_COOKIE['username'])){
    _alert_back("游客状态无法本操作!");
}
$_username = $_COOKIE['username'];
//m_username='$_username'必须加单引号，否则无法解析
$_result = $mysqli->query("SELECT m_username,m_face,m_sex,m_email,m_url,m_qq,m_regtime,m_level FROM m_user WHERE m_username='$_username'");
if($_result){
    $_arr_result = $_result->fetch_array(MYSQLI_ASSOC);
    $_html = array();
    $_html['username'] = $_arr_result['m_username'];
    $_html['sex'] = $_arr_result['m_sex'];
    $_html['face'] = $_arr_result['m_face'];
    $_html['email'] = $_arr_result['m_email'];
    $_html['url'] = $_arr_result['m_url'];
    $_html['qq'] = $_arr_result['m_qq'];
    $_html['regtime'] = $_arr_result['m_regtime'];
    $_html['level'] = $_arr_result['m_level'];
    switch($_arr_result['m_level']){
        case 0:
            $_html['level'] = '普通会员';
            break;
        case 1:
            $_html['level'] = '管理员';
            break;
        default:
            $_html['level'] = 'level wrong!';
    }
    //字符串过滤
    $_html = _htmls($_html);
}else{
    _alert_back("此用户不存在!");
}

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
            <dl>
                <dd><span>用户名:</span><?php echo $_html['username']; ?></dd>
                <dd><span>性别:</span><?php echo $_html['sex']; ?></dd>
                <dd><span>头像:</span><?php echo $_html['face']; ?></dd>
                <dd><span>电子邮件:</span><?php echo $_html['email']; ?></dd>
                <dd><span>主页:</span><?php echo  $_html['url']; ?></dd>
                <dd><span>QQ:</span><?php echo $_html['qq']; ?></dd>
                <dd><span>注册时间:</span><?php echo  $_html['regtime']; ?></dd>
                <dd><span>身份:</span><?php echo $_html['level']; ?></dd>
            </dl>
        </div>
    </div>

    <?php
        require ROOT_PATH."includes/footer.inc.php";
    ?>
</body>
</html>