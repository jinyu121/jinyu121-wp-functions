<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    <<小牆>> Anti-Spam v1.9 by Willin Kan.
// +----------------------------------------------------------------------+


function willin_kan_anti_spam(){
    class anti_spam {
        // 增加：使用一个peivate属性，方便修改
        private $w='Spam_G0_D1e';
        //建立
        function anti_spam() {
            if ( !is_user_logged_in() ) {
                add_action('template_redirect', array($this, 'w_tb'), 1);
                add_action('pre_comment_on_post', array($this, 'gate'), 1);
                add_action('preprocess_comment', array($this, 'sink'), 1);
            }
        }
        //設欄位
        function w_tb() {
            if ( is_singular() ) {
                ob_start(create_function('$input', 'return preg_replace("#textarea(.*?)name=([\"\'])comment([\"\'])(.+)/textarea>#",
                "textarea$1name=$2'.$this->w.'$3$4/textarea><textarea name=\"comment\" cols=\"60\" rows=\"4\" style=\"display:none\"></textarea>", $input);') );
            }
        }
        //檢查
        function gate() {
            // ( !empty($_POST[$this->w]) && empty($_POST['comment']) ) ? $_POST['comment'] = $_POST[$this->w] : $_POST['spam_confirmed'] = 1;
            // 增加：对客户端的排除
            ( !empty($_POST[$this->w]) && empty($_POST['comment']) || wp_is_mobile() ) ? $_POST['comment'] = $_POST[$this->w] : $_POST['spam_confirmed'] = 1;
        }
        //處理
        function sink( $comment ) {
            if ( !empty($_POST['spam_confirmed']) ) {
                //方法一:直接擋掉, 將 die(); 前面兩斜線刪除即可.
                die();
                //方法二:標記為spam, 留在資料庫檢查是否誤判.
                //add_filter('pre_comment_approved', create_function('', 'return "spam";'));
                //$comment['comment_content'] = "[ 小牆判斷這是Spam! ]\n" . $comment['comment_content'];
            }
            return $comment;
        }
    }
    $anti_spam = new anti_spam();
}
add_action('init', 'willin_kan_anti_spam');
