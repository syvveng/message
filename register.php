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
define("SCRIPT","register");
//定义硬路径为一个常量，引入速度更快
require dirname(__FILE__)."/includes/common.inc.php";

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
    $mysqli->close();
    _location("注册成功！","index.php");

}
    $_SESSION['uniqid'] = $_uniqid = _sha1_uniqid();
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <title>会员注册</title>
    <?php require ROOT_PATH."includes/title.inc.php";  ?>
    <!--    如果同时加载两个js脚本，前面的失效-->
    <script type="text/javascript" src="js/register.js" ></script>
</head>
<body>
    <?php require ROOT_PATH."includes/header.inc.php"; ?>

    <div id="register">
    	<h2>会员注册</h2>
    	<form method="post" name="register" action="register.php?action=register">
            <input type="hidden" name="uniqid" value="<?php echo $_uniqid; ?>" />
    		<dl>
    			<dt>请认真填写以下信息</dt>
                <div class="int">
                    <label for="username">用户名:</label>
                    <input type="text" name="username" class="text"/>
                    <span>(*必填项)</span>
                </div>
                <div class="int">
                    <label for="password">密码:</label>
                    <input type="password" name="password" class="text"/>
                    <span>(*必填项，长度6-18)</span>
                </div>
                <div class="int">
                    <label for="confirm_pass">确认密码:</label>
                    <input type="password" name="confirm_pass" class="text"/>
                    <span>(*必填项)</span>
                </div>
                <div class="int">
                    <label for="question">密码提示:</label>
                    <input type="text" name="question" class="text"/>
                    <span>(*必填项)</span>
                </div>
                <div class="int">
                    <label for="answer">密码回答:</label>
                    <input type="text" name="answer" class="text"/>
                    <span>(*必填项)</span>
                </div>
                <div class="int">
                    <label for="sex">性别:</label>
                    <input type="radio" name="sex" value="男" checked="checked" />男
                    <input type="radio" name="sex" value="女" />女
                </div>
                <div class="img">
                    <label for="face">头像选择:</label>
                    <input type="hidden" name="face" id="input_face" value="images/face/1.jpg"/>
                    <img src="images/face/1.jpg"  id="faceimg" alt="select_pics">
                </div>
                <div class="int">
                    <label for="email">邮件:</label>
                    <input type="text" name="email" class="text"/>
                </div>
                <div class="int">
                    <label for="qq">QQ:</label>
                    <input type="text" name="qq" class="text"/>
                </div>
                <div class="int">
                    <label for="myurl">个人主页:</label>
                    <input type="text" name="myurl" value="http://" class="text"/>
                </div>
                <div class="int">
                    <label for="yzm">验证码:</label>
                    <input type="text" name="yzm" class="text yzm"/>
                    <img src="verificationCode.php" id="code" class="yzm" />
                </div>
                <div class="sub">
                    <input type="submit" value="注册" class="submit"/>
                    <input type="reset" value="重置" class="submit" />
                </div>
    		</dl>	
    	</form>
    </div>
    <?php require ROOT_PATH."includes/footer.inc.php"; ?>
</body>
</html>