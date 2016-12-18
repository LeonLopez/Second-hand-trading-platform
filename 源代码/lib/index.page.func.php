<?php


function showPage($page,$totalPage,$where=null,$sep="&nbsp;"){
    $where=($where==null)?null:"&".$where;
    $url = $_SERVER ['PHP_SELF'];
    $index = ($page == 1) ? "<a class='current' href='javascript:;'>首页</a>" : "<a href='{$url}?page=1{$where}'>首页</a>";
    $last = ($page == $totalPage) ? "<a class='current' href='javascript:;'>尾页</a>" : "<a href='{$url}?page={$totalPage}{$where}'>尾页</a>";
    $prevPage=($page>=1)?$page-1:1;
    $nextPage=($Page>=$totalPage)?$totalPage:$page+1;
    $prev = ($page == 1) ? "<a class='current' href='javascript:;'>上一页</a>" : "<a href='{$url}?page={$prevPage}{$where}'>上一页</a>";
    $next = ($page == $totalPage) ? "<a class='current' href='javascript:;'>下一页</a>" : "<a href='{$url}?page={$nextPage}{$where}'>下一页</a>";
    
    for($i = 1; $i <= $totalPage; $i ++) {
        //当前页无连接
        if ($page == $i) {
            $p .= "<a class='current' href='javascript:;'>{$i}</a>";
        } else {
            $p .= "<a href='{$url}?page={$i}{$where}'>{$i}</a>";
        }
    }
    $pageStr=$index .$sep. $prev.$sep . $p.$sep . $next.$sep . $last;
    return $pageStr;
}