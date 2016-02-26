<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    WordPress 修改时间的显示格式为几天前
// +----------------------------------------------------------------------+

function theme_time_diff($time_type) {
    switch ($time_type) {
        case 'comment':
            $time_diff = current_time('timestamp') - get_comment_time('U');
            if ($time_diff <= 604800) echo human_time_diff(get_comment_time('U') , current_time('timestamp')) . '前';
            else printf(__('%1$s at %2$s') , get_comment_date() , get_comment_time());
            break;

        case 'post';
        $time_diff = current_time('timestamp') - get_the_time('U');
        if ($time_diff <= 43200) echo '<span class="red">NEW! </span>';
        elseif ($time_diff <= 604800) echo human_time_diff(get_the_time('U') , current_time('timestamp')) . '前';
        else the_time('Y-m-d');
        break;
    }
}
