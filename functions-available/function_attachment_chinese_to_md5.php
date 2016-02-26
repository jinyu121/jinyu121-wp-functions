<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |   中文附件名修改为文件名的MD5值（为了防止在某些服务器上文件名乱码）
// +----------------------------------------------------------------------+

function function_attachment_chinese_to_md5($filename) {
    $parts = explode('.', $filename);
    $filename = array_shift($parts);
    $extension = array_pop($parts);
    foreach ( (array) $parts as $part)
    $filename .= '.' . $part;
    if(preg_match('/[一-龥]/u', $filename)){
        $filename = md5($filename);
        // $filename = time();
    }
    $filename .= '.' . $extension;
    return $filename ;
}
add_filter('sanitize_file_name', 'function_attachment_chinese_to_md5', 5,1);
