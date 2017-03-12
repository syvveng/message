<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/3/11
 * Time: 11:08
 */

//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","message");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";

if(!isset($_COOKIE['username'])){
    _alert_close("请先登录!");
}

//提交数据
if(_get('action') == 'write'){
    include ROOT_PATH.'includes/message.func.php';
    $_arr = array();
    $_arr['to_user'] = $_POST['to_user'];
    $_arr['from_user'] = $_COOKIE['username'];
    $_arr['content'] = _check_content($_POST['content']);
    //写入数据
    $mysqli->query("INSERT INTO m_message(                                                      
                                          m_to_user,
                                          m_from_user,
                                          m_content,
                                          m_date
                                          )
                                VALUES (                                                  
                                      '{$_arr['to_user']}',
                                      '{$_arr['from_user']}',
                                      '{$_arr['content']}',
                                      NOW()
                                        )
                             ");
    if($mysqli->affected_rows == 1){
        $mysqli->close();
        _alert_close("信息发送成功!");
    }else{
        $mysqli->close();
        _alert_back("信息发送失败");
    }
    //后面不用执行了，如果不写exit后面会报错获取不到id
    exit();
}

//获取数据
if(isset($_GET['id'])){
    $_message_sql = $mysqli->query("SELECT m_username FROM m_user WHERE m_id='{$_GET['id']}'");
    $_message_arr = $_message_sql->fetch_array(MYSQLI_ASSOC);
    $_html = array();
    $_html['to_user'] = $_message_arr['m_username'];
    $_html = _htmls($_html);

}else{
    _alert_close('非法操作!');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>发消息</title>
   <?php require ROOT_PATH."includes/title.inc.php"; ?>
    <script type="text/javascript" src="js/message.js"></script>
</head>
<body>
    <div id="message">
        <h2>发消息</h2>
        <form action="?action=write" method="post">
            <input type="hidden" name="to_user" value="<?php echo $_html['to_user']; ?>" />
            <dl>
                <dd>Message to:<span><?php echo $_html['to_user']; ?></span></dd>
                <dd><textarea name="content"></textarea></dd>
                <dd><input type="submit" class="submit" name="submit" value="发送消息"></dd>
            </dl>
        </form>
    </div>
</body>
</html>