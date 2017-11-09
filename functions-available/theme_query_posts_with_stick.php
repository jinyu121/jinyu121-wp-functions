<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    获取X篇文章，置顶在前，其余在后。返回结果是一个array，需要遍历
// +----------------------------------------------------------------------+

if ( !function_exists('query_posts_with_stick') ) {
    function query_posts_with_stick($total = 4, $category = 0) {
        // Initialize
        $ret = array();
        $sticky = get_option('sticky_posts');
        $args = array(
            'post_type' => 'post',
            'showposts' => $total,
        );
        if ($category){
            $args['category__in'] = $category;
        }
        // Get sticky posts
        $args_sticky = $args + array(
            'post__in' => $sticky
        );
        $posts = new WP_Query($args_sticky);
        array_push($ret,$posts);

        // Are there enough posts?
        if ($posts->post_count < $total) {
            $nonstickyTotal = $total - $posts->post_count;
            $args_no_sticky = $args + array(
                'post__not_in' => $sticky,
                'showposts' =>$nonstickyTotal
            );
            $posts_nos = new WP_Query($args_no_sticky);
            array_push($ret,$posts_nos);
        }
        return $ret;
    }
}
