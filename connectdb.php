<?php
function linkdb(){
//连接新浪云主站及数据库
$hostname = '192.168.1.11';
$dbport = '3306';
$dbuser = "7f1a7a89-fe9b";
$dbpass = "368a98a2-2d68";
$dbname = "dfd61754ba8e04374a91b8bdf5344e36a";
//$link = mysql_connect($hostname, $dbuser, $dbpass);   ~~~mysql_connect过时了，被下面的mysqli_connect取代，但是后者的参数定义不一样的，端口放在最后！！
$link = mysqli_connect($hostname, $dbuser, $dbpass, $dbname, $dbport);
//mysql_query("SET NAMES UTF8");  据说是解决乱码的
if (!$link) {die('Could not connect: '.mysql_error());}
//echo "成功连接新浪云主机！<br/>";
   echo "<p style='color:red;font-size:32px;text-align:center;'>现在是".date('y-m-d H:i:s',time()).',已成功连接新浪云主机！</p>';

//select db～～～使用mysqli_connect连接数据库后，下面一句就会报错；
//mysql_select_db($dbname, $link) or die ('Can\'t use dbname : ' . mysql_error());
//echo 'Select db '.$dbname.' successfully.<br/><br/>';



}
?>
