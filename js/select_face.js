/**
 * Created by Weng on 2017/2/25.
 */

window.onload=function(){
    //选择头像
    var images = document.getElementById("face");
    var face = images.getElementsByTagName("img");
    //opener表示父窗口
    var select_face = opener.document.getElementById("faceimg");
    var select_input = opener.document.getElementById("input_face");
    for(var i=0;i<face.length;i++){
        face[i].onclick = function(){

            //也可以用src,但是src是全地址
            select_face.src = this.alt;
            select_input.value = this.alt;
        }
    }
}