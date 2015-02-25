<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    Mini Pagenavi v1.0 by Willin Kan.
// +----------------------------------------------------------------------+

/* Mini Pagenavi v1.0 by Willin Kan. */
function pagenavi( $p = 2 ) { // 取當前頁前後各 2 頁
  if ( is_singular() ) return; // 文章與插頁不用
  global $wp_query, $paged;
  $max_page = $wp_query->max_num_pages;
  if ( $max_page == 1 ) return; // 只有一頁不用
  if ( empty( $paged ) ) $paged = 1;
  // echo '<span class="pages">Page: ' . $paged . ' of ' . $max_page . ' </span> '; // 頁數
  if ( $paged > $p + 1 ) p_link( 1, __('first') );
  if ( $paged > $p + 2 ) echo "<span class='dots'> ... </span>";
  for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { // 中間頁
    if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );
  }
  if ( $paged < $max_page - $p - 1 ) echo "<span class='dots'> ... </span>";
  if ( $paged < $max_page - $p ) p_link( $max_page, __('last') );
}
function p_link( $i, $title = '' ) {
  if ( $title == '' ) $title = __('Pages')." {$i}";
  echo "<a class='page-numbers' href='", esc_attr( get_pagenum_link( $i ) ), "' title='{$title}'>{$i}</a> ";
}
