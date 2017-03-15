/**
 * Created by Weng on 2017/3/11.
 */
window.onload=function(){
    var message = document.getElementsByName('message');
    var friend = document.getElementsByName("friend");
    for(var i=0;i<message.length;i++){
        message[i].onclick=function(){
            centerWindow('message.php?id='+this.title,'message',400,300);
        }
    }
    for(var i=0;i<friend.length;i++){
        friend[i].onclick=function(){
            centerWindow('friend.php?id='+this.title,'friend',400,300);
        }
    }
};

function centerWindow(url,name,width,height) {
    var left = (screen.width-width)/2;
    var top = (screen.height-height)/2;
    window.open(url,name,'width='+width+',height='+height+',top='+top+',left='+left);
}