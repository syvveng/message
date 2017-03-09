<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/3/4
 * Time: 13:14
 */

//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","blog");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";
require ROOT_PATH."includes/page.func.php";

_page($mysqli->query("SELECT m_id FROM m_user"),12);
$result = $mysqli->query("SELECT m_username,m_sex,m_face FROM m_user ORDER BY m_regtime DESC LIMIT $page_start,$pagesize");

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

    <div id="blog">
        <h2>博友界面</h2>
        <?php while($_user_arr = $result->fetch_array(MYSQLI_ASSOC)){  ?>
        <dl>
            <dt class="name"><?php echo $_user_arr['m_username']; ?>(<?php echo $_user_arr['m_sex']; ?>)</dt>
            <dd class="img"><img src="<?php echo $_user_arr['m_face']; ?>" alt="头像1"/></dd>
            <dt class="sayhi">发消息</dt>
            <dt class="friend">加为好友</dt>
            <dt class="message">写留言</dt>
            <dt class="flower">给<?php if($_user_arr['m_sex'] == '男'){ echo '他';}else{echo '她';} ?>送花</dt>
        </dl>
        <?php }
            //释放结果内存
             mysqli_free_result($result);
            _paging(2);
        ?>
    </div>


    <?php
        require ROOT_PATH."includes/footer.inc.php";
    ?>
</body>
</html>