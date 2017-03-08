<?php
/**
 * Message Version0.1
 * ===============================
 * Author: weng
 * Date: 2017/3/8
 * Time: 18:14
 */

if(!defined("IN_TG")){
    exit("Access Defined!");
}

/**
 * @param $_sql数据库语句
 * @param $_size每页显示数量
 * $pagesize每页显示数量
 * $num数据总条数
 * $page当前页
 * $page_start表示从第$page_start+1条开始取值
 * $pagenum页数
 * mysqli_num_rows取得查询结果的数量
 * ceil() 进一法取整
 * intval()变量转成整数类型
 */
function _page($_sql,$_size){
    //必须全局，否则无法访问
    global $page,$pagenum,$num,$pagesize,$page_start;

    if(isset($_GET['page'])){
        $page = $_GET['page'];
        if(empty($_GET['page']) || !is_numeric($_GET['page']) || $page < 0){
            $page = 1;
        }else{
            $page = intval($page);
        }
    }else{
        $page = 1;
    }
//$page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $pagesize = $_size;
    $num = mysqli_num_rows($_sql);
    if($num == 0){
        $pagenum = 1;
    }else{
        $pagenum = ceil($num/$pagesize);
    }
    if($page > $pagenum){
        $page = $pagenum;
    }
    $page_start = ($page-1)*$pagesize;
}

/**
 * @param $_type表示分页类型，1：表示数字类型；2：表示文本类型
 */
function _paging($_type){
    //必须全局，否则无法访问
    global $page,$pagenum,$num;

    if($_type == 1){
       echo  '<div class="pagenum">';
       echo '<ul>';
        for($i=0;$i<$pagenum;$i++){
            if($page == ($i+1)){
                echo '<a href="'.SCRIPT.'.php?page='.($i+1).'"><li class="selected">'.($i+1).'</li></a>';
            }else{
                echo '<a href="'.SCRIPT.'.php?page='.($i+1).'"><li>'.($i+1).'</li></a>';
            }
        }
       echo '</ul>';
       echo '</div>';
    }
    elseif($_type == 2){

        echo '<div class="pagetext">';
        echo '<ul>';
        echo '<li>'.$page.'/'.$pagenum.'页 |</li>';
        echo '<li>共'.$num.'个会员 |</li>';

        if($page == 1){
            echo '<li>首页 |</li>';
            echo '<li>上一页 |</li>';
        }else{
            echo '<li><a href="'.SCRIPT.'.php">首页</a> |</li>';
            echo '<li><a href="'.SCRIPT.'.php?page='.($page-1).'">上一页</a> |</li>';
        }
        if($page == $pagenum){
            echo '<li>下一页 |</li>';
            echo '<li>尾页</li>';
        }else{
            echo '<li><a href="'.SCRIPT.'.php?page='.($page+1).'">下一页</a> |</li>';
            echo '<li><a href="'.SCRIPT.'.php?page='.$pagenum.'">尾页</a></li>';
        }
        echo '</ul>';
        echo '</div>';
    }
}
?>