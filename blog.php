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

if(_get('action') == 'zan' && isset($_GET['id'])){
    if(!empty($_COOKIE['username'])){
        $blog_sql = $mysqli->query("SELECT m_username FROM m_user WHERE m_id='{$_GET['id']}' LIMIT 1");
        $blog_result = $blog_sql->fetch_array(MYSQLI_ASSOC);
        $zan_sql = $mysqli->query("SELECT m_id 
                                   FROM m_zan 
                                  WHERE m_to_user='{$blog_result['m_username']}'
                                    AND m_from_user='{$_COOKIE['username']}'
                                ");
        $zan_result = $zan_sql->fetch_array(MYSQLI_ASSOC);
        if(empty($zan_result)){
            $mysqli->query("INSERT INTO m_zan (
                                                  m_to_user,
                                                  m_from_user,
                                                  m_zan_num,
                                                  m_date) 
                                        VALUES (
                                                  '{$blog_result['m_username']}',
                                                  '{$_COOKIE['username']}',
                                                  '1',
                                                  NOW()
                                                 )
                          ");
            if($mysqli->affected_rows == 1){
                $mysqli->close();
                _location("点赞成功!","blog.php");
            }else{
                $mysqli->close();
                _alert_back("点赞失败!");
            }

        }else{
            _alert_back("对不起，您已经点过赞!");
        }
    }else{
        _alert_back("请先登录!");
    }
}

$_COOKIE['username'] = !empty($_COOKIE['username']) ? $_COOKIE['username'] : null;
_page($mysqli->query("SELECT m_id FROM m_user WHERE m_username!='{$_COOKIE['username']}'"),12);
$result = $mysqli->query("SELECT m_id,m_username,m_sex,m_face FROM m_user WHERE m_username!='{$_COOKIE['username']}' ORDER BY m_regtime DESC LIMIT $page_start,$pagesize");

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

    <div id="blog">
        <h2>博友界面</h2>
        <?php while($_user_arr = $result->fetch_array(MYSQLI_ASSOC)){ ?>
        <dl>
            <dt class="name"><?php echo $_user_arr['m_username']; ?>(<?php echo $_user_arr['m_sex']; ?>)</dt>
            <dd class="img"><img src="<?php echo $_user_arr['m_face']; ?>" alt="头像1"/></dd>
            <dt class="sayhi"><a href="" name="message" title="<?php echo $_user_arr['m_id']; ?>">发消息</a></dt>
            <dt class="friend"><a href="" name="friend" title="<?php echo $_user_arr['m_id']; ?>">加为好友</a></dt>
            <dt class="message">写留言</dt>
            <dt class="flower"><a href="?action=zan&id=<?php echo $_user_arr['m_id']; ?>">给<?php if($_user_arr['m_sex'] == '男'){ echo '他';}else{echo '她';} ?>点赞</a></dt>
        </dl>
        <?php }
            //释放结果内存
             mysqli_free_result($result);
            _paging_blog(2);
        ?>
    </div>


    <?php
        require ROOT_PATH."includes/footer.inc.php";
    ?>
</body>
</html>