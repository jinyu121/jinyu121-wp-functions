<?php
// +----------------------------------------------------------------------+
// | 小金鱼儿 Wordpress 工具集
// +----------------------------------------------------------------------+
// | Copyright (c) 2015 jinyu121
// +----------------------------------------------------------------------+
// | 代码收集自网络，由[小金鱼儿](jinyu121@126.com)编辑整理
// +----------------------------------------------------------------------+
// | 本文件内容：
// |    使用MathJax渲染LaTeX公式
// +----------------------------------------------------------------------+

function enable_mathjax(){
?>
	<script type="text/x-mathjax-config">
		MathJax.Hub.Config({tex2jax: {inlineMath: [['$latex ','$'], ['\\(','\\)']]}});
	</script>
	<script type="text/javascript" async src="//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML"></script>
<?php
}
add_action('wp_footer','enable_mathjax',900);

