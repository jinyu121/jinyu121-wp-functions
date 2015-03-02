<?php
/*
Plugin Name: 小金鱼儿的Wordpress工具集
Description: 各种小的工具
Version: 2015.02
Author: 小金鱼儿
Author URI: mailto:jinyu121@126.com
*/
$host = $_SERVER['HTTP_HOST'];
$is_localhost = strstr($host, '192.168') || strstr($host, '127.0.0') || stristr($host, 'localhost') ? true : false; // 判斷是否在本地

// define('INC', dirname( __FILE__ ) .'/functions-enabled');
// IncludeAll( INC );
// function IncludeAll($dir){
//     $dir = realpath($dir);
//     if($dir){
//         $files = scandir($dir);
//         //sort($files);
//         foreach($files as $file){
//             if($file == '.' || $file == '..'){
//                 continue;
//             }elseif(preg_match('/.php$/i', $file)){
//                 include_once $dir.'/'.$file;
//             }
//         }
//     }
// }

foreach( glob( dirname( __FILE__ ) .'/functions-enabled/*.php' ) as $filename ){
    include_once( $filename );
}
