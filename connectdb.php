<?php
function linkdb(){
//连接新浪云主站及数据库
$hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
$dbuser = SAE_MYSQL_USER;
$dbpass = SAE_MYSQL_PASS;
$dbname = SAE_MYSQL_DB;
//$link = mysql_connect($hostname, $dbuser, $dbpass);   ~~~mysql_connect过时了，被下面的mysqli_connect取代，但是后者的参数定义不一样的，端口放在最后！！
$link = mysqli_connect(SAE_MYSQL_HOST_M, SAE_MYSQL_USER, SAE_MYSQL_PASS, SAE_MYSQL_DB, SAE_MYSQL_PORT);
//mysql_query("SET NAMES UTF8");  据说是解决乱码的
if (!$link) {die('Could not connect: '.mysql_error());}
//echo "成功连接新浪云主机！<br/>";
   echo "<p style='color:red;font-size:32px;text-align:center;'>现在是".date('y-m-d H:i:s',time()).',已成功连接新浪云主机！</p>';

//select db～～～使用mysqli_connect连接数据库后，下面一句就会报错；
//mysql_select_db($dbname, $link) or die ('Can\'t use dbname : ' . mysql_error());
//echo 'Select db '.$dbname.' successfully.<br/><br/>';



}
?>
