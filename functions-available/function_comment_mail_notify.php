<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    comment_mail_notify v1.0 by willin kan.
// +----------------------------------------------------------------------+

/* comment_mail_notify v1.0 by willin kan. (有勾選欄, 由訪客決定) */
function function_comment_mail_notify($comment_id) {
    $admin_notify = '1'; // admin 要不要收回覆通知 ( '1'=要 ; '0'=不要 )
    $admin_email = get_bloginfo ('admin_email'); // $admin_email 可改為你指定的 e-mail.
    $comment = get_comment($comment_id);
    $comment_author_email = trim($comment->comment_author_email);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    global $wpdb;
    if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
        $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
    if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
        $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
    $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
    $spam_confirmed = $comment->comment_approved;
    if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
        $wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 發出點, no-reply 可改為可用的 e-mail.
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '您在 [' . get_option("blogname") . '] 的留言有了回應';
        $message = '
        <div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px; border-radius:5px;">
            <p>' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
            <p>您曾在《' . get_the_title($comment->comment_post_ID) . '》的留言:<br />'. trim(get_comment($parent_id)->comment_content) . '</p>
            <p>' . trim($comment->comment_author) . ' 給您的回應:<br />'. trim($comment->comment_content) . '<br /></p>
            <p>您可以點擊 <a href="' . esc_attr(get_comment_link($parent_id, array('type' => 'comment'))) . '">查看回應完整內容</a></p>
            <p>歡迎再度光臨 <a href="' . get_option('home') . '">' . get_option('blogname') . '</a></p>
            <p>(此郵件由系統自動發出, 請勿回覆.)</p>
        </div>';
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
        //echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
    }
}
add_action('comment_post', 'function_comment_mail_notify');
// -- END ----------------------------------------
