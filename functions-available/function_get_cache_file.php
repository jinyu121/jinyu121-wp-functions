<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    获取远程内容，并缓存到本地。优先使用Redis缓存。
// +----------------------------------------------------------------------+

function get_remote_content($url) {
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);
        curl_close($ch);
    } else {
        $content = file_get_contents($url);
    }
    return $url;
}

function function_get_cache_file($target_url, $timeout, $key) {
    try {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $content = $redis->get($key);
        if ($content == false) {
            $content = get_remote_content($target_url);
            $redis->set($key, $content, $timeout);
        }
    }
    catch(Exception $e) {
        $key = sys_get_temp_dir() . $key; // 缓存文件路径
        $newfile = false;
        if (!file_exists($key)) {
            $newfile = true;
        } else {
            // 如果缓存文件过期，就删除
            if ((time() - filemtime($key)) >= $timeout) {
                @unlink($key);
                $newfile = true;
            }
        }
        if ($newfile) {
            $content = get_remote_content($target_url);
        } else {
            $content = file_get_contents($key);
        }
    }
    return $content;
}
