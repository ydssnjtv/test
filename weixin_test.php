<?php

define("TOKEN", "ydssnjtv");

$signature = $_GET["signature"];
$echostr = $_GET["echostr"];
$timestamp = $_GET["timestamp"];
$nonce = $_GET["nonce"];

$tmpArr = array($nonce, $timestamp, TOKEN);
sort($tmpArr);

$tmpStr = implode($tmpArr);
$tmpStr = sha1($tmpStr);

if( $tmpStr == $signature ){
ob_clean();
echo $echostr;
}else{
return false;
}

?>