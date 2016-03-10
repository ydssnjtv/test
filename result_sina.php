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
require_once('panduan.php');
require_once('connectdb.php');

linkdb();//调用connectdb.php中的函数创建数据库连接
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
panduan($time);	//调用的是panduan.php的函数
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