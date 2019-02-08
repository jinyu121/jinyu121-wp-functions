<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    标签转为关键词
// +----------------------------------------------------------------------+

function function_tags_to_keywords() {
    global $s, $post;
    $keywords = '';
    if (is_single()) { //如果是文章页，关键词则是：标签+分类ID
        if (get_the_tags($post->ID)) {
            foreach (get_the_tags($post->ID) as $tag)
                $keywords .= $tag->name . ', ';
        }
        foreach (get_the_category($post->ID) as $category)
            $keywords .= $category->cat_name . ', ';
        $keywords = substr_replace($keywords, '', -2);
    } elseif (is_home()) {
        $keywords = '我是主页关键词'; //主页关键词设置
    } elseif (is_tag()) { //标签页关键词设置
        $keywords = single_tag_title('', false);
    } elseif (is_category()) { //分类页关键词设置
        $keywords = single_cat_title('', false);
    } elseif (is_search()) { //搜索页关键词设置
        $keywords = esc_html($s, 1);
    } else { //默认页关键词设置
        $keywords = trim(wp_title('', false));
    }
    if ($keywords) { //输出关键词
        echo "\n";
    }
}

add_action('wp_head', function_tags_to_keywords);
