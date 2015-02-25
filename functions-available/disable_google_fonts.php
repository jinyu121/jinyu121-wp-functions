<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    禁用Google字体
// +----------------------------------------------------------------------+

class disable_google_fonts {
    public function __construct() {
        add_filter( 'gettext_with_context', array( $this, 'disable_open_sans' ), 888, 4 );
    }
    public function disable_open_sans( $translations, $text, $context, $domain ) {
        if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
            $translations = 'off';
        }
        return $translations;
    }
}
$google_fonts = new disable_google_fonts();
