<?php

$dir = "/home/vcap/file/e195c08b-c44c-48c4-ab33-cf6fd62a7e9d";  //要获取的目录

echo "********** 获取目录下所有文件和文件夹 ***********<hr/>";

//先判断指定的路径是不是一个文件夹
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh))!= false){
    	$filePath = $dir.$file;//文件名的全路径 包含文件名
        $fmt = filemtime($filePath);//获取文件修改时间
		echo "<span style='color:#666'>(".date("Y-m-d H:i:s",$fmt).")</span> ".$dir."/".$file."<br/>";
	}
    closedir($dh);
  }
}

?>