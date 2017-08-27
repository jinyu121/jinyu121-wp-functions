<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    抓取文章的第一个图片当做缩略图
// +----------------------------------------------------------------------+

if (!function_exists("theme_catch_first_image")) {
    function __jinyu121_first_image($html)
    {
        if (empty($html)) {
            return false;
        }
        $doc = new DOMDocument();
        @$doc->loadHTML($html);
        $img = $doc->getElementsByTagName('img');
        if ($img->length > 0) {
            return $img->item(0)->getAttribute('src');
        }
        return false;
    }

    function theme_catch_first_image($default=false)
    {
        global $post;
        ob_start();
        ob_end_clean();
        $img = __jinyu121_first_image($post->post_excerpt);
        if (empty($img)) {
            $img = __jinyu121_first_image($post->post_content);
            if (empty($img)) {
                $img = $default;
            }
        }

        return $img;
    }
}
