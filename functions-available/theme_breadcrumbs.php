<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    面包屑导航
// +----------------------------------------------------------------------+

function theme_breadcrumbs(){
    $sep=" » ";
    echo '<div class="breadcrumb no-margin">当前位置：<a href="'. home_url() .'" title="首页">首页</a>';
    if (!is_attachment() ){
        if ( is_category() ){    //如果是栏目页面
            global $cat;
            echo $sep . get_category_parents($cat, true, $sep) . '文章列表';
        }elseif ( is_page() ){    //如果是自定义页面
            echo $sep . get_the_title() ;
        }elseif ( is_single() ){    //如果是文章页面
            $categories = get_the_category();
            $cat = $categories[0];
            echo $sep . get_category_parents($cat->term_id, true, $sep, false) . cut_str(get_the_title(),70);
        }elseif ( is_search() ){    //如果是搜索页面
            echo $sep . "搜索结果";
        }
    }else{
        echo $sep .'附件列表';
    }
    echo '</div>';
}
