<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    对Wordpress的一些设置
// +----------------------------------------------------------------------+

//禁用历史版本
function disable_autosave() {
    wp_deregister_script('autosave');
}
remove_action('pre_post_update', 'wp_save_post_revision');
add_action('wp_print_scripts', 'disable_autosave');
if(!defined('WP_POST_REVISIONS')){
    define('WP_POST_REVISIONS', false);
}

//禁用半角符号自动转换为全角
remove_filter('the_content', 'wptexturize');
