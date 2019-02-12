<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    本地问候语
// +----------------------------------------------------------------------+

function function_jinyu121_netease_greeting(){
	$json_greeting = json_decode(file_get_contents(dirname( __FILE__ )."/data_greeting.json") , true);
	$date_select = (date("l") == "Saterday" || date("l") == "Sunday") ? "WEEKEND" : "WEEKDAY";
	$data_part = $json_greeting[$date_select];
    $hour = intval(date('H'));
	$greetings = [];
	foreach(array_keys($data_part) as $hour_range) {
		$hour_range_exp = explode("-",$hour_range);
		$hour_sta = intval($hour_range_exp[0]);
		$hour_end = intval($hour_range_exp[1]);
		if (($hour_sta < $hour_end && ($hour_sta <= $hour && $hour < $hour_end)) || ($hour_sta > $hour_end && ($hour_sta >= $hour || $hour < $hour_end))) {
			$greetings = array_merge($greetings, $data_part[$hour_range]);
		}
	}

	$json = ["status" => "OK", "content" => trim($greetings[array_rand($greetings)], "。") ];
	echo json_encode($json);;
	wp_die();
}

add_action("wp_ajax_nopriv_netease_greeting", "function_jinyu121_netease_greeting");
add_action("wp_ajax_netease_greeting", "function_jinyu121_netease_greeting");

function jinyu121_apply_netease_greeting()
{
?>
    <script type='text/javascript'>
    jQuery.ajax({
        url: "<?php
	echo admin_url('admin-ajax.php'); ?>",
        data: { "action": "netease_greeting" },
        cache: true, 
        dataType: 'json',
        success: function(data){
            jQuery(".site-description").append(" - ").append(data.content);
        }
    });
    </script>
<?php
}

add_action('wp_footer', 'jinyu121_apply_netease_greeting', 100);