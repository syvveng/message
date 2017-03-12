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
define("SCRIPT","member_message");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";
require ROOT_PATH."includes/page.func.php";

//登录状态不能进入登录页面
if(empty($_COOKIE['username'])){
    _alert_back("游客状态无法本操作!");
}

if(_get('action') == 'delete' && isset($_POST['checkthis'])){
   $_arr = array();
   $_arr['checkthis'] = implode(',',$_POST['checkthis']);
   $mysqli->query("
                DELETE FROM  m_message
                       WHERE   m_id
                          IN  ({$_arr['checkthis']})
                ");
   if($mysqli->affected_rows){
       $mysqli->close();
       _location("删除成功!","member_message.php");
   }else{
       $mysqli->close();
       _alert_back("删除失败!");
   }
    exit();
}

_page($mysqli->query("SELECT m_id FROM m_message WHERE m_to_user='{$_COOKIE['username']}'"),8);
$result = $mysqli->query("SELECT m_id,m_from_user,m_content,m_date FROM m_message ORDER BY m_date DESC LIMIT $page_start,$pagesize");

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>多用户留言系统</title>
    <?php require ROOT_PATH."includes/title.inc.php"; ?>
    <script type="text/javascript" src="js/member_message.js"></script>
</head>
<body>

    <?php
    require ROOT_PATH."includes/header.inc.php";
    ?>
<div id="member">
    <?php require ROOT_PATH."includes/member.inc.php"; ?>

    <div class="member_main">
        <h2>信息管理中心</h2>
        <form method="post" action="?action=delete">
            <table cellspacing="1">
                <tr><th>发信者</th><th>消息内容</th><th>发送时间</th><th>操作</th></tr>
                <?php
                    while($_arr = $result->fetch_array(MYSQLI_ASSOC)){
                        $_html = array();
                        $_html['id'] = $_arr['m_id'];
                        $_html['from_user'] = $_arr['m_from_user'];
                        $_html['content'] = $_arr['m_content'];
                        $_html['date'] = $_arr['m_date'];
                        $_html = _htmls($_html);
                ?>
                <tr>
                    <td><?php echo $_html['from_user']; ?></td>
                    <td title="<?php echo $_html['content']; ?>"><a href="member_message_detail.php?id=<?php echo $_html['id']; ?>"><?php echo _display($_html['content']); ?></a></td>
                    <td><?php echo $_html['date']; ?></td>
                    <!-- 复选框name必须为数组，加[],这样$_POST才是数组，否者最后选择的会覆盖前面的所有选择 -->
                    <td><input type="checkbox" name="checkthis[]" value="<?php echo $_html['id']; ?>" /></td>
                </tr>
                    <?php }
                        mysqli_free_result($result);
                    ?>
                    <tr><td colspan="4"><label for="all">全选<input type="checkbox" name="chkall" id="all" /></label><input type="submit" value="批量删除"></td></tr>
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