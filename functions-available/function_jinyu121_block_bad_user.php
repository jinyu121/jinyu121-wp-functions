<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    如果 IP 在 redis 黑名单中，那么直接 die 掉。有效期为一个月。
// |    必须启用 php_redis 否则会出错。
// |    配合boomb使用。将 functions-enabled/boomb/boomb.php 软链接为常用
// |    php 文件（例如 phpinfo.php ）即可。
// +----------------------------------------------------------------------+

include_once( "boomb/boomb_functions.php" );
function function_jinyu121_block_bad_user() {
    $ip = jinyu121_boomb_get_ip();
    if ($ip != 'Unknow_IP'){
        $pre = jinyu121_boomb_get_pre();
        $redis = jinyu121_boomb_get_redis_instance();
        $pri_set_key = jinyu121_boomb_get_pri_key($ip);
        if ($redis->exists($pri_set_key)){
            $redis->EXPIRE($pri_set_key, 2592000);
            wp_die("Oooops~ Somethong wrong~");
        }
    }
}
add_action('init', 'function_jinyu121_block_bad_user');
