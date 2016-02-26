<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    更改JQ库 WordPress script loading by Willin Kan.
// +----------------------------------------------------------------------+

function function_change_jquery(){
    if ( !is_admin() ) { // 後台不用
        if ( $localhost == 0 ) { // 本地調試不用
            function my_init_method() {
                wp_deregister_script( 'jquery' ); // 取消原有的 jquery 定義
                wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.2.3/jquery.min.js', '', '1.2.3' ); // 自定義 jquery 文件位址
            }
            add_action('init', 'my_init_method'); // 加入功能, 前台使用 wp_enqueue_script( '名稱' ) 加載
      }
      wp_enqueue_script( 'a9', get_bloginfo('template_directory').'/a9.js', array('jquery'), '1.9.1', 0 ); // 全新自定義 script, 同時加載
    }
}
add_action('init', 'function_change_jquery');
