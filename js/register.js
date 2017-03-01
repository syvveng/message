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
    fm.onsubmit = function () {

        fm.onmouseout = function(){
            //用户名验证
            if(fm.username.value.length < 3 ||fm.username.value.length > 20){
                alert("用户名长度错误，不得小于3或大于20位!");
                //清空输入框
                fm.username.value = "";
                //光标聚焦到表单
                fm.username.focus();
                return false;
            }
            if(/[<>\,\.\?\!\@\#\$\%\^\&\*\(\)\《\》\;\:\'\"\ \   ]/.test(fm.username.value)){
                alert("用户名不能有特殊字符!");
                //清空输入框
                fm.username.value = "";
                //光标聚焦到表单
                fm.username.focus();
                return false;
            }
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
        if(fm.question.value.length < 3 || fm.question.value.length > 20){
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
        if(fm.answer.value.length < 3 || fm.answer.value.length > 30){
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
        if(fm.email.value.length < 3 || fm.email.value.length > 20){
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
            if(fm.qq.value.length < 3 || fm.answer.qq.length > 10){
                alert("QQ长度不得小于3或者大于10位!");
                fm.qq.value = "";
                fm.qq.focus();
                return false;
            }
        }

        //网址验证

        //验证码验证
        if(fm.yzm.value.length < 3 || fm.yzm.email.length > 20){
            alert("请确认验证码是4位!");
            fm.yzm.value = "";
            fm.yzm.focus();
            return false;
        }
        return true;
    }

}