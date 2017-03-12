/**
 * Created by Weng on 2017/3/11.
 */

window.onload = function () {
    var fm = document.getElementsByTagName("form")[0];
    fm.onsubmit = function () {
        if(fm.content.value.length <3 || fm.content.value.length>500){
            alert("信息内容长度必须在3-500之间!");
            history.back();
            fm.content.focus();
            return false;
        }
        return true;
    }

};