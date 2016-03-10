<?php //判断选择日期是否已经有了排班表
function panduan($time){
//$hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
//$dbuser = SAE_MYSQL_USER;
//$dbpass = SAE_MYSQL_PASS;
//$dbname = SAE_MYSQL_DB;
//$link = mysqli_connect(SAE_MYSQL_HOST_M, SAE_MYSQL_USER, SAE_MYSQL_PASS, SAE_MYSQL_DB, SAE_MYSQL_PORT);
//if (!$link) {die('Could not connect: '.mysql_error());}
//$mysql = new SaeMysql(); //使用saesql类连接数据库
//
//	$sql_pd = "SELECT * FROM `banbiao` WHERE `日期` > '$time'";
//	$result_pd = $mysql->getData($sql_pd);
	if($time>date("Y-m-d")){die("<p  style='text-align:center;font-size:45px;color:red;font-weight: bold'>你太心急了，还没排呢！</p>'");}}
?>