<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/3/12
 * Time: 2:25
 */

//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","member_message_detail");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";

//登录状态不能进入登录页面
if(empty($_COOKIE['username'])){
    _alert_back("游客状态无法本操作!");
}

if(_get('action') == 'delete' && isset($_GET['id'])){
    $_sql = $mysqli->query("SELECT m_id FROM m_message WHERE m_id='{$_GET['id']}'");
    if($_sql->fetch_array(MYSQLI_ASSOC)){
         $mysqli->query("
                        DELETE FROM m_message 
                        WHERE m_id='{$_GET['id']}'
                        LIMIT 1
                      ");
        if($mysqli->affected_rows == 1){
            $mysqli->close();
            _session_destroy();
            _location('删除成功!','member_message.php');
        }else{
            $mysqli->close();
            _session_destroy();
            _alert_back("删除失败!");
        }
    }else{
        _alert_back("此信息不存在!");
    }
}
if(isset($_GET['id'])){
    $_result = $mysqli->query("SELECT m_id,m_from_user,m_content,m_state,m_date FROM m_message WHERE m_id='{$_GET['id']}'");
    $_arr = $_result->fetch_array(MYSQLI_ASSOC);
    $_html = array();
    $_html['id'] = $_arr['m_id'];
    $_html['from_user'] = $_arr['m_from_user'];
    $_html['content'] = $_arr['m_content'];
    $_html['date'] = $_arr['m_date'];
    $_html = _htmls($_html);
    if($_arr['m_state'] == 0){
        $mysqli->query("UPDATE m_message SET m_state=1 WHERE m_id='{$_GET['id']}'");
    }
}else{
    _alert_back("非法操作!");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>多用户留言系统</title>
    <?php require ROOT_PATH."includes/title.inc.php"; ?>
    <script type="text/javascript" src="js/member_message_detail.js"></script>
</head>
<body>
    <?php
        require ROOT_PATH."includes/header.inc.php";
    ?>
    <div id="member">
        <?php require ROOT_PATH."includes/member.inc.php"; ?>
        <div class="member_main">
            <h2>信息详情</h2>
            <dl>
                <dd>发信者:<?php echo $_html['from_user']; ?> </dd>
                <dd> 发送时间:<?php echo $_html['date']; ?></dd>
                <dd>内容:<strong><?php echo $_html['content']; ?></strong></dd>
                <dd><input type="button" id="return" value="返回列表"  />
                    <input type="button" id="delete" name="<?php echo $_html['id']; ?>" value="删除信息">
                </dd>
            </dl>
        </div>
    </div>
    <?php
         require ROOT_PATH."includes/footer.inc.php";
    ?>
</body>
</html>