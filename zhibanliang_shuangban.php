<?php
//由于有的班次有双班，这个代码文件用的数据库查询语句无法实现我所要的结果，所以这是个失败的代码！！！

//header("Content-type:text/html;charset=utf-8");据说是解决乱码的
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

$mysql = new SaeMysql(); //使用saesql类连接数据库
echo "<p style='color:red;font-size:32px;text-align:center;'>成功构造SaeMysql数据库连接！<br/></p>";

//将表单传入的时间赋值，生成查询时间变量；
//echo $_POST['year']."年".$_POST['month']."月<br/><br/>";
$year=$_POST['year'];
$month=$_POST['month'];
//echo $year.'年'.$month.'月<br/><br/>';
$time=date("Y-m-d",mktime(0,0,0,$month,1,$year));
$timeend=date("Y-m-d",mktime(0,0,0,$month+1,1,$year));//下个月的第一天
$timeend1=date("Y-m-d", strtotime("$timeend -1 days"));//本月的最后一天
echo "<p style='color:red;font-size:32px;text-align:center;'>你选择的时间是：".$year.'年'.$month.'月<br/></p>';

//具体查询和结果显示
//$sql_zhongban= "SELECT `中班`,count(*) from `banbiao` WHERE `日期` BETWEEN '$time' AND '$timeend1' group by `中班`";//sql语句里的表和字段要用``括起来，字符串和变量要用单引号括起来；
$sql_zhongban = "select `中班`,count(*) from `banbiao` where `日期` BETWEEN '$time' AND '$timeend1' group by `中班`";
  echo "中班：";
  $result1 = $mysql->getData($sql_zhongban);
     foreach ($result1 as $r1){
		if ($r1['中班'] <> null){
		foreach ($r1 as $c1){
		   print_r($c1);
	     }
	    echo "&nbsp;&nbsp;";
		}
	 }
    echo "<br/>";
	
$sql_zaoban = "select `早班`,count(*) from `banbiao` where `日期` BETWEEN '$time' AND '$timeend1' group by `早班`";
  echo "早班：";
  $result1 = $mysql->getData($sql_zaoban);
     foreach ($result1 as $r1){
		if ($r1['早班'] <> null){
		foreach ($r1 as $c1){
		   print_r($c1);
	     }
	    echo "&nbsp;&nbsp;";
		}
	 }
    echo "<br/>";	 
	 
$sql_xiaowan = "select `小晚`,count(*) from `banbiao` where `日期` BETWEEN '$time' AND '$timeend1' group by `小晚`";
  echo "小晚：";
  $result1 = $mysql->getData($sql_xiaowan);
     foreach ($result1 as $r1){
		if ($r1['小晚'] <> null){
		foreach ($r1 as $c1){
		   print_r($c1);
	     }
	    echo "&nbsp;&nbsp;";
		}
	 }
    echo "<br/>";
	
$sql_zhonger = "select `中二`,count(*) from `banbiao` where `日期` BETWEEN '$time' AND '$timeend1' group by `中二`";
  echo "中二：";
  $result1 = $mysql->getData($sql_zhonger);
     foreach ($result1 as $r1){
		if ($r1['中二'] <> null){
		foreach ($r1 as $c1){
		   print_r($c1);
	     }
	    echo "&nbsp;&nbsp;";
		}
	 }
    echo "<br/>";
	
$sql_shenwan = "select `审晚`,count(*) from `banbiao` where `日期` BETWEEN '$time' AND '$timeend1' group by `审晚`";
  echo "审晚：";
  $result1 = $mysql->getData($sql_shenwan);
     foreach ($result1 as $r1){
		if ($r1['审晚'] <> null){
		foreach ($r1 as $c1){
		   print_r($c1);
	     }
	    echo "&nbsp;&nbsp;";
		}
	 }
    echo "<br/>";
	 
//print_r($result1);
      
//   echo '中班--';
//       foreach ($result1 as $r1)
//	     {
//		   foreach ($r1 as $c1=>$value1)
//		      {
//							   echo $c1.':'.$value;
//			   }
//		   }
	   

    $mysql->closeDb();
?>