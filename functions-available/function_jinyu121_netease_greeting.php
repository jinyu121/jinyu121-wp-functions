<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    获取网易问候语，并使用redis缓存到本地。使用ajax调用，支持callback。
// |    用法： admin_url('admin-ajax.php?action=netease_greeting&callback=my_callback');
// +----------------------------------------------------------------------+

function function_jinyu121_netease_greeting(){
    $target_url = "https://ssl.mail.126.com/jy4-app.mail.163.com/jy4-app/xhr/mbox/greetings/get.do";
    $timeout    = 60 * 60 * 1;
    $key        = "jinyu121_netease_greeting";

    $content = function_get_cache_file($target_url, $timeout, $key);

    if (!empty($_REQUEST['callback'])) {
        $content = $_REQUEST['callback'] . "(" . $content . ")";
    }
    echo $content;
    wp_die();
}

add_action("wp_ajax_nopriv_netease_greeting", "function_jinyu121_netease_greeting");
add_action("wp_ajax_netease_greeting", "function_jinyu121_netease_greeting");

function jinyu121_apply_netease_greeting(){
?>
    <script type='text/javascript'>
    jQuery.ajax({
        url: "<?php echo admin_url('admin-ajax.php');?>",
        data: { "action": "netease_greeting" },
        cache: true, 
        dataType: 'json',
        success: function(data){
            var n = Math.trunc(Math.random()*data.data.contents.length);
            jQuery(".site-description").append(" - ").append(data.data.contents[n].replace("姓名，",""));
        }
    });
    </script>
<?php
}

add_action('wp_footer', 'jinyu121_apply_netease_greeting', 100);