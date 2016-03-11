<?php
//$path = getenv('PATH');
$path = "/home/vcap/file/e195c08b-c44c-48c4-ab33-cf6fd62a7e9d";
if(file_exists($path)){
    echo 'FileSystem is effective.';
}
else echo 'no filesystem'
?>