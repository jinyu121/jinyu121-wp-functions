<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    自定义的表情(表情代码使用Wordpress默认的)
// +----------------------------------------------------------------------+

function function_custom_smilies ($img_src, $img, $WP_PLUGIN_URL){
    return $siteurl.WP_PLUGIN_URL .'/jinyu121-wp-functions/functions-enabled/smilies/'.$img;
}
add_filter('smilies_src','function_custom_smilies',1,10);
