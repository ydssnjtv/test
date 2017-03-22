<table border="1" align="center">
 <tr>
  <th><span style='color:black;font-size:30px'>日期</span></th>
  <th><span style='color:black;font-size:30px'>星期</span></th>
  <th><span style='color:black;font-size:30px'>中班</span></th>
  <th><span style='color:black;font-size:30px'>早班</span></th>
  <th><span style='color:black;font-size:30px'>小晚</span></th>
  <th><span style='color:black;font-size:30px'>中二</span></th>
  <th><span style='color:black;font-size:30px'>审晚</span></th>
  <th><span style='color:red;bgcolor:grey;font-size:30px'>收带</span></th>
 </tr>

<?php
require_once('panduan.php');
require_once('connectdb.php');
linkdb();//调用connectdb.php中的函数创建数据库连接
//用mysqli还是报错，无法读取数据，用mysql连接就没有问题
$dbname = "7dc47f1132744";
mysql_select_db($dbname) or die("不能选择数据库");

echo "<p style='color:black;font-size:32px;text-align:center;'>成功构造Mysql数据库连接！</p>";

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
$sql = "SELECT * FROM `banbiaoqianjing` WHERE `日期` BETWEEN '$time' AND '$timeend1'";//sql语句里的表和字段要用``括起来，字符串和变量要用单引号括起来；
//$sql = "SELECT * FROM `banbiao` WHERE `审晚` = '郑雯'";
//$sql = "SELECT * FROM `banbiao` WHERE `小晚` IS NOT NULL ";     
    //$result = $mysql->getData($sql); 

$a2=mysql_query($sql)or die("对不起，读入数据时出错了！". mysql_error());
while($result=mysql_fetch_row($a2))//通过循环读取数据内容，mysql_fetch_array() 是 mysql_fetch_row() 的扩展版本。除了将数据以数字索引方式储存在数组中之外，还可以将数据作为关联索引储存，用字段名作为键名。也就是如果下标是字符串，会多返回一份下标是字符串的结果。
{
	
		   $riqi=strtotime($result[0]);//尽管日期在MYSQL里是日期格式，但取出的$value['日期']只是字符串格式，不是时间，将其转为时间戳；
		   $weekarray=array("日","一","二","三","四","五","六");
  		   $zhouji=$weekarray[date("w",$riqi)];//换算成周几并转换成汉字表达，date("w",$riqi)是将日期转换为0～6的星期几；
           if  ($zhouji=="日" or  $zhouji=="六") 
           {
			  echo "<tr bgcolor='black'>";
			   echo "<td><p style='color:white;font-size:30px;text-align:center'>".$result[0].'</p></td>';
			   echo "<td><p style='color:white;font-size:30px;text-align:center'>".$zhouji.'</p></td>';
			   echo "<td><p style='color:white;font-size:30px;text-align:center'>".$result[1].'</p></td>';
		       echo "<td><p style='color:white;font-size:30px;text-align:center'>".$result[2].'</p></td>';
		       echo "<td><p style='color:white;font-size:30px;text-align:center'>".$result[3].'</p></td>';
		       echo "<td><p style='color:white;font-size:30px;text-align:center'>".$result[4].'</p></td>';
		       echo "<td><p style='color:white;font-size:30px;text-align:center'>".$result[5].'</p></td>';
			   echo "<td><p style='color:red;bgcolor:grey;font-size:30px;text-align:center'>".$result[6].'</p></td>';
            } else 
           {
                echo "<tr>";
				  echo "<td><p style='color:black;font-size:30px;text-align:center'>".$result[0].'</p></td>';
				  echo "<td><p style='color:black;font-size:30px;text-align:center'>".$zhouji.'</p></td>';
				  echo "<td><p style='color:black;font-size:30px;text-align:center'>".$result[1].'</p></td>';
		          echo "<td><p style='color:black;font-size:30px;text-align:center'>".$result[2].'</p></td>';
		          echo "<td><p style='color:black;font-size:30px;text-align:center'>".$result[3].'</p></td>';
		          echo "<td><p style='color:black;font-size:30px;text-align:center'>".$result[4].'</p></td>';
		          echo "<td><p style='color:black;font-size:30px;text-align:center'>".$result[5].'</p></td>';
				  echo "<td><p style='color:red;bgcolor:grey;font-size:30px;text-align:center'>".$result[6].'</p></td>';
            }
		//以上if。。then。。else是为了让周末两天特殊颜色显示；   

		  echo "</tr>";
		
			//要获得星期几，可以参考http://www.111cn.net/phper/php/51257.htm；
}

mysql_close();
?>
</table>