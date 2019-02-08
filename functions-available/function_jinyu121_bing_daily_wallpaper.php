<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    获取网易问候语。使用ajax调用，支持callback。
// |    用法： admin_url('admin-ajax.php?action=bing_daily_wallpaper&callback=my_callback');
// +----------------------------------------------------------------------+

function function_jinyu121_bing_daily_wallpaper(){
    $target_url = "http://www.bing.com/HPImageArchive.aspx?format=js&idx=-1&n=1";
    $timeout    = 60 * 60 * 6;
    $key        = "jinyu121_bing_daily_wallpaper";

    $content = function_get_cache_file($target_url, $timeout, $key);

    if (!empty($_REQUEST['callback'])) {
        $content = $_REQUEST['callback'] . "(" . $content . ")";
    }
    echo $content;
    die();
}

add_action("wp_ajax_bing_daily_wallpaper", "function_jinyu121_bing_daily_wallpaper");

function jinyu121_apply_bing_wallpaper(){
?>
    <script type='text/javascript'>
    jQuery.ajax({
        url: "<?php echo admin_url('admin-ajax.php');?>",
        data: { "action": "bing_daily_wallpaper" },
        cache: true,
        dataType: 'json',
        success: function(data){ 
            jQuery('body').css({
                "background-image": "url(//www.bing.com"+data.images[0].url+")",
                "background-position": "center", 
                "background-size": "cover",
                "background-repeat": "no-repeat", 
                "background-attachment": "fixed"
            }); 
        }
    });
    </script>
<?php
}
add_action('wp_footer', 'jinyu121_apply_bing_wallpaper', 99);