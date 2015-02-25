<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    自动摘要 Auto-description v1.3 by Willin Kan.
// +----------------------------------------------------------------------+

/* Auto-description v1.3 by Willin Kan. */
function head_meta_desc() {
  global $s, $post;
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
    if( !empty( $post->post_excerpt ) ) {
      $text = $post->post_excerpt;
    } else {
      $text = $post->post_content;
    }
    $description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
    if ( !( $description ) ) $description = $blog_name . " - " . trim( wp_title('', false) );
} elseif ( is_home () )    { $description = $blog_name . " - " . get_bloginfo('description') . " 关注 WordPress"; // 首页要自己加
  } elseif ( is_tag() )      { $description = $blog_name . "有关 '" . single_tag_title('', false) . "' 的文章";
  } elseif ( is_category() ) { $description = $blog_name . "有关 '" . single_cat_title('', false) . "' 的文章";
  } elseif ( is_archive() )  { $description = $blog_name . "在: '" . trim( wp_title('', false) ) . "' 的文章";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索结果";
  } else { $description = $blog_name . "有关 '" . trim( wp_title('', false) ) . "' 的文章";
  }
  $description = mb_substr( $description, 0, 97, 'utf-8' ) . '..';
  echo "<meta name=\"description\" content=\"$description\" />\n";
}
add_action('wp_head', 'head_meta_desc');

/*
    用法:
    <title><?php wp_title(‘ – ‘, true, ‘right’); bloginfo(‘name’); if (is_home ()) echo ” – “, bloginfo(‘description’); if ($paged > 1) echo ‘ – Page ‘, $paged; ?></title>
*/
