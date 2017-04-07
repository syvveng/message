<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/22
 * Time: 20:42
 */

session_start();

//定义常量，用来授权调用includes里面的文件，防止恶意调用
define("IN_TG",true);
//定义一个常量，引入本页内容
define("SCRIPT","post");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";

//登录状态不能进入注册页面
if(empty($_COOKIE['username'])){
    _alert_back("请登录后再操作操作!");
}

//单独这样写会报错 Undefined index：action
//if($_GET['action']=='register'){
//    echo "hello";
//    exit();
//}
//我们在核心函数库中(global.func.php)用一个函数_get()来表示$_GET[$str]并赋值就不会报错了
if(_get('action') == 'register'){

    // 为了防止恶意注册
    if(!($_POST['yzm'] == $_SESSION['code'])){
        _alert_back("验证码错误！");
    }
    require ROOT_PATH."includes/register.func.php";
    $_arr = array();
    $_arr['uniqid'] = _check_uniqid($_POST['uniqid'], $_SESSION['uniqid']);
    $_arr['active'] = sha1(uniqid(rand(),true));
    //用户名检测
    //$str:表示提交的username,$mix:用户名最小值,$max:用户名最大值
    $_arr['username'] = _check_username('username',3,20);
    //密码检测
    $_arr['password'] = _check_password('password','confirm_pass');
    $_arr['question'] = _check_question('question');
    $_arr['answer'] = _check_answer('answer');
     //性别
    $_arr['sex'] = _check_sex('sex');
    //头像
    $_arr['face'] = _check_face('face');
    //email
    $_arr['email'] = _check_email('email');
    //QQ
    $_arr['qq'] = _check_qq('qq');
    //个人主页
    $_arr['myurl'] = _check_url('myurl');
//    print_r($_arr);

    $_query = $mysqli->query("SELECT m_username FROM m_user WHERE m_username='{$_arr['username']}' LIMIT 1");

    //检测用户名是否存在
    if(mysqli_fetch_array($_query)){
        _alert_back("对不起，此用户名已被注册!");
    }


    $mysqli->query("INSERT INTO m_user(
                                          m_uniqid,
                                          m_active,
                                          m_username,
                                          m_password,
                                          m_question,
                                          m_answer,
                                          m_email,
                                          m_qq,
                                          m_url,
                                          m_sex,
                                          m_face,                                          
                                          m_regtime,
                                          m_last_logtime,
                                          m_lastip
                                        )
                                        VALUES
                                        (
                                        '{$_arr['uniqid']}',
                                        '{$_arr['active']}',
                                        '{$_arr['username']}',
                                        '{$_arr['password']}',
                                        '{$_arr['question']}',
                                        '{$_arr['answer']}',
                                        '{$_arr['email']}',
                                        '{$_arr['qq']}',
                                        '{$_arr['myurl']}',
                                        '{$_arr['sex']}',
                                        '{$_arr['face']}',                                       
                                        NOW(),
                                        NOW(),
                                        '{$_SERVER['REMOTE_ADDR']}'
                                        )");
    if($mysqli->affected_rows == 1) {
        //获取刚刚新增的ID
        $_arr['id'] = $mysqli->insert_id;
        $mysqli->close();
        set_xml("new_user.xml",$_arr);
        _location("注册成功！", "active.php?active=".$_arr['active']);
    }else{
        $mysqli->close();
        _location("注册失败！", "register.php");
    }
}
    $_SESSION['uniqid'] = $_uniqid = _sha1_uniqid();
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>发表帖子</title>
    <?php require ROOT_PATH."includes/title.inc.php";  ?>
    <!--    如果同时加载两个js脚本，前面的失效-->
    <script type="text/javascript" src="js/register.js" ></script>
</head>
<body>
    <?php require ROOT_PATH."includes/header.inc.php"; ?>

    <div id="post">
    	<h2>会员注册</h2>
    	<form method="post" name="post" action="post.php?action=post">
    		<dl>
    			<dt>请认真填写帖子内容</dt>
                <div class="int">
                    <label for="type">类型:</label>
                </div>
                <div class="int">
                    <label for="username">主题:</label>
                    <input type="text" name="title" class="text"/>
                </div>
                <div class="int">
                    <label for="content">内容:</label>
                    <textarea name="content" ></textarea>
                </div>
                <div class="sub">
                    <input type="submit" value="发表" class="submit"/>
                </div>
    		</dl>
    	</form>
    </div>
    <?php require ROOT_PATH."includes/footer.inc.php"; ?>
</body>
</html>