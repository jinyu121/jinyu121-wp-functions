<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    开启gzip压缩输出 by Willin Kan.
// +----------------------------------------------------------------------+

function function_enable_gzip() {
    if ($is_localhost == true)
        return false;
    // Dont use on Admin HTML editor
    if ( strstr($_SERVER['REQUEST_URI'], '/js/tinymce') )
        return false;
    // Can't use zlib.output_compression and ob_gzhandler at the same time
    if ( ( ini_get('zlib.output_compression') == 'On' || ini_get('zlib.output_compression_level') > 0 ) || ini_get('output_handler') == 'ob_gzhandler' )
        return false;
    // Load HTTP Compression if correct extension is loaded
    if (extension_loaded('zlib') && !ob_start('ob_gzhandler'))
        ob_start();
}
add_action('init', 'function_enable_gzip');
