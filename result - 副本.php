<table border="1" align="center">
 <tr>
  <th><span style='color:black;font-size:35px'>日期</span></th>
  <th><span style='color:black;font-size:35px'>星期</span></th>
  <th><span style='color:black;font-size:35px'>中班</span></th>
  <th><span style='color:black;font-size:35px'>早班</span></th>
  <th><span style='color:black;font-size:35px'>小晚</span></th>
  <th><span style='color:black;font-size:35px'>中二</span></th>
  <th><span style='color:black;font-size:35px'>审晚</span></th>
 </tr>

<?php
require('panduan.php');
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
panduan($time);	
//具体查询和结果显示
$sql = "SELECT * FROM `banbiao` WHERE `日期` BETWEEN '$time' AND '$timeend1'";//sql语句里的表和字段要用``括起来，字符串和变量要用单引号括起来；
//$sql = "SELECT * FROM `banbiao` WHERE `审晚` = '郑雯'";
//$sql = "SELECT * FROM `banbiao` WHERE `小晚` IS NOT NULL ";     
    $result = $mysql->getData($sql); 
        
    foreach ($result as $row=>$value)
         {
          
		  echo "<tr>";
		   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$value['日期'].'</p></td>';
		   
		   $riqi=strtotime($value['日期']);//尽管日期在MYSQL里是日期格式，但取出的$value['日期']只是字符串格式，不是时间，将其转为时间戳；
		   $weekarray=array("日","一","二","三","四","五","六");
  		   $zhouji=$weekarray[date("w",$riqi)];//换算成周几并转换成汉字表达，date("w",$riqi)是将日期转换为0～6的星期几；
           echo "<td><p style='color:black;font-size:35px;text-align:center'>".$zhouji.'</p></td>';
		   
		   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$value['中班'].'</p></td>';
		   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$value['早班'].'</p></td>';
		   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$value['小晚'].'</p></td>';
		   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$value['中二'].'</p></td>';
		   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$value['审晚'].'</p></td>';
		  echo "</tr>";
		
			//要获得星期几，可以参考http://www.111cn.net/phper/php/51257.htm；
          }  
    $mysql->closeDb();
?>
</table>