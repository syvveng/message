/**
 * Created by Weng on 2017/2/24.
 */
window.onload=function(){

    //点击头像选择页面的任意一张图片，让其显示在注册页面的头像区域
    var image = document.getElementById("img");
    var images = image.getElementsByTagName("img");
    //opener表示父窗口
    var chooseface = opener.document.getElementById("faceimg");
    // alert(chooseface.src);
    // alert(images.length);
    // alert(images[0].src);
    for(var i=0;i<images.length;i++) {

        //方法一
        // images[i].index = i;
        // images[i].onclick=function(){
        //    chooseface.src = images[this.index].src;
        //    // alert(chooseimg);
        //}

                //方法二
        images[i].onclick=function(){
            chooseface.src = this.src;
        }

}