<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    拼写检查语言
// +----------------------------------------------------------------------+

function function_add_spellchecker_external_languages($initArray){
    $initArray['spellchecker_languages'] = '+Chinese=zh,English=en';
    return $initArray;
}
add_filter('tiny_mce_before_init', 'function_add_spellchecker_external_languages');
