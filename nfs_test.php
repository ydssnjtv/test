<?php

$dir = "/home/vcap/file/e195c08b-c44c-48c4-ab33-cf6fd62a7e9d";  //Ҫ��ȡ��Ŀ¼

echo "********** ��ȡĿ¼�������ļ����ļ��� ***********<hr/>";

//���ж�ָ����·���ǲ���һ���ļ���
if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh))!= false){
    	$filePath = $dir.$file;//�ļ�����ȫ·�� �����ļ���
        $fmt = filemtime($filePath);//��ȡ�ļ��޸�ʱ��
		echo "<span style='color:#666'>(".date("Y-m-d H:i:s",$fmt).")</span> ".$dir."/".$file."<br/>";
	}
    closedir($dh);
  }
}

?>