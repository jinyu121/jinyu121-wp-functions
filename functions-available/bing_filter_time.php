<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    WordPress 修改时间的显示格式为几天前
// +----------------------------------------------------------------------+

function bing_filter_time(){
    global $post ;
    $to = time();
    $from = get_the_time('U') ;
    $diff = (int) abs($to - $from);
    if ($diff <= 3600) {
        $mins = round($diff / 60);
        if ($mins <= 1) {
            $mins = 1;
        }
        $time = sprintf(_n('%s 分', '%s 分种', $mins), $mins) . __( '前' , 'Bing' );
    }
    else if (($diff <= 86400) && ($diff > 3600)) {
        $hours = round($diff / 3600);
        if ($hours <= 1) {
            $hours = 1;
        }
        $time = sprintf(_n('%s 小时', '%s 小时', $hours), $hours) . __( '前' , 'Bing' );
    }
    elseif ($diff >= 86400) {
        $days = round($diff / 86400);
        if ($days <= 1) {
            $days = 1;
            $time = sprintf(_n('%s 天', '%s 天', $days), $days) . __( '前' , 'Bing' );
        }
        elseif( $days > 29){
            $time = get_the_time(get_option('date_format'));
        }
        else{
            $time = sprintf(_n('%s 天', '%s 天', $days), $days) . __( '前' , 'Bing' );
        }
    }
    return $time;
}
add_filter('the_time','bing_filter_time');
