<?php
//$path = getenv('PATH');
//printf("Path is: %s\n",$path);
//if(file_exists($path)){
//    echo 'FileSystem is effective.';
//}
//else echo 'no filesystem'


	$dir = "/home/vcap/file/e195c08b-c44c-48c4-ab33-cf6fd62a7e9d";  //Ҫ��ȡ��Ŀ¼

	echo "********** ��ȡĿ¼�������ļ����ļ��� ***********<hr/>";

	//���ж�ָ����·���ǲ���һ���ļ���

	if (is_dir($dir)){

		if ($dh = opendir($dir)){

			while (($file = readdir($dh))!= false){

				//�ļ�����ȫ·�� �����ļ���

				$filePath = $dir.$file;

				//��ȡ�ļ��޸�ʱ��

				$fmt = filemtime($filePath);

				echo "<span style='color:#666'>(".date("Y-m-d H:i:s",$fmt).")</span> ".$filePath."<br/>";

			}

			closedir($dh);

		}

	}

?>