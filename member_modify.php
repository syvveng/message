<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/3/10
 * Time: 20:07
 */

//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","member_modify");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";

if(_get('action') == 'modify'){
    require ROOT_PATH."includes/register.func.php";
    //防止伪造COOKIE
    $sql = $mysqli->query("SELECT m_uniqid FROM m_user WHERE m_username='{$_COOKIE['username']}'");
    $result = $sql->fetch_array(MYSQLI_ASSOC);
    if($result['m_uniqid'] != $_COOKIE['uniqid']){
        _alert_back('唯一标识符错误!');
    }

    $_arr = array();
    //性别
    $_arr['sex'] = _check_sex('sex');
    //头像
    $_arr['face'] = _check_face('face');
    //email
    $_arr['email'] = _check_email('email');
    //QQ
    $_arr['qq'] = _check_qq('qq');
    //个人主页
    $_arr['url'] = _check_url('url');

    $_query = $mysqli->query("
            UPDATE m_user SET
                            m_sex='{$_arr['sex']} ',
                            m_face='{$_arr['face']}',
                            m_email='{$_arr['email']}',
                            m_qq='{$_arr['qq']}',
                            m_url='{$_arr['url']}'
                            WHERE m_username='{$_COOKIE['username']}'
                            ");
    if($mysqli->affected_rows == 1){
        $mysqli->close();
        _location("修改成功!","member.php");
    }else{
        $mysqli->close();
        _location("没有任何资料修改!","member_modify.php");
    }
}

//登录状态不能进入登录页面
if(empty($_COOKIE['username'])){
    _alert_back("游客状态无法本操作!");
}
$_username = $_COOKIE['username'];
//m_username='$_username'必须加单引号，否则无法解析
$_result = $mysqli->query("SELECT m_username,m_face,m_sex,m_email,m_url,m_qq,m_regtime,m_level FROM m_user WHERE m_username='$_username'");
if($_result){
    $_arr_result = $_result->fetch_array(MYSQLI_ASSOC);
    $_html = array();
    $_html['username'] = $_arr_result['m_username'];
    $_html['sex'] = $_arr_result['m_sex'];
    $_html['face'] = $_arr_result['m_face'];
    $_html['email'] = $_arr_result['m_email'];
    $_html['url'] = $_arr_result['m_url'];
    $_html['qq'] = $_arr_result['m_qq'];
    $_html['regtime'] = $_arr_result['m_regtime'];
    $_html['level'] = $_arr_result['m_level'];
    switch($_arr_result['m_level']){
        case 0:
            $_html['level'] = '普通会员';
            break;
        case 1:
            $_html['level'] = '管理员';
            break;
        default:
            $_html['level'] = 'level wrong!';
    }
    //字符串过滤
    $_html = _htmls($_html);

    //性别选择
    if($_html['sex'] == '男'){
        $_html['sex_html'] = '<input type="radio" name="sex" class="text" value="男" checked="checked">男<input type="radio" name="sex" value="女" >女';
    }else{
        $_html['sex_html'] = '<input type="radio" name="sex" class="text" value="男" >男<input type="radio" name="sex" value="女" checked="checked">女';
    }

    //头像选择
    $_html['face_html'] = '<select name="face">';
    foreach(range(1,52) as $pic){
        //preg_replace将非数字替换为空白,结果就是数字
        if($pic == preg_replace('/\D/', '', $_html['face'])){
            $_html['face_html'] .= "<option value='images/face/$pic.jpg' class='text' selected='selected'>images/face/$pic.jpg</option>>";
        }else{
            $_html['face_html'] .= "<option value='images/face/$pic.jpg' class='text'>images/face/$pic.jpg</option>>";
        }
    }
    //一定要用.累加，否则$_html['face_html']最后就等于</select>
    $_html['face_html'] .= '</select>';
}else{
    _alert_back("此用户不存在!");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>多用户留言系统</title>
    <?php require ROOT_PATH."includes/title.inc.php"; ?>
    <script type="text/javascript" src="js/member_modify.js" ></script>
</head>
<body>
    <?php
        require ROOT_PATH."includes/header.inc.php";
    ?>

    <div id="member_modify">
        <?php require ROOT_PATH."includes/member.inc.php"; ?>

        <div class="member_main">
            <h2>会员资料修改</h2>
            <form method="post" action="?action=modify">
                <dl>
                    <dd><span>用户名:</span><?php echo $_html['username']; ?></dd>
                    <dd><span>性别:</span>
                        <?php echo $_html['sex_html']; ?>
                    </dd>
                    <dd><span>头像:</span>
                        <?php echo $_html['face_html']; ?>
                    </dd>
                    <dd><span>电子邮件:</span>
                        <input type="text" name="email" class='text' value="<?php echo $_html['email']; ?>">
                    </dd>
                    <dd><span>主页:</span>
                        <input type="text" name="url"  class='text'value="<?php echo $_html['url']; ?>">
                    </dd>
                    <dd><span>QQ:</span>
                        <input type="text" name="qq" class='text' value="<?php echo $_html['qq']; ?>">
                    </dd>
                    <dd class="submit"><input type="submit" name="submit" value="修改资料"></dd>
                </dl>
            </form>
        </div>

    </div>

    <?php
        require ROOT_PATH."includes/footer.inc.php";
    ?>
</body>
</html>