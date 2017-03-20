<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/21
 * Time: 20:13
 */

//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","index");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";

$user_arr = get_xml("new_user.xml");
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>多用户留言系统</title>
    <?php require ROOT_PATH."includes/title.inc.php"; ?>
    <script type="text/javascript" src="js/blog.js"></script>
</head>

<body>
    <?php
        require ROOT_PATH."includes/header.inc.php";
    ?>

    <div id="list">
        <h2>帖子列表</h2>
    </div>
    <div id="vip">
        <h2>新进会员</h2>
        <dl>
            <dt class="name"><?php echo $user_arr['username']; ?>(<?php echo $user_arr['sex']; ?>)</dt>
            <dd class="img"><img src="<?php echo $user_arr['face']; ?>" alt="<?php echo $user_arr['username']; ?>"/></dd>
            <dt class="sayhi"><a href="javascript:;" name="message" title="<?php echo $user_arr['id']; ?>">发消息</a></dt>
            <dt class="friend"><a href="javascript:;" name="friend" title="<?php echo $user_arr['id']; ?>">加为好友</a></dt>
            <dt class="message">写留言</dt>
            <dt class="flower"><a href="member_zan.php?action=zan&id=<?php echo $user_arr['id']; ?>">给ta点赞</a></dt>
            <dt class="email"><a href="mailto:<?php echo $user_arr['email']; ?>">邮件：<?php echo $user_arr['email']; ?></a></dt>
            <dt class="url"><a href="<?php echo $user_arr['url']; ?>">网址：<?php echo $user_arr['url']; ?></a></dt>
        </dl>
    </div>
    <div id="pics">
        <h2>最新图片</h2>
    </div>

    <?php
        require ROOT_PATH."includes/footer.inc.php";
    ?>
</body>

</html>
