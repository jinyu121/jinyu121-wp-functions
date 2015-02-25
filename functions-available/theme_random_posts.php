<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    获取某分类下随机文章
// +----------------------------------------------------------------------+

function wp_random_posts($howMuch = 5){
    $cat = get_the_category();
    foreach($cat as $key=>$category){
        $catid = $category->term_id;
    }
    $args = array('orderby' => 'rand','showposts' => $howMuch,'cat' => $catid );
    $query_posts = new WP_Query();
    $query_posts->query($args);
    while ($query_posts->have_posts()) : $query_posts->the_post();
        echo "<li><a href=\"";
        the_permalink();
        echo "\">".cut_str(get_the_title(),15)."</a></li>";
    endwhile;
}
