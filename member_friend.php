<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/3/12
 * Time: 0:56
 */
//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","member_friend");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";
require ROOT_PATH."includes/page.func.php";

//登录状态不能进入登录页面
if(empty($_COOKIE['username'])){
    _alert_back("游客状态无法本操作!");
}

//验证好友
if(_get('action') == 'pass' && isset($_GET['id'])){
    $mysqli->query("UPDATE m_friend SET m_state=1 WHERE m_id='{$_GET['id']}'");
    if($mysqli->affected_rows == 1){
        $mysqli->close();
       _location("好友验证成功!","member_friend.php");
    }else{
        $mysqli->close();
        _alert_back("好友验证失败!");
    }
}

//删除好友
if(_get('action') == 'delete' && isset($_POST['checkthis'])){
   $_arr = array();
   $_arr = $_POST['checkthis'];
    $_arr['checkthis'] = implode(',',$_POST['checkthis']);
    $mysqli->query("
                DELETE FROM  m_friend
                       WHERE   m_id
                          IN  ({$_arr['checkthis']})
                ");
       if($mysqli->affected_rows){
           $mysqli->close();
           _location("删除成功!","member_friend.php");
       }else{
           $mysqli->close();
           _alert_back("删除失败!");
       }
//    exit();
}

_page($mysqli->query("SELECT m_id FROM m_friend WHERE m_added_user='{$_COOKIE['username']}'"),8);
$result = $mysqli->query("SELECT m_id,m_added_user,m_request_user,m_content,m_state,m_date FROM m_friend WHERE m_added_user='{$_COOKIE['username']}' ORDER BY m_date DESC LIMIT $page_start,$pagesize");

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>多用户留言系统</title>
    <?php require ROOT_PATH."includes/title.inc.php"; ?>
    <script type="text/javascript" src="js/member_friend.js"></script>
</head>
<body>

    <?php
    require ROOT_PATH."includes/header.inc.php";
    ?>
<div id="member">
    <?php require ROOT_PATH."includes/member.inc.php"; ?>

    <div class="member_main">
        <h2>好友管理中心</h2>
        <form method="post" action="?action=delete">
            <table cellspacing="1">
                <tr><th>请求者</th><th>验证内容</th><th>发送时间</th><th>状态</th><th>操作</th></tr>
                <?php
                    while($_arr = $result->fetch_array(MYSQLI_ASSOC)){
                        $_html = array();
                        $_html['id'] = $_arr['m_id'];
                        $_html['request_user'] = $_arr['m_request_user'];
                        $_html['content'] = $_arr['m_content'];
//                        $_html['content'] = $_arr['m_content'];
//                        $_html['state'] = $_arr['m_state'];
                        $_html['date'] = $_arr['m_date'];
                        $_html = _htmls($_html);
                        if($_arr['m_state'] == 1){
                            $_html['state'] = '<span style="color:green;">通过</span>';

                        }else{
                            $_html['state'] = '<a href="?action=pass&id='.$_html['id'].'" style="color:red;">未同意</a>';

                        }
                ?>
                <tr>
                    <td><?php echo $_html['request_user']; ?></td>
                    <td title="<?php echo $_html['content']; ?>"><?php echo $_html['content']; ?></td>
                    <td><?php echo $_html['date']; ?></td>
                    <td><?php echo $_html['state']; ?></td>
                    <!-- 复选框name必须为数组，加[],这样$_POST才是数组，否者最后选择的会覆盖前面的所有选择 -->
                    <td><input type="checkbox" name="checkthis[]" value="<?php echo $_html['id']; ?>" /></td>
                </tr>
                    <?php }
                        mysqli_free_result($result);
                    ?>
                    <tr><td colspan="5"><label for="all">全选<input type="checkbox" name="chkall" id="all" /></label><input type="submit" value="批量删除"></td></tr>
            </table>
        </form>
        <?php _paging_message(2); ?>
    </div>
</div>
    <?php
    require ROOT_PATH."includes/footer.inc.php";
    ?>
</body>
</html>