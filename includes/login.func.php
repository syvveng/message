<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/3/4
 * Time: 9:41
 */

function _setcookies($name,$val,$keeptime){
    switch ($keeptime){
        case 0:
            setcookie($name,$val);
            break;
        case 1:
            //保留一天：3600*24
            setcookie($name,$val,time()+86400);
            break;
        case 2:
            //保留一周：3600*24*7
            setcookie($name,$val,time()+604800);
            break;
        case 3:
            //保留一个月：3600*24*30
            setcookie($name,$val,time()+2592000);
            break;
        default:
            setcookie($name,$val);
    }
}

?>