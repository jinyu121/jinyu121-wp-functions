<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    禁止在class里面出现用户名，防止登录名泄漏
// +----------------------------------------------------------------------+

// 禁止在class里面出现用户名
function disable_username_in_comment_class( $classes ) {
    foreach($classes as $key => $class ) {
        if(strstr($class, "comment-author-") || strstr($class, "author-")) {
            unset($classes[$key]);
        }
    }
    return $classes;
}
add_filter( 'comment_class', 'disable_username_in_comment_class' );
add_filter('body_class', 'disable_username_in_comment_class');
