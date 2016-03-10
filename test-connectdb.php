<?php
//header("Content-type:text/html;charset=utf-8");
$hostname = SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
$dbuser = SAE_MYSQL_USER;
$dbpass = SAE_MYSQL_PASS;
$dbname = SAE_MYSQL_DB;
$link = mysql_connect($hostname, $dbuser, $dbpass);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully<br/>';
//select db
mysql_select_db($dbname, $link) or die ('Can\'t use dbname : ' . mysql_error());
echo 'Select db '.$dbname.' successfully';
mysql_close($link);
?>