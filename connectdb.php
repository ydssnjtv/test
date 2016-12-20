<?php
function linkdb(){

  $hostname = '192.168.1.182';
  $dbport = '35037';
  $dbuser = "2e030137ac0a4";
  $dbpass = "c0267938603d4";

 //$link = mysql_connect($hostname, $dbuser, $dbpass);   新版mopaas必须换用下面一句；
 $link = @mysql_connect("{$hostname}:{$dbport}",$dbuser,$dbpass,true);

//mysql_query("SET NAMES UTF8");  据说是解决乱码的
mysql_query("SET NAMES UTF8");  
if (!$link) {die('Could not connect: '.mysql_error());}
//echo "成功连接新浪云主机！<br/>";
  
	 echo "<p style='color:black;font-size:32px;text-align:center;'>现在是".date('y-m-d H:i:s',time()).',已成功连接新版Mopaas云主机！</p>';

//select db～～～使用mysqli_connect连接数据库后，下面一句就会报错；
//mysql_select_db($dbname, $link) or die ('Can\'t use dbname : ' . mysql_error());
//echo 'Select db '.$dbname.' successfully.<br/><br/>';

}
?>
