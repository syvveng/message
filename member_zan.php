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
define("SCRIPT","member_zan");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";
require ROOT_PATH."includes/page.func.php";

//登录状态不能进入登录页面
if(empty($_COOKIE['username'])){
    _alert_back("游客状态无法本操作!");
}

//回赞
if(_get("action") == 'thanks' && isset($_GET['id'])){
    $zan_sql = $mysqli->query("SELECT m_id,m_from_user
                                  FROM m_zan 
                                 WHERE m_id='{$_GET['id']}'
                             ");
    $zan_result = $zan_sql->fetch_array(MYSQLI_ASSOC);
    //回赞操作
    $mysqli->query("INSERT INTO m_zan (
                                          m_to_user,
                                          m_from_user,
                                          m_zan_num,
                                          m_date
                                        )
                                VALUES(
                                          '{$zan_result['m_from_user']}',
                                          '{$_COOKIE['username']}',
                                          '1',
                                          NOW()
                                        )
                                ");
    if($mysqli->affected_rows == 1){
        $mysqli->close();
        _location("回赞成功!","member_zan.php");
    }else{
        $mysqli->close();
        _alert_back("回赞失败!");
    }
}


//删除点赞
if(_get('action') == 'delete' && isset($_POST['checkthis'])){
   $_arr = array();
   $_arr['checkthis'] = implode(',',$_POST['checkthis']);
   $mysqli->query("
                DELETE FROM  m_zan
                       WHERE   m_id
                          IN  ({$_arr['checkthis']})
                ");
   if($mysqli->affected_rows){
       $mysqli->close();
       _location("删除成功!","member_zan.php");
   }else{
       $mysqli->close();
       _alert_back("删除失败!");
   }
}

_page($mysqli->query("SELECT m_id FROM m_zan WHERE m_to_user='{$_COOKIE['username']}'"),8);
$result = $mysqli->query("SELECT m_id,m_from_user,m_date FROM m_zan WHERE m_to_user='{$_COOKIE['username']}' ORDER BY m_date DESC LIMIT $page_start,$pagesize");

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
        <h2>点赞管理中心</h2>
        <form method="post" action="?action=delete">
            <table cellspacing="1">
                <tr><th>点赞者</th><th>点赞时间</th><th>知恩图报</th><th>操作</th></tr>
                <?php
                    while($_arr = $result->fetch_array(MYSQLI_ASSOC)){
                        $_html = array();
                        $_html['id'] = $_arr['m_id'];
                        $_html['from_user'] = $_arr['m_from_user'];
//                        $_html['content'] = $_arr['m_content'];
//                        $_html['state'] = $_arr['m_state'];
                        $_html['date'] = $_arr['m_date'];
                        $_html = _htmls($_html);
                        $_zan_sql = $mysqli->query("SELECT m_id
                                                      FROM m_zan 
                                                     WHERE m_to_user='{$_arr['m_from_user']}' 
                                                       AND m_from_user='{$_COOKIE['username']}'
                                                  ");
                        $_zan_result = $_zan_sql->fetch_array(MYSQLI_ASSOC);
                        if(empty($_zan_result)){
                            $_html['thanks'] = '<a href="?action=thanks&id='.$_arr['m_id'].'" style="color:red;">回赞</a>';
                        }else{
                            $_html['thanks'] = '<span style="color:green;">已回赞</span>';
                        }

                ?>
                <tr>
                    <td><?php echo $_html['from_user']; ?></td>
                    <td><?php echo $_html['date']; ?></td>
                    <td><?php echo $_html['thanks']; ?></td>
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