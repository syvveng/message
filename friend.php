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
define("SCRIPT","friend");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";

if(!isset($_COOKIE['username'])){
    _alert_close("请先登录!");
}

//提交数据
if(_get('action') == 'add'){
    include ROOT_PATH.'includes/message.func.php';
    $_arr = array();
    $_arr['added_user'] = $_POST['added_user'];
    $_arr['request_user'] = $_COOKIE['username'];
    $_arr['content'] = _check_content($_POST['content']);

    $_friend_sql = $mysqli->query("SELECT m_id FROM  m_friend 
                                               WHERE  m_added_user= '{$_arr['added_user']}' AND m_request_user='{$_arr['request_user']}'
                                                  OR  m_added_user= '{$_arr['request_user']}' AND m_request_user='{$_arr['added_user']}'
                                  ");
    $_friend_result = $_friend_sql->fetch_array(MYSQLI_ASSOC);
    if($_friend_result){
        _alert_close("已经添加过好友!");
    }else{
        //写入数据
        $mysqli->query("INSERT INTO m_friend(                                                      
                                              m_added_user,
                                              m_request_user,
                                              m_content,
                                              m_date
                                              )
                                    VALUES (                                                  
                                          '{$_arr['added_user']}',
                                          '{$_arr['request_user']}',
                                          '{$_arr['content']}',
                                          NOW()
                                            )
                                 ");
        if($mysqli->affected_rows == 1){
            $mysqli->close();
            _alert_close("添加成功!");
        }else{
            $mysqli->close();
            _alert_back("添加失败!");
        }
    }
    //测试用：后面不用执行了，如果不写exit后面会报错获取不到id
    //  exit();
}

//获取数据
if(isset($_GET['id'])){
    $_message_sql = $mysqli->query("SELECT m_username FROM m_user WHERE m_id='{$_GET['id']}'");
    $_message_arr = $_message_sql->fetch_array(MYSQLI_ASSOC);
    $_html = array();
    $_html['added_user'] = $_message_arr['m_username'];
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
    <div id="friend">
        <h2>加好友</h2>
        <form action="?action=add" method="post">
            <input type="hidden" name="added_user" value="<?php echo $_html['added_user']; ?>" />
            <dl>
                <dd>Add:<span><?php echo $_html['added_user']; ?></span></dd>
                <dd><textarea name="content" >你好，我是<?php echo $_COOKIE['username'];  ?>,想和你交个朋友...</textarea></dd>
                <dd><input type="submit" class="submit" name="submit" value="添加好友"></dd>
            </dl>
        </form>
    </div>
</body>
</html>