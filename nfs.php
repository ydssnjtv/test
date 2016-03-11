<?php
$path = getenv('PATH');
printf("Command processor: %s\n",$path);
if(file_exists($path)){
    echo 'FileSystem is effective.';
}
else echo 'no filesystem'
?>