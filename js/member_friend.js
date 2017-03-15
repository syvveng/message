/**
 * Created by Weng on 2017/3/12.
 */
window.onload = function () {
  var chkall = document.getElementById('all');
  var checkthis = document.getElementsByName('checkthis[]');
  var fm = document.getElementsByTagName('form')[0];
  chkall.onclick = function () {
        for(var i=0;i<checkthis.length;i++) {
            checkthis[i].checked = chkall.checked;
        }
  };
  fm.onsubmit = function () {
    if(confirm("你确定要添加为好友吗?")){
        return true;
    }else{
        return false;
    }
  };
};