/**
 * Created by Weng on 2017/2/23.
 */
window.onload=function(){

    //打开选择头像窗口
    var faceimg = document.getElementById("faceimg");
    faceimg.onclick=function(){
        window.open("face.php","face","width=400,height=400,left=0,top=0,scrollbars=1");
    };

    //刷新验证码
    var code = document.getElementById("code");
    code.onclick = function(){
        this.src ='verificationCode.php?tm='+Math.random();
    };

    //表单验证
    var fm = document.getElementsByTagName("form")[0];
    var username = fm.getElementsByClassName("text");
    var display = fm.getElementsByClassName("display");
    // alert(display[0].innerHTML.fontcolor('red')  );

    //当鼠标离开用户名表单时，立即给出格式检测结果
    /**
     * 颜色还有待设置
     * @returns {boolean}
     */
    username[0].onmouseout = function(){
        //用户名验证
        if(fm.username.value.length < 3 ||fm.username.value.length > 20){
            // alert("用户名长度错误，不得小于3或大于20位!");
            display[0].innerHTML = "长度错误，3-20位";
            display[0].class = "a";
            // display[0].color = 'red';
            //清空输入框
            // fm.username.value = "";
            //光标聚焦到表单
            fm.username.focus();
            return false;
        }
        else if(/[<>\,\.\?\!\@\#\$\%\^\&\*\(\)\《\》\;\:\'\"\ \   ]/.test(fm.username.value)){
            display[0].innerHTML = "用户名不能有特殊字符!";
            //清空输入框
            // fm.username.value = "";
            //光标聚焦到表单
            fm.username.focus();
            return false;
        }
        else{
            display[0].innerHTML = "";
            return true;
        }
    }

    fm.onsubmit = function () {

        if(fm.username.value.length < 3 ||fm.username.value.length > 20){
            alert("用户名长度错误，不得小于3或大于20位!");
            display[0].innerHTML = "长度错误，3-20位";
            // display[0].color = 'red';
            //清空输入框
            // fm.username.value = "";
            //光标聚焦到表单
            fm.username.focus();
            return false;
        }
        if(/[<>\,\.\?\!\@\#\$\%\^\&\*\(\)\《\》\;\:\'\"\ \   ]/.test(fm.username.value)){
            alert("用户名不能有特殊字符!");
            display[0].innerHTML = "用户名不能有特殊字符!";
            //清空输入框
            // fm.username.value = "";
            //光标聚焦到表单
            fm.username.focus();
            return false;
        }

        //密码验证
        if(fm.password.value.length < 6 || fm.password.value.length >20){
            alert("密码长度错误，不得小于6或大于20位！");
            fm.password.value = "";
            fm.password.focus();
            return false;
        }
        if(fm.confirm_pass.value != fm.password.value){
            alert("确认密码不一致！");
            fm.confirm_pass.value = "";
            fm.confirm_pass.focus();
            return false;
        }
        //密码提示验证
        if(fm.question.value.length < 3 || fm.question.value.length > 30){
            alert("密码问题长度有误!");
            fm.question.value = "";
            fm.question.focus();
            return false;
        }
        if(/[<>\,\.\?\!\@\#\$\%\^\&\*\(\)\《\》\;\:\'\"\ \   ]/.test(fm.question.value)){
            alert("密码问题不能有特殊字符!");
            //清空输入框
            fm.question.value = "";
            //光标聚焦到表单
            fm.question.focus();
            return false;
        }
        if(fm.answer.value.length < 1 || fm.answer.value.length > 30){
            alert("密码回答长度有误!");
            fm.answer.value = "";
            fm.answer.focus();
            return false;
        }
        if(/[<>\,\.\?\!\@\#\$\%\^\&\*\(\)\《\》\;\:\'\"\ \   ]/.test(fm.answer.value)){
            alert("密码回答不能有特殊字符!");
            //清空输入框
            fm.answer.value = "";
            //光标聚焦到表单
            fm.answer.focus();
            return false;
        }
        //邮件验证
        if(fm.email.value.length < 3 || fm.email.value.length > 30){
            alert("邮箱长度不得小于3或者大于20位!");
            fm.email.value = "";
            fm.email.focus();
            return false;
        }
        if(!(/^([a-zA-Z0-9_])+\@([a-zA-Z0-9_])+(.[a-zA-Z0-9_])+/.test(fm.email.value))){
            alert("邮箱格式错误!");
            //清空输入框
            fm.email.value = "";
            //光标聚焦到表单
            fm.email.focus();
            return false;
        }
        //qq验证
        if (fm.qq.value !=""){
            if(fm.qq.value.length < 3 || fm.answer.qq.length > 12){
                alert("QQ长度不得小于3或者大于10位!");
                fm.qq.value = "";
                fm.qq.focus();
                return false;
            }
            if(!/[1-9]{1,}([0-9]{5,11})/.test(fm.qq.value)){
                alert("QQ第一位不能为0!");
                fm.qq.value = "";
                fm.qq.focus();
                return false;
            }
        }

        //网址验证
        if(fm.myurl.value !=""){
            if(/^((https|http|ftp|rtsp|mms)?:\/\/)[^\s]+/.test(fm.myurl.value)){
                alert("个人网址格式不对!");
                fm.myurl.value = "";
                fm.myurl.focus();
                return false;
            }
        }
        //验证码验证
        if(fm.yzm.value.length != 4){
            alert("请确认验证码是4位!");
            fm.yzm.value = "";
            fm.yzm.focus();
            return false;
        }
        return true;
    }

}