<?php
function jinyu121_boomb_get_pre(){
    return "balabalaba";
}
function jinyu121_boomb_get_redis_instance(){
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    return $redis;
}
function jinyu121_boomb_get_tmp_key($ip){
    $pre = jinyu121_boomb_get_pre();
    return $pre."_set_tmp_".$ip;
}
function jinyu121_boomb_get_pri_key($ip){
    $pre = jinyu121_boomb_get_pre();
    return $pre."_set_pri_".$ip;
}
function jinyu121_boomb_get_ip(){
	$ip='Unknow_IP';
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		return jinyu121_boomb_is_ip($_SERVER['HTTP_CLIENT_IP'])?$_SERVER['HTTP_CLIENT_IP']:$ip;
	}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		return jinyu121_boomb_is_ip($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:$ip;
	}else{
		return jinyu121_boomb_is_ip($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:$ip;
	}
}
function jinyu121_boomb_is_ip($str){
	$is_ipv4 = $ret = filter_var($str, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    $is_ipv6 = filter_var($str, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
	return $is_ipv4 || $is_ipv6;
}
function jinyu121_boomb_log_ip_to_file($ip){
    $log_dir = dirname(__FILE__)."/.log/";
    //if (!file_exists($log_dir)){
    mkdir($log_dir);
    //}
    $myfile = fopen($log_dir."ScannerLog.log", "a+");
    $text = "[".strftime("%Y-%m-%d %X")."][".$ip."]".$_SERVER['HTTP_USER_AGENT'] ."\n";
    fwrite($myfile, $text);
    fclose($myfile);
}
function jinyu121_boomb_log_ip_to_redis($ip){
    $redis = jinyu121_boomb_get_redis_instance();
    // 制作临时 key
    $tmp_set_key = jinyu121_boomb_get_tmp_key($ip);
    // 数值 +1
    $counter = (int)$redis->INCR($tmp_set_key);
    //echo '<meta counter="'.$counter.'" >';
    // 设置过期时间： 10分钟
    $redis->EXPIRE($tmp_set_key, 600);
    // 如果超过指定次数
    if ($counter>=3){
        // 制作永久key
        $pri_set_key = jinyu121_boomb_get_pri_key($ip);
        // 写到数据库中，设置过期时间： 1个月
        $redis->SETEX($pri_set_key, 2592000, "BLOCKED");
    }
}
