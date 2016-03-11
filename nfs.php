<?php
$path = getenv('PATH');
if(file_exists($path)){
    echo 'FileSystem is effective.';
}
?>