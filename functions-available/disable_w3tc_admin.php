<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    禁止在 Admin Bar 中显示 W3TC 工具
// |    禁止 W3TC 在前台输出注释
// +----------------------------------------------------------------------+

function disable_w3tc_admin_bar() {
    global $wp_admin_bar;
//    if ( ! is_super_admin() ) {
    $wp_admin_bar->remove_menu('w3tc');
//    }
}
// Disable W3TC admin bar
add_action( 'admin_bar_menu','disable_w3tc_admin_bar',999);
// Disable W3TC footer comment
add_filter( 'w3tc_can_print_comment', '__return_false', 10, 1 );

