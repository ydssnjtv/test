<table border="1" align="center">
 <tr>
  <th><span style='color:black;font-size:35px'>姓名</span></th>
  <th><span style='color:black;font-size:35px'>吴锦夏</span></th>
  <th><span style='color:black;font-size:35px'>胡守霞</span></th>
  <th><span style='color:black;font-size:35px'>徐艳</span></th>
  <th><span style='color:black;font-size:35px'>孙海燕</span></th>
  <th><span style='color:black;font-size:35px'>郑雯</span></th>
  <th><span style='color:black;font-size:35px'>杨芮</span></th>
  <th><span style='color:black;font-size:35px'>杨旸</span></th>
  <th><span style='color:black;font-size:35px'>李笑啡</span></th>
 </tr>
<?php
require_once('panduan.php');
require_once('connectdb.php');

linkdb();
$dbname = "dfd61754ba8e04374a91b8bdf5344e36a";
mysql_select_db($dbname) or die("不能选择数据库");

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
//$sql_zhongban= "SELECT `中班`,count(*) from `banbiao` WHERE `日期` BETWEEN '$time' AND '$timeend1' group by `中班`";//sql语句里的表和字段要用``括起来，字符串和变量要用单引号括起来；
$renyuan=array('吴锦夏','胡守霞','徐艳','孙海燕','郑雯','杨芮','杨旸','李笑啡');
$summary=array('吴锦夏'=>0,'胡守霞'=>0,'徐艳'=>0,'孙海燕'=>0,'郑雯'=>0,'杨芮'=>0,'杨旸'=>0,'李笑啡'=>0);
//下面通过5次查询数据库，得出5种班次的各人统计；
echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>早班</p></td>";
$i=0;
while($i<=7){
  $ry=$renyuan[$i];
  $sql_ss = "select `早班` from `banbiao` where `日期` BETWEEN '$time' AND '$timeend1' and `早班` like '%$ry%'";//select语句里变量要用引号括起来！！！！这句执行的结果是某人本月所有早班的列表；
  $result1 = $mysql->getData($sql_ss);
  $count=0;
  foreach ((array)$result1 as $r1=>$credit){     //代码有些怪，看48行注释
	    if($credit['ratio']){
		  $result1[$r1]=$credit;
	    }$count++;
   }

//这段代码就是循环一遍数组，用$count累积出值班量，如果用普通的foreach会报错，如下：
//foreach ($result1 as $r1){
//	$count++;
//}
//执行后会报"Warning: Invalid argument supplied for foreach() in"，可能因为某个值为空；

   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count."</p></td>";
   $summary[$ry]=$summary[$ry]+$count;//这是计算最后每人合计总班次的；
   if($i==7){echo "</tr>";}//再次提醒！！！如果写$i=7就不对，比较关系中只有==，不能=；
   $i++;
   unset($result1);
}


echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>中班</p></td>";
$i=0;
while($i<=7){
  $ry=$renyuan[$i];
  $sql_ss = "select `中班` from `banbiao` where `日期` BETWEEN '$time' AND '$timeend1' and `中班` like '%$ry%'";//select语句里变量要用引号括起来！！！！
  $result1 = $mysql->getData($sql_ss);
  $count=0;
  foreach ((array)$result1 as $r1=>$credit){     //代码有些怪，看48行注释
	    if($credit['ratio']){
		  $result1[$r1]=$credit;
	    }$count++;
   }

//如果用普通的foreach会报错，如下：
//foreach ($result1 as $r1){
//	$count++;
//}
//执行后会报"Warning: Invalid argument supplied for foreach() in"，可能因为某个值为空；

   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count.'</p></td>';
   $summary[$ry]=$summary[$ry]+$count;
   if($i==7){echo "</tr>";}
   $i++;
   unset($result1);
}


echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>中二</p></td>";
$i=0;
while($i<=7){
  $ry=$renyuan[$i];
  $sql_ss = "select `中二` from `banbiao` where `日期` BETWEEN '$time' AND '$timeend1' and `中二` like '%$ry%'";//select语句里变量要用引号括起来！！！！
  $result1 = $mysql->getData($sql_ss);
  $count=0;
  foreach ((array)$result1 as $r1=>$credit){     //代码有些怪，看48行注释
	    if($credit['ratio']){
		  $result1[$r1]=$credit;
	    }$count++;
   }

//如果用普通的foreach会报错，如下：
//foreach ($result1 as $r1){
//	$count++;
//}
//执行后会报"Warning: Invalid argument supplied for foreach() in"，可能因为某个值为空；

   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count.'</p></td>';
   $summary[$ry]=$summary[$ry]+$count;
   if($i==7){echo "</tr>";}
   $i++;
   unset($result1);
}


echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>小晚</p></td>";
$i=0;
while($i<=7){
  $ry=$renyuan[$i];
  $sql_ss = "select `小晚` from `banbiao` where `日期` BETWEEN '$time' AND '$timeend1' and `小晚` like '%$ry%'";//select语句里变量要用引号括起来！！！！
  $result1 = $mysql->getData($sql_ss);
  $count=0;
  foreach ((array)$result1 as $r1=>$credit){     //代码有些怪，看48行注释
	    if($credit['ratio']){
		  $result1[$r1]=$credit;
	    }$count++;
   }

//如果用普通的foreach会报错，如下：
//foreach ($result1 as $r1){
//	$count++;
//}
//执行后会报"Warning: Invalid argument supplied for foreach() in"，可能因为某个值为空；

   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count."</p></td>";
   $summary[$ry]=$summary[$ry]+$count;
   if($i==7){echo "</tr>";}
   $i++;
   unset($result1);
}	   

echo "<tr><td><p style='color:black;font-size:35px;text-align:center'>审晚</p></td>";
$i=0;
while($i<=7){
  $ry=$renyuan[$i];
  $sql_ss = "select `审晚` from `banbiao` where `日期` BETWEEN '$time' AND '$timeend1' and `审晚` like '%$ry%'";//select语句里变量要用引号括起来！！！！
  $result1 = $mysql->getData($sql_ss);
  $count=0;
  foreach ((array)$result1 as $r1=>$credit){     //代码有些怪，看48行注释
	    if($credit['ratio']){
		  $result1[$r1]=$credit;
	    }
	    $count++;
   }

//这段代码就是循环一遍数组，用$count累积出值班量，如果用普通的foreach会报错，如下：
//foreach ($result1 as $r1){
//	$count++;
//}
//执行后会报"Warning: Invalid argument supplied for foreach() in"，可能因为某个值为空；

   echo "<td><p style='color:black;font-size:35px;text-align:center'>".$count."</p></td>";
   $summary[$ry]=$summary[$ry]+$count;
   if($i==7){echo "</tr>";}
   $i++;
   unset($result1);
}

echo "<tr><td><p style='color:black;font-size:35px;text-align:center;font-weight:bold'>合计</p></td>";
$i=0;
foreach($summary as $cc=>$vv){
    echo "<td><p style='color:black;font-size:35px;text-align:center;font-weight:bold'>".$vv."</p></td>";
	if($i==7){echo "</tr>";}
   $i++;
}


$mysql->closeDb();
?>
</table>