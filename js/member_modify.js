/**
 * Created by Weng on 2017/2/23.
 */
window.onload=function(){

    //表单验证
    var fm = document.getElementsByTagName("form")[0];
    // var username = fm.getElementsByClassName("text");
    // var display = fm.getElementsByClassName("display");
    // alert(display[0].innerHTML.fontcolor('red')  );

    //当鼠标离开用户名表单时，立即给出格式检测结果
    /**
     * 颜色还有待设置
     * @returns {boolean}
     */


    fm.onsubmit = function () {

        //邮件验证
        if (fm.email.value.length < 3 || fm.email.value.length > 30) {
            alert("邮箱长度不得小于3或者大于20位!");
            fm.email.focus();
            return false;
        }
        if (!(/^([a-zA-Z0-9_])+\@([a-zA-Z0-9_])+(.[a-zA-Z0-9_])+/.test(fm.email.value))) {
            alert("邮箱格式错误!");
            //光标聚焦到表单
            fm.email.focus();
            return false;
        }
        //qq验证
        if (fm.qq.value != "") {
            if (fm.qq.value.length < 3 || fm.answer.qq.length > 12) {
                alert("QQ长度不得小于3或者大于12位!");
                fm.qq.focus();
                return false;
            }
            if (!/[1-9]{1,}([0-9]{5,11})/.test(fm.qq.value)) {
                alert("QQ第一位不能为0!");
                fm.qq.focus();
                return false;
            }
        }

        //网址验证
        if (fm.myurl.value != "") {
            if (/^((https|http|ftp|rtsp|mms)?:\/\/)[^\s]+/.test(fm.myurl.value)) {
                alert("个人网址格式不对!");
                fm.myurl.value = "";
                fm.myurl.focus();
                return false;
            }
        }
        return true;
    }
}


