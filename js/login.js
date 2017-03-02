/**
 * Created by Weng on 2017/3/2.
 */
window.onload = function(){

    //刷新验证码
    var code = document.getElementById("code");
    code.onclick = function(){
        this.src ='code.php?tm='+Math.random();
    };
    /**
     * getElementsByTagName("form")得到的是数组
     * 这里只有一个form，所有长度为1
     */
    var fm = document.getElementsByTagName("form")[0];
    var val = document.getElementsByTagName("input");

   fm.onsubmit = function(){
       if(!val[0].value){
           alert("请输入用户名!");
           val[0].focus();
           return false;
       }
       if(!val[1].value){
           alert("请输入密码!");
           val[1].focus();
           return false;
       }
       if(val[6].value.length != 4){
           alert("请确认验证码!");
           val[6].focus();
           return false;
       }

       return true;
   }

}