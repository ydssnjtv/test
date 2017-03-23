<table border="1" align="center">
 <tr>
  <th><span style='color:black;font-size:35px'>姓名</span></th>
  <th><span style='color:black;font-size:35px'>吴锦夏</span></th>
  <th><span style='color:black;font-size:35px'>胡守霞</span></th>
  <th><span style='color:black;font-size:35px'>徐艳</span></th>
  <th><span style='color:black;font-size:35px'>孙海燕</span></th>
  <th><span style='color:black;font-size:35px'>郑雯</span></th>
  <th><span style='color:black;font-size:35px'>杨芮</span></th>
  <th><span style='color:black;font-size:35px'>钱静</span></th>
  <th><span style='color:black;font-size:35px'>杨旸</span></th>
  <th><span style='color:black;font-size:35px'>李笑啡</span></th>
 </tr>
<?php
require_once('panduan.php');
require_once('connectdb.php');

linkdb();
$dbname = "7dc47f1132744";
mysql_select_db($dbname) or die("不能选择数据库");

echo "<p style='color:red;font-size:32px;text-align:center;'>成功构造Mopaas Mysql数据库连接！<br/></p>";

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
//$sql_zhongban= "SELECT `中班`,count(*) from `banbiao` WHERE `日期` BETWEEN '$time' AND '$timeend1' group by `中班`";//sql语句里的表和字段要用``括起来，字符串和变量要用单引号括起来；
$renyuan=array('吴锦夏','胡守霞','徐艳','孙海燕','郑雯','杨芮','钱静','杨旸','李笑啡');
$summary=array('吴锦夏'=>0,'胡守霞'=>0,'徐艳'=>0,'孙海燕'=>0,'郑雯'=>0,'杨芮'=>0,'钱静'=>0,'杨旸'=>0,'李笑啡'=>0);
//下面通过5次查询数据库，得出5种班次的各人统计；
echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>早班</p></td>";
$i=0;
while($i<=8){
  $ry=$renyuan[$i];
  $sql_ss = "select count(*) from `banbiaoqianjing` where `日期` BETWEEN '$time' AND '$timeend1' and `早班` like '%$ry%'";//select语句里变量要用引号括起来！！！！这句执行的结果是某人本月所有早班的列表；
  $aa=mysql_query($sql_ss)or die("对不起，读入数据时出错了！". mysql_error());
  $count=mysql_fetch_row($aa);
   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count[0]."</p></td>";
   $summary[$ry]=$summary[$ry]+$count[0];//这是计算最后每人合计总班次的；
   if($i==7){echo "</tr>";}//再次提醒！！！如果写$i=7就不对，比较关系中只有==，不能=；
   $i++;
}


echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>中班</p></td>";
$i=0;
while($i<=8){
  $ry=$renyuan[$i];
  $sql_ss = "select count(*) from `banbiaoqianjing` where `日期` BETWEEN '$time' AND '$timeend1' and `中班` like '%$ry%'";//select语句里变量要用引号括起来！！！！这句执行的结果是某人本月所有早班的列表；
  $aa=mysql_query($sql_ss)or die("对不起，读入数据时出错了！". mysql_error());
  $count=mysql_fetch_row($aa);
   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count[0]."</p></td>";
   $summary[$ry]=$summary[$ry]+$count[0];
   if($i==7){echo "</tr>";}
   $i++;
}


echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>中二</p></td>";
$i=0;
while($i<=8){
  $ry=$renyuan[$i];
  $sql_ss = "select count(*) from `banbiaoqianjing` where `日期` BETWEEN '$time' AND '$timeend1' and `中二` like '%$ry%'";//select语句里变量要用引号括起来！！！！这句执行的结果是某人本月所有早班的列表；
  $aa=mysql_query($sql_ss)or die("对不起，读入数据时出错了！". mysql_error());
  $count=mysql_fetch_row($aa);
   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count[0]."</p></td>";
   $summary[$ry]=$summary[$ry]+$count[0];
   if($i==7){echo "</tr>";}
   $i++;
}


echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>小晚</p></td>";
$i=0;
while($i<=8){
  $ry=$renyuan[$i];
  $sql_ss = "select count(*) from `banbiaoqianjing` where `日期` BETWEEN '$time' AND '$timeend1' and `小晚` like '%$ry%'";//select语句里变量要用引号括起来！！！！这句执行的结果是某人本月所有早班的列表；
  $aa=mysql_query($sql_ss)or die("对不起，读入数据时出错了！". mysql_error());
  $count=mysql_fetch_row($aa);
   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count[0]."</p></td>";
   $summary[$ry]=$summary[$ry]+$count[0];
   if($i==7){echo "</tr>";}
   $i++;
}	   

echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>审晚</p></td>";
$i=0;
while($i<=8){
  $ry=$renyuan[$i];
  $sql_ss = "select count(*) from `banbiaoqianjing` where `日期` BETWEEN '$time' AND '$timeend1' and `审晚` like '%$ry%'";
  $aa=mysql_query($sql_ss)or die("对不起，读入数据时出错了！". mysql_error());
  $count=mysql_fetch_row($aa);
   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count[0]."</p></td>";
   $summary[$ry]=$summary[$ry]+$count[0];
   if($i==7){echo "</tr>";}
   $i++;
}

echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>收带</p></td>";
$i=0;
while($i<=8){
  $ry=$renyuan[$i];
  $sql_ss = "select count(*) from `banbiaoqianjing` where `日期` BETWEEN '$time' AND '$timeend1' and `收带` like '%$ry%'";
  $aa=mysql_query($sql_ss)or die("对不起，读入数据时出错了！". mysql_error());
  $count=mysql_fetch_row($aa);
   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count[0]."</p></td>";
   $summary[$ry]=$summary[$ry]+$count[0];
   if($i==7){echo "</tr>";}
   $i++;
}

echo "<tr><td><p style='color:black;font-size:35px;text-align:center;font-weight:bold'>合计</p></td>";
$i=0;
foreach($summary as $cc=>$vv){
    echo "<td><p style='color:black;font-size:35px;text-align:center;font-weight:bold'>".$vv."</p></td>";
	if($i==8){echo "</tr>";}
   $i++;
}


mysql_close();
?>
</table>