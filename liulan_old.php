<?php
//header("Content-type:text/html;charset=utf-8");
//连接新浪云主站及数据库
$hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
$dbuser = SAE_MYSQL_USER;
$dbpass = SAE_MYSQL_PASS;
$dbname = SAE_MYSQL_DB;
$link = mysql_connect($hostname, $dbuser, $dbpass);
if (!$link)
 {
    die('Could not connect: ' . mysql_error());
 }
echo 'Connected successfully.<br/>';
//select db
mysql_select_db($dbname, $link) or die ('Can\'t use dbname : ' . mysql_error());
echo 'Select db '.$dbname.' successfully.<br/><br/><br/>';

$mysql = new SaeMysql(); //使用saesql类连接数据库
echo "Connect SaeMysql success <br/>\n";

//echo $_POST['year'].$_POST['month']."<br/>"

//具体查询和结果显示

$sql = "SELECT * FROM `banbiao` WHERE `日期` >= \'2015-04-01\' ";  //可以在SAE的PHPMYADMIN中拷贝来！
$result = $mysql->getData( $sql );  //可以参考http://www.2cto.com/database/201404/296583.html
  foreach ($result as $row)
   {
    foreach ($row as $key=>$value)
       {
         echo $key."=>".$value."<br/>";
       }
     echo "===================<br/>";
   }
//echo '共有'.$row.'条记录。'.'<br/><br/>';
//echo '再见！';
?>
