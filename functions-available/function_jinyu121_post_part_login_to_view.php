<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    文章部分内容登录可见
// +----------------------------------------------------------------------+

// 主要部分
function function_jinyu121_post_part_login_to_view($content)
{
	if (preg_match_all('/<!--hide-->([\s\S]*?)<!--\/hide-->/i', $content, $hide_words))
	{
		if( !is_user_logged_in() )
		{
			$content = str_replace($hide_words[0], "", $content);
		}
	}
	return $content;
}

add_filter('the_content', 'function_jinyu121_post_part_login_to_view');


// 在编辑器中添加按钮
function function_jinyu121_post_part_login_to_view_quicktags() {
    if (wp_script_is('quicktags')) {
?>
    <script type="text/javascript">
    QTags.addButton( 'hide', 'hide', "<!--hide-->", "<!--/hide-->" );
    </script>
<?php
    }
}

add_action('admin_print_footer_scripts', 'function_jinyu121_post_part_login_to_view_quicktags');

