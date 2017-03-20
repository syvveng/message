<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/22
 * Time: 20:32
 */

//防止恶意调用
if(!defined("IN_TG")){
    exit("Access Defined!");
}

//创建xml
function set_xml($filename,$arr_user){

    $file = @fopen($filename,"w");
    if(!$file){
        echo "文件不存在";
        exit();
    }

    flock($file,LOCK_EX);

    $string = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\r\n";
    fwrite($file,$string,strlen($string));
    $string = "<user>\r\n";
    fwrite($file,$string,strlen($string));
    $string = "\t<id>{$arr_user['id']}</id>\r\n";
    fwrite($file,$string,strlen($string));
    $string = "\t<username>{$arr_user['username']}</username>\r\n";
    fwrite($file,$string,strlen($string));
    $string = "\t<sex>{$arr_user['sex']}</sex>\r\n";
    fwrite($file,$string,strlen($string));
    $string = "\t<face>{$arr_user['face']}</face>\r\n";
    fwrite($file,$string,strlen($string));
    $string = "\t<email>{$arr_user['email']}</email>\r\n";
    fwrite($file,$string,strlen($string));
    $string = "\t<url>{$arr_user['myurl']}</url>\r\n";
    fwrite($file,$string,strlen($string));
    $string = "</user>";
    fwrite($file,$string,strlen($string));

    flock($file,LOCK_UN);
    fclose($file);
}
//获取xml
function get_xml($filename){
    if(file_exists($filename)){
        $_html = array();
        $xml = file_get_contents($filename);
        preg_match_all('/<user>(.*)<\/user>/s',$xml,$_dom);
        foreach($_dom[1] as $value){
            preg_match_all('/<id>(.*)<\/id>/s',$value,$id);
            preg_match_all('/<username>(.*)<\/username>/s',$value,$username);
            preg_match_all('/<sex>(.*)<\/sex>/s',$value,$sex);
            preg_match_all('/<face>(.*)<\/face>/s',$value,$face);
            preg_match_all('/<email>(.*)<\/email>/s',$value,$email);
            preg_match_all('/<url>(.*)<\/url>/s',$value,$url);
            $_html['id'] = $id[1][0];
            $_html['username'] = $username[1][0];
            $_html['sex'] = $sex[1][0];
            $_html['face'] = $face[1][0];
            $_html['email'] = $email[1][0];
            $_html['url'] = $url[1][0];
            $_html = _htmls($_html);
        }
    }else{
        echo "文件不存在!";
    }

    return $_html;
}
/**
 * 截取前14位显示
 * @param $_str
 * @return string
 */
function _display($_str,$length = 14){
    if(mb_strlen($_str,'utf-8') > $length){
        $_str = mb_substr($_str,1,$length,'utf-8')."...";
    }
    return $_str;
}

/**
 * _html()表示对字符串进行HTML过滤显示
 * @param $string
 * @return string
 * Convert special characters to HTML entities:过滤‘’，“”，&，<,>
 */
function _htmls($string){
    if(is_array($string)){
        foreach($string as $key => $value){
            $_string[$key] = htmlspecialchars($value);
        }
    }else{
        $_string = htmlspecialchars($string);
    }
    return $_string;
}
//获取时间
function _runtime(){
    $_time = explode(" ",microtime());
    return $_time[1]+$_time[0];
}

//防止$_GET[$str]没有赋值而报错
function _get($str){
    $val = !empty($_GET[$str]) ? $_GET[$str] : null;
    return $val;
}

//删除session
function _session_destroy(){
    if(session_start()){
        session_destroy();
    }
}
//js弹窗效果以及返回
//弹框中要换行需用\n,但是\n不能用双引号("")，只能用单引号'';
function _alert_back($_info){
    echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
    exit();
}

/**
 * js弹窗效果以及关闭窗口
 * @param $_info
 */
function _alert_close($_info){
    echo "<script type='text/javascript'>alert('$_info');window.close();</script>";
    exit();
}

//定向跳转
function _location($_info,$_url){
    echo "<script type='text/javascript'>alert('$_info');location='$_url';</script>";
    exit();
}

function _is_logout($_info,$_url){
    echo "<script type='text/javascript'>
            if(confirm('$_info')){
                location='$_url';
            }else{
                history.back();
            }             
          </script>";
    exit();
}

function _sha1_uniqid(){
    return sha1(uniqid(rand(),true));
}


/**
 * 转义函数,无效
 * 需要用面向对象方式，过程化方式mysqli_real_escape_string需要传入两个参数
 * @param $str
 * @return array|string
 */
function _mysql_string($str){
    if(!GPC){
        if(is_array($str)){
            foreach($str as $key=>$value){
                $str[$key] = _mysql_string($value);
            }
        }else{
            return mysqli_real_escape_string($str);
        }
    }
    return $str;
}

/**
 * $_width是图像的长度
 * $_height是图像的高度
 * $num是验证码的个数
 * $_flag表示是否设置黑色边框
*/
function verification_code($_width=75,$_height=25,$_num=4, $_flag = false){
    $num = null;

    for($i=0;$i<$_num;$i++){
        $num .= dechex(mt_rand(0,15));
    }
    $_SESSION['code'] = $num;


//$_flag用来确定是否设置图像边框

//定义验证码的长度变量
    $_len = strlen($_SESSION['code']);

//创建真彩色图像
    $_image = imagecreatetruecolor($_width,$_height);

//为图像分配颜色
//创建颜色
    $_white = imagecolorallocate($_image,255,255,255);
    $_black = imagecolorallocate($_image,0,0,0);
//填充背景颜色
    imagefill($_image,0,0,$_white);

//画边框,$_flag=true就显示边框
    if($_flag){
        imagerectangle($_image,0,0,$_width-1,$_height-1,$_black);
    }


//画线
    for($i=0;$i<6;$i++){
        //定义随机颜色
        $_rand_color = imagecolorallocate($_image,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        //画线
        imageline($_image,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rand_color);
    }

//画雪花*
    for($i=0;$i<100;$i++){
        $_rand_color = imagecolorallocate($_image,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        imagestring($_image,1,mt_rand(1,$_width),mt_rand(1,$_height),"*",$_rand_color);
    }

//输出验证码
    for($i=0;$i<$_len;$i++){
        //设置验证码的随机颜色
        $_font_color = imagecolorallocate($_image,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200));

        /**
         * $i*$_width/$_len+mt_rand(1,10)将验证码分成$_len块区域
         * 保证$_SESSION['code'][$i]放在第$i块区域
         */
        imagestring($_image,mt_rand(3,5),$i*$_width/$_len+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_font_color);

    }

//表头，以PNG格式输出
    header("content_type:image/png");
//输出图像

    imagepng($_image);
    imagedstroy($_image);

}

?>