<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    Mini Gavatar Cache by Willin Kan.
// +----------------------------------------------------------------------+

/* Mini Gavatar Cache by Willin Kan. */
function my_avatar( $email, $size = '42', $default = '', $alt = false ) {
    $alt = (false === $alt) ? '' : esc_attr( $alt );
    $f = md5( strtolower( $email ) );
    $a = get_bloginfo('wpurl'). '/avatar/'. $f. '.jpg';
    $e = ABSPATH. 'avatar/'. $f. '.jpg';
    $t = 1209600; //設定14天, 單位:秒
    if ( empty($default) ) $default = get_bloginfo('template_directory'). '/img/default.jpg';
    if ( !is_file($e) || (time() - filemtime($e)) > $t ){ //當頭像不存在或文件超過14天才更新
        $r = get_option('avatar_rating');
    //$g = sprintf( "http://%d.gravatar.com", ( hexdec( $f{0} ) % 2 ) ). '/avatar/'. $f. '?s='. $size. '&d='. $default. '&r='. $r; // wp 3.0 的服務器
        $g = 'http://www.gravatar.com/avatar/'. $f. '?s='. $size. '&d='. $default. '&r='. $r; // 舊服務器 (哪個快就開哪個)
        copy($g, $e); $a = esc_attr($g);
    }
    if (filesize($e) < 500) copy($default, $e);
    $avatar = "<img title='{$alt}' alt='{$alt}' src='{$a}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
    return apply_filters('my_avatar', $avatar, $email, $size, $default, $alt);
}
