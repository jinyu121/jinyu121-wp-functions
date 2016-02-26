<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    评论检查
// +----------------------------------------------------------------------+

function function_comment_check_name_and_mail() {
    global $wpdb;
    $comment_author = (isset($_POST['author'])) ? trim(strip_tags($_POST['author'])) : null;
    $comment_author_email = (isset($_POST['email'])) ? trim($_POST['email']) : null;
    if (!$comment_author || !$comment_author_email) {
        return;
    }
    $result_set = $wpdb->get_results("SELECT display_name, user_email FROM $wpdb->users WHERE display_name = '" . $comment_author . "' OR user_email = '" . $comment_author_email . "'");
    if ($result_set) {
        if ($result_set[0]->display_name == $comment_author) {
            die(__('大丈夫行不改名坐不改姓，何必冒充他人？！'));
        } else {
            die(__('你的邮箱可能是注册用户邮箱，须登录后评论！'));
        }
        fail($errorMessage);
    }
}
add_action('pre_comment_on_post', 'function_comment_check_name_and_mail');
