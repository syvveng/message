/**
 * Created by Weng on 2017/3/12.
 */
window.onload = function () {
    var ret = document.getElementById('return');
    var del = document.getElementById('delete');
    //返回列表
    ret.onclick = function () {
        history.back();
    }
    //删除操作
    del.onclick = function () {
        if(confirm("你确定要删除这条信息吗?")){
            location.href = '?action=delete&id='+this.name;
        }
    }
}