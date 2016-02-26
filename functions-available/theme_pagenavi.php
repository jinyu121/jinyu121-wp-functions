<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    Wordpress 分页函数
// +----------------------------------------------------------------------+

function theme_pagenavi($range = 5){
    global $paged, $wp_query;
    if ( !$max_page ) {
        $max_page = $wp_query->max_num_pages;
    }
    echo "<div>";
    echo "<ul class=\"list list-inline list-unstyled pageindex\">";
    if($max_page > 1){
        if(!$paged){
            $paged = 1;
        }
        if($paged != 1){
            echo "<li><a href='" . get_pagenum_link(1) . "' class='last' title='跳转到首页'> 首页 </a></li>";
        }
        if($max_page > $range){
            if($paged < $range){
                for($i = 1; $i <= ($range + 1); $i++){
                    if($i==$paged) echo "<li><a class='current'>$i</a></li>";
                    else echo "<li><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
                }
            }
            elseif($paged >= ($max_page - ceil(($range/2)))){
                for($i = $max_page - $range; $i <= $max_page; $i++){
                    if($i==$paged) echo "<li><a class='current'>$i</a></li>";
                    else echo "<li><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
                }
            }
            elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
                for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
                    if($i==$paged) echo "<li><a class='current'>$i</a></li>";
                    else echo "<li><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
                }
            }
        }
        else{
            for($i = 1; $i <= $max_page; $i++){
                if($i==$paged) echo "<li><a class='current'>$i</a></li>";
                else echo "<li><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
            }
        }
        if($paged != $max_page){
            echo "<li><a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 末页 </a></li>";
        }
    }
    echo "</ul>";
    echo "</div>";
}
