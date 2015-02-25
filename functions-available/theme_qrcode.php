<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    获取文章页面的二维码
// +----------------------------------------------------------------------+

function lms_getqrcode($size = 200) {
    if ($size > 500) $size = 500;
    if ($size < 64) $size = 64;
    if (!preg_match("/^([0-9]+)$/i", $size)) return '';
    echo '<img src="http://chart.googleapis.com/chart?cht=qr&chs=' . $size . 'x' . $size . '&choe=UTF-8&chld=L|4&chl=' . get_permalink() . '" alt="二维码"/>';
    return $size;
}
