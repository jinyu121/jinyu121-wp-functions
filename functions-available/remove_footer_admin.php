<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    更改仪表盘页脚文本
// +----------------------------------------------------------------------+

function remove_footer_admin () {
    echo "Your own text";
}

add_filter('admin_footer_text', 'remove_footer_admin');
