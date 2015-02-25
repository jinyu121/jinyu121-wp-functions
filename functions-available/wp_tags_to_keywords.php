<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    自动关键词 Auto-keywords v1.6 by Willin Kan
// +----------------------------------------------------------------------+

/* Auto-keywords v1.6 by Willin Kan. */
function tags_category_to_keywords() {
    global $s, $post;
    $keywords = ”;
    if ( is_single() ) {
            if ( get_the_tags( $post->ID ) ) {
                    foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ‘, ‘;
            }
            foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ‘, ‘;
            $keywords = substr_replace( $keywords, “” , -2 );
    } elseif ( is_home () ) {
        $keywords = “你的关键字”; // 首頁要自己加
    } elseif ( is_tag() ) {
        $keywords = single_tag_title(”, false);
    } elseif ( is_category() ) {
        $keywords = single_cat_title(”, false);
    } elseif ( is_search() ) {
        $keywords = esc_html( $s, 1 );
    } else {
        $keywords = trim( wp_title(”, false) );
    }
    if ( $keywords ) {
        echo “\n”;
    }
}
add_action(‘wp_head’, ‘tags_category_to_keywords’);
