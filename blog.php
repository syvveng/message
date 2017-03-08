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

/**
 * $pagesize每页显示数量
 * $num数据总条数
 * $page当前页
 * $page_start表示从第$page_start+1条开始取值
 * $pagenum页数
 * mysqli_num_rows取得查询结果的数量
 * ceil() 进一法取整
 */
if(isset($_GET['page'])){
    $page = $_GET['page'];
    if(empty($_GET['page']) || !is_numeric($_GET['page']) || $page < 0){
        $page = 1;
    }else{
        $page = intval($page);
    }
}else{
    $page = 1;
}
//$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$pagesize = 8;
$num = mysqli_num_rows($mysqli->query("SELECT m_id FROM m_user"));
if($num == 0){
    $pagenum = 1;
}else{
    $pagenum = ceil($num/$pagesize);
}
if($page > $pagenum){
    $page = $pagenum;
}
$page_start = ($page-1)*$pagesize;
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
        <?php }  ?>
        <div class="pagenum">
            <ul>
                <?php
                    for($i=0;$i<$pagenum;$i++){
                        if($page == ($i+1)){
                            echo '<a href="'.SCRIPT.'.php?page='.($i+1).'"><li class="selected">'.($i+1).'</li></a>';
                        }else{
                            echo '<a href="'.SCRIPT.'.php?page='.($i+1).'"><li>'.($i+1).'</li></a>';
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="pagetext">
            <ul>
                <li><?php echo $page; ?>/<?php echo $pagenum; ?>页 |</li>
                <li>共<?php echo $num; ?>个会员 |</li>
                <?php
                    if($page == 1){
                        echo '<li>首页 |</li>';
                        echo '<li>上一页 |</li>';
                    }else{
                        echo '<li><a href="'.SCRIPT.'.php">首页</a> |</li>';
                        echo '<li><a href="'.SCRIPT.'.php?page='.($page-1).'">上一页</a> |</li>';
                    }
                    if($page == $pagenum){
                        echo '<li>下一页 |</li>';
                        echo '<li>尾页</li>';
                    }else{
                        echo '<li><a href="'.SCRIPT.'.php?page='.($page+1).'">下一页</a> |</li>';
                        echo '<li><a href="'.SCRIPT.'.php?page='.$pagenum.'">尾页</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div>


    <?php
        require ROOT_PATH."includes/footer.inc.php";
    ?>
</body>
</html>