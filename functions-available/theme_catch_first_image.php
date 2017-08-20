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

function theme_catch_first_image($default=false) {
    global $post, $posts;
    ob_start();
    ob_end_clean();
    $doc = new DOMDocument();
    @$doc->loadHTML($post->post_content);
    $img = $doc->getElementsByTagName('img');
    if($img->length > 0){
        return $img->item(0)->getAttribute('src');
    }
    return $default;
}
