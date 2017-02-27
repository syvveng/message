<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/2/22
 * Time: 20:32
 */

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

//js弹窗效果以及返回
//弹框中要换行需用\n,但是\n不能用双引号("")，只能用单引号'';
function _alert_back($_info){
    echo "<script type='text/javascript'>alert('".$_info."');history.back();</script>";
    exit();
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