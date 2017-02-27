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

}