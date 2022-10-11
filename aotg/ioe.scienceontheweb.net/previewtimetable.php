<?php
include ("connection.php");
include('session.php');
include('userheader.php');

?>
<!DOCTYPE html>
<html>
<style>
tr{
height: 100%;
font-family:Times New Roman;
color:black;
background-color:lightgrey;
text-align:center;
 border: 1px solid  black;

}
td{
	width:10%;
	text-align:center;
	 border: 1px solid black;
	background-color: lightgrey;
	
}
table{
	border-collapse: collapse;
	 border: 1px solid  black;
}
button{
	float:right;
	display: inline-block;
  padding: 1.5% 2.5%;
  font-size: 100%;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  border: none;
  border-radius: 15px;
  box-shadow: 0 4px #999;
	background-color:#152732;
	color:white;
	margin-top:1%;
}
button:hover {background-color: #2b4c61}

button:active {
  background-color: #2b4c61;
  box-shadow: 0 2px #666;
  transform: translateY(2px);
}
</style>
<body>

</div>
<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section >
<div id="timetable">
    
           
				<table border="0"> 
					
					<tr><td><?php
					
function previewtimetabletoallbutton()
{
	$classname = $_SESSION['classnames'];
	$classdiv = $_SESSION['classdivs'];
	$class=$classname.$classdiv;
	return $button='
<link rel="stylesheet" href="css/style.css">
<div>
<form method="POST" action="previewtimetable.php"> 
				<table border="0" >
	<div id=add1 >
		<tr>
			<td colspan=3>all student of '.$class.' will be able to preview this timetable when you click on preview timetable to all button</td>
			<td colspan=3 rowspan=8><h5 style="color:white;">Instruction<h5>
			<ol style="color:white;text-align: left;">
<li>to preview timetable to teacher enter teacher name in teacher name field</li>
<li>all the student of class which belong to this class can aslo able to  preview timetable atomatically </li>


<ol>
			</td>
		</tr>
		<tr> 
			<td colspan=3>preview timetable to all teacher</td>
		</tr>
        <tr>		
			<td > teacher name 1</td>	
			<td > <input type="text" id="teacher1" name="teacher1" placeholder="Enter teacher name"></td>
		</tr>
	
		<td id="container" colspan=3>
					</td>
				
		<tr style="border:none;background-color:black;">		
	<input type=hidden id="loopvalue"  name=loopvalue value=1></input>			
<td colspan=2 style="border:none;background-color:white;"><button style="width:30%;background-color:black;margin-left:2%;margin-right:30.2%;" id="add" name=previewtimetabletoall>preview timetable to all</button></td >
</tr>
</form>

</table>


 </div>
<form><button name=back type=submit formaction=previewtimetable.php 
<button id="add" type=submit style="width:10%;float:left;background-color:black;margin-left:2%;">back</button></form>
<div style="background-color:black;"><button id="adds" style="width:30%;margin-right:2%;">Add new teacher</button></div>';
}					
if(isset($_POST['previewtimetabletoall']))
{
	$classname = $_SESSION['classnames'];
	$classdiv = $_SESSION['classdivs'];
	$database1=$login_session."_teacherusers";
	$database2=$login_session."_studentusers";
	$class=$classname.$classdiv;
	$database3=$login_session."_".$class."timetable";
	$database4=$login_session."_".$class."details";
function addingloop($database1,$database2,$database3,$class,$conn,$database4){	
$_SESSION['post-data'] = $_POST;
$n = $_SESSION['post-data']['loopvalue'];
$teacher = array();	
for($i=1;$i<=$n;)
{
$count1="teacher".$i;
$y = $_SESSION['post-data'][$count1];
$teacher[$i]=$y;
$i++;
}	

function timetableinsert($x ,$database1 , $database3, $teachers, $conn, $database4){
	
	$sql5="SELECT previewtimetable$x FROM $database1 where name='$teachers'";
$result5 = $conn->query($sql5);
if($result5 != "")
{
	if($x == 1){
	$sql1 = "UPDATE  $database1 SET previewtimetable$x='$database3' WHERE name='$teachers';";
$result1 = $conn->query($sql1);
$sql9 = "UPDATE  $database1 SET previewtime$x='$database4' WHERE name='$teachers';";
$result9 = $conn->query($sql9);
echo "$teachers can now able preview timetable";
$x=$x+1;
$sql5 = "UPDATE `$database1` SET `timecounts` = '$x' WHERE name='$teachers'";
$result5 = $conn->query($sql5);	
}else{
	$a=0;
	$b=0;
for($i=1;$i<$x;)
{
	$sql5="SELECT previewtimetable$i FROM $database1 where name='$teachers'";
$result5 = $conn->query($sql5);

if ($result5->num_rows > 0) 
{
    // output data of each row
    while($row5 = $result5->fetch_array())
		{
			$checkclass 		=	 $row5['previewtimetable'.$i.''];
		}
}

if($checkclass != $database3)
{
	$a=1;
	

}else{
	$b=1;
	
}

$i++;
}	
if($a == 1)
{
if($b == 0)
{	
	$sql1 = "UPDATE  $database1 SET previewtimetable$x='$database3' WHERE name='$teachers';";
$result1 = $conn->query($sql1);
$sql9 = "UPDATE  $database1 SET previewtime$x='$database4' WHERE name='$teachers';";
$result9 = $conn->query($sql9);
echo "$teachers can now able preview timetable";
$x=$x+1;
$sql5 = "UPDATE `$database1` SET `timecounts` = '$x' WHERE name='$teachers'";
$result5 = $conn->query($sql5);	
	$a=0;
}else{
	echo "$teachers is already able preview timetable";
}
}else{
	echo "$teachers is already able preview timetable";
}	
}
}else{
	$a=0;
	$b=0;
for($i=1;$i<$x;)
{
	$sql5="SELECT previewtimetable$i FROM $database1 where name='$teachers'";
$result5 = $conn->query($sql5);

if ($result5->num_rows > 0) 
{
    // output data of each row
    while($row5 = $result5->fetch_array())
		{
			$checkclass 		=	 $row5['previewtimetable'.$i.''];
		}
}

if($checkclass != $database3)
{
	$a=1;
	

}else{
	$b=1;
	
}

$i++;
}	
if($a == 1)
{
if($b == 0)
{	
	$sql5 = "ALTER TABLE $database1 ADD `previewtimetable$x` text;";
$result5 = $conn->query($sql5);
$sql7 = "ALTER TABLE $database1 ADD `previewtime$x` text;";
$result7 = $conn->query($sql7);
	$sql1 = "UPDATE  $database1 SET previewtimetable$x='$database3' WHERE name='$teachers';";
$result1 = $conn->query($sql1);
$sql9 = "UPDATE  $database1 SET previewtime$x='$database4' WHERE name='$teachers';";
$result9 = $conn->query($sql9);
echo "$teachers can now able preview timetable";
$x=$x+1;
$sql5 = "UPDATE `$database1` SET `timecounts` = '$x' WHERE name='$teachers'";
$result5 = $conn->query($sql5);	
	$a=0;
}else{
	echo "$teachers is already able preview timetable";
}
}else{
	echo "$teachers is already able preview timetable";
}	
}
}

for($i=1;$i<=$n;)
{
	if($teacher[$i] != ""){	
	$sql1="SELECT timecounts FROM $database1 WHERE name='$teacher[$i]'";
$result1 = $conn->query($sql1);
if($result1 != ""){
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$timecounts     =	 $row1['timecounts'];
		}
}
$sql5="SELECT username FROM $database1 where name='$teacher[$i]'";
$result5 = $conn->query($sql5);
if ($result5->num_rows > 0) 
{
$x=$timecounts;
$teachers=$teacher[$i];
timetableinsert($x ,$database1 ,$database3,$teachers,$conn,$database4);

}else{
	echo "$teacher[$i] username is invaild";
}
}else{
	$sql4 = "ALTER TABLE $database1 ADD `timecounts` INT(11);";
$result4 = $conn->query($sql4);
	$x=1;
	$sql5 = "UPDATE `$database1` SET `timecounts` = '$x'";
$result5 = $conn->query($sql5);	
	$teachers=$teacher[$i];
timetableinsert($x ,$database1 ,$database3,$teachers,$conn,$database4);
}

}else{
	echo  "PLEASE ENTER TEACHER NAME AT FIELD $i";
	}

$i++;
}
	
$sql6="SELECT previewtimetable1 FROM $database2 where `previewtimetable1` = '$database3'";
$result6 = $conn->query($sql6);
if ($result6->num_rows > 0) 
{
    // output data of each row
    while($row6 = $result6->fetch_array())
		{
			$rows6		=	 $row6['previewtimetable1'];
		}
		if($rows6 == null){
	$sql2 = "UPDATE  $database2 SET previewtimetable1='$database3' WHERE  `class` = '$class'";
$result2 = $conn->query($sql2);
$sql3 = "UPDATE  $database2 SET previewtime1='$database4' WHERE  `class` = '$class'";
$result3 = $conn->query($sql3);
if($result2 != "")
{
	echo  "all $class can now able preview timetable";
}
}
}else{
	
	$sql2 = "UPDATE  $database2 SET previewtimetable1='$database3' WHERE  `class` = '$class'";
$result2 = $conn->query($sql2);
$sql3 = "UPDATE  $database2 SET previewtime1='$database4' WHERE  `class` = '$class'";
$result3 = $conn->query($sql3);
if($result2 != "")
{
	echo  "all $class can now able preview timetable";
}

}

}
$sql3 = "INSERT INTO $database1 (previewtimetable1) VALUES ('$database3')";
$result3 = $conn->query($sql3);
$sql4 = "INSERT INTO $database2 (previewtimetable1) VALUES ('$database3')";
$result4 = $conn->query($sql4);
if($result4 == "")
{
	$sql5 = "ALTER TABLE $database1 ADD `previewtimetable1` text ;";
$result5 = $conn->query($sql5);
$sql6 = "ALTER TABLE $database1 ADD `previewtime1` text ;";
$result6 = $conn->query($sql6);
}
if($result3 == "")
{
		$sql6 = "ALTER TABLE $database2 ADD `previewtimetable1` text ;";
$result6 = $conn->query($sql6);
$sql7 = "ALTER TABLE $database2 ADD `previewtime1` text ;";
$result7 = $conn->query($sql7);
}
				
echo $results=addingloop($database1,$database2,$database3,$class, $conn ,$database4);

$button=previewtimetabletoallbutton();
}else					
if(isset($_POST['previewtimetable']))
{
	$_SESSION['classnames'] = $_POST['classname'];
$_SESSION['classdivs'] = $_POST['classdiv'];
            $button='
				<form method="POST" action="previewtimetable.php"><button 
<button id="add" type=submit style="width:10%;float:right;margin-right:2%;" name=back type=submit >back</button></form>
				
					';
}
else if(isset($_POST['previewtimetableall'])) {
$_SESSION['classnames'] = $_POST['classname'];
$_SESSION['classdivs'] = $_POST['classdiv'];
$button=previewtimetabletoallbutton();	
}else if (isset($_POST['printtimetable']))
{
	$_SESSION['classnames'] = $_POST['classname'];
$_SESSION['classdivs'] = $_POST['classdiv'];

$button='<button name=printtimetable type=submit onclick="printFunction()" style="width:10%;float:right;background-color:black;margin-right:50%;">print</button>
					
		<form method="POST" action="previewtimetable.php">			
		<button name=back type=submit style="width:10%;float:left;background-color:black;margin-left:2%;">back</button>
		</form>';
					
}else{
	header('Location:adminhome.php');
}	
if(isset($_POST['back']))
{
	header('Location:adminhome.php');
}

$classname  = $_SESSION['classnames'];
$classdiv  = $_SESSION['classdivs'];
if(($classname == "") & ($classdiv == ""))
{
	header('Location:adminhome.php');
	$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="PLEASE INSERT CLASS NAME AND CLASS DIV PROPER AND TRY IT AGAIN"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
}
$database1=$login_session."_".$classname.$classdiv."details";
$database2=$login_session."_".$classname.$classdiv."timetable";

 $query1="SELECT starttimehrs FROM $database1";
	$result1 = $conn->query($query1);
	$query2="SELECT name FROM $database2";
	$result2 = $conn->query($query2);
	
if(($result1  != "" ) && ($result2  != ""))
{
	$sql6 = "SELECT * FROM admininformation WHERE adminid='$user_check'";
$result6 = $conn->query($sql6);
if ($result6->num_rows > 0) 
{
	// output data of each row
	while($row6 = $result6->fetch_array()) 
	{
		$rows6[]=$row6;
	}
}
$rows=array();
$rows1=array();
$sql1 = "SELECT * FROM $database2";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) 
{
	// output data of each row
	while($row1 = $result1->fetch_array()) 
	{
		$rows[]=$row1;
	}
}

$sql2="SELECT * FROM $database1";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) 
{
    // output data of each row
    while($row2 = $result2->fetch_array())
		{
			$totallecture 		=	 $row2['totallecture'];
			$starttimehrss 		=	 $row2['starttimehrs'];
			$starttimemins 		= 	$row2['starttimemin']; 
			$endtimehrss   		= 	$row2['endtimehrs']; 
			$endtimemins   		= 	$row2['endtimemin']; 
			$recesstarthrs1s 	= 	$row2['recessstarthrs1']; 
			$recessstartmin1s 	= 	$row2['recessstartmin1']; 
			$recessendhrs1s 	= 	$row2['recessendhrs1']; 
			$recessendmin1s 	= 	$row2['recessendmin1']; 
			$recessstarthrs2s 	= 	$row2['recessstarthrs2']; 
			$recessstartmin2s 	= 	$row2['recessstartmin2']; 
			$recessendhrs2s 	= 	$row2['recessendhrs2']; 
			$recessendmin2s 	= 	$row2['recessendmin2']; 
			$recessess 			= 	$row2['recesses']; 
			$dailyperiods 		= 	$row2['dailyperiod']; 
			$saturdays			= 	$row2['saturday']; 
			$halfdays 			= 	$row2['halfday']; 
			$saturdayperiods 	= 	$row2['saturdayperiod']; 
			$dailyperiod		= 	$row2['dailyperiod']; 
			$saturday			= 	$row2['saturday']; 
			$saturdayperiod 	= 	$row2['saturdayperiod']; 
			$halfday 			= 	$row2['halfday'];	
			$amorpm 			= 	$row2['amorpm'];
			$amorpm1 			= 	$row2['amorpm1'];
			$amorpm2 			= 	$row2['amorpm2'];
			$amorpm3 			= 	$row2['amorpm3'];
			$amorpm4 			= 	$row2['amorpm4'];
			$amorpm5 			= 	$row2['amorpm5'];
		}
}
$sql6 = "SELECT * FROM admininformation WHERE adminid='$user_check'";
$result6 = $conn->query($sql6);
if ($result6->num_rows > 0) 
{
	// output data of each row
	while($row6 = $result6->fetch_array()) 
	{
		$rows6=$row6;
	}
}


$m1="";
$k=-1;
$j=1;
$inc1=0;
$inc2=0;
$inc3=0;
$recess=$recessess; 	
$mycount=-1;

if(($saturday == 0)&($halfday == 1)){
	$k=$saturdayperiod-1;
	$stoploop=$saturdayperiod;
	$myrows=array();
	$myrows1=array();
$sql1 = "SELECT * FROM $database2 limit $stoploop";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) 
{
	// output data of each row
	while($row1 = $result1->fetch_array()) 
	{
		$myrows[]=$row1;
	}
}
    }	


$time1=array();
$time2=array();
$time3=array();

$k1=": ".$starttimemins;
$k2=": ".$recessstartmin1s;
$k3=": ".$recessendmin1s;
$k4=": ".$recessstartmin2s;
$k5=": ".$recessendmin2s;
$k6=": ".$endtimemins;

$st1=$starttimehrss;
$st2=$recessendhrs1s;
$st3=$recessendhrs2s;

$et1=$recesstarthrs1s;
$et2=$recessstarthrs2s;
$et3=$endtimehrss;

$m3=$amorpm;
$m4=$amorpm1;
$m5=$amorpm2;
$m6=$amorpm3;
$m7=$amorpm4;
$m8=$amorpm5;


 if($recess == "1")
 {
for($i=$st1;$i<$et1;)
{
	$i=$i+$j;
	$time1[$inc1]=$i;
	$inc1++;
	$times1=$inc1;
}


for($i=$st2;$i<$et3;)
{
	$i=$i+$j;
	$time2[$inc2]=$i;
	$inc2++;
	$times2=$i;
	$times2=$inc2;
}
 }
 else
 {
	 for($i=$st1;$i<$et1;)
{
	$i=$i+$j;
	$time1[$inc1]=$i;
	$inc1++;
	$times1=$inc1;
}

for($i=$st2;$i<$et2;)
{
	$i=$i+$j;
	$time2[$inc2]=$i;
	$inc2++;
	$times2=$inc2;
}

for($i=$st3;$i<$et3;)
{
	$i=$i+$j;
	$time3[$inc3]=$i;
	$inc3++;
	$times3=$inc3;
}
}

if(null != $rows)
{
if($saturday == "0"){
	$day="<th>Saturday</th>";
	$recesscol="<td  colspan=6><center>recess</center></td>";
	}else{
	$day="";
	$recesscol="<td  colspan=5><center>recess</center></td>";}
echo'<br><br>
<b style="font-size:120%">
<h4 style="text-transform: uppercase">'.$rows6["institutefullname"].'('.$rows6["institutecode"].')<br>
'.$rows6["instituteadress"].', '.$rows6["institutecountry"].', '.$rows6["institutestate"].',<br> '.$rows6["institutecity"].', '.$rows6["institutetown"].', '.$rows6["institutedistrict"].'-'.$rows6["institutepincode"].'
<br>
<p style="float:left">'.$classname."-".$classdiv.'</p>
</b>
</p></h4>
<br>
</table>
<table style="width:100%" border="1px">
<center>
  <tr>
    <th>Time</th>
    <th>Monday</th> 
    <th>Tuesday</th>
	<th>Wednesday</th> 
    <th>Thursday</th>
	<th>Friday</th> 
	'.$day;
	for($i=0;$i<$times1;)
{
	$a=$k+1;
	$b=$k+2;
	$c=$k+3;
	$d=$k+4;
	$e=$k+5;
	$f=$k+6;
	$k=$e;
	if($saturday == "0"){
		if(($saturday == 0)&($halfday == 1)){
	if($mycount != $stoploop)	
	{		
	$f=$mycount+1;
	$mycount=$f;
	}
	$k=$e;
    }else{
	$k=$f;
	}
	}
	$y2=$time1[$i];
	if($y2 <= 11){
			$m1="Am";
			}else{$m1="Pm";}

	$x=$i-1;
	if($x == -1)
	{
		
		$firsttime1="<tr>
		<td> $st1 $k1 $m3 &nbsp - &nbsp $time1[$i] $k1 $m1</td>
		<td>".$rows[$a]['name']."(".$rows[$a]['type'].")<br>".$rows[$a]['teacher']."</td>
		<td>".$rows[$b]['name']."(".$rows[$b]['type'].")<br>".$rows[$b]['teacher']."</td>
		<td>".$rows[$c]['name']."(".$rows[$c]['type'].")<br>".$rows[$c]['teacher']."</td>
		<td>".$rows[$d]['name']."(".$rows[$d]['type'].")<br>".$rows[$d]['teacher']."</td>
		<td>".$rows[$e]['name']."(".$rows[$e]['type'].")<br>".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
		}else{
			$period="<td>".$rows[$f]['name']."(".$rows[$f]['type'].")<br>".$rows[$f]['teacher']."</td>";
			}
		}else{$period="";}
		"</tr>";
		echo $firsttime1.$period;
	}else{
$y2=$time1[$x];
	if($y2 <= 11){
			$m2="Am";
			}else{$m2="Pm";}		
	$firsttime="<tr>
	       <td> $time1[$x] $k1 $m2 &nbsp - &nbsp $time1[$i] $k1 $m1 </td>
		   <td>".$rows[$a]['name']."(".$rows[$a]['type'].")<br>".$rows[$a]['teacher']."</td>
		<td>".$rows[$b]['name']."(".$rows[$b]['type'].")<br>".$rows[$b]['teacher']."</td>
		<td>".$rows[$c]['name']."(".$rows[$c]['type'].")<br>".$rows[$c]['teacher']."</td>
		<td>".$rows[$d]['name']."(".$rows[$d]['type'].")<br>".$rows[$d]['teacher']."</td>
		<td>".$rows[$e]['name']."(".$rows[$e]['type'].")<br>".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
		}else{
			$period="<td>".$rows[$f]['name']."(".$rows[$f]['type'].")<br>".$rows[$f]['teacher']."</td>";
			}
		}else{$period="";}
		"</tr>";
	echo $firsttime.$period;}
	$i++;
}
if($st2 != "")
{
	echo "<tr><td> $et1 $k2 $m5 &nbsp - &nbsp $st2 $k3 $m6</td>".$recesscol."</tr>";
}

for($i=0;$i<$times2;)
{
	$a=$k+1;
	$b=$k+2;
	$c=$k+3;
	$d=$k+4;
	$e=$k+5;
	$f=$k+6;
	$k=$e;
	if($saturday == "0"){
		if(($saturday == 0)&($halfday == 1)){
	if($mycount != $stoploop)	
	{		
	$f=$mycount+1;
	$mycount=$f;
	}
	$k=$e;
    }else{
	$k=$f;
	}
	}
	
	$x=$i-1;

	$y2=$time2[$i];
	if($y2 <= 11){
			$m1="Am";
			}else{$m1="Pm";}

	if($x == -1)
	{
		$firsttime1="<tr>
		<td> $st2 $k3 $m6 &nbsp - &nbsp $time2[$i] $k3 $m1 </td>
		<td>".$rows[$a]['name']."(".$rows[$a]['type'].")<br>".$rows[$a]['teacher']."</td>
		<td>".$rows[$b]['name']."(".$rows[$b]['type'].")<br>".$rows[$b]['teacher']."</td>
		<td>".$rows[$c]['name']."(".$rows[$c]['type'].")<br>".$rows[$c]['teacher']."</td>
		<td>".$rows[$d]['name']."(".$rows[$d]['type'].")<br>".$rows[$d]['teacher']."</td>
		<td>".$rows[$e]['name']."(".$rows[$e]['type'].")<br>".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
		}else{
			$period="<td>".$rows[$f]['name']."(".$rows[$f]['type'].")<br>".$rows[$f]['teacher']."</td>";
			}
		}else{$period="";}
		"</tr>";
		echo $firsttime1.$period;
	}else{$y2=$time2[$x];
	if($y2 <= 11){
			$m2="Am";
			}else{$m2="Pm";}
		      $firsttime="<tr>
	       <td> $time2[$x] $k3 $m2 &nbsp - &nbsp $time2[$i] $k3 $m1</td>
		   <td>".$rows[$a]['name']."(".$rows[$a]['type'].")<br>".$rows[$a]['teacher']."</td>
		<td>".$rows[$b]['name']."(".$rows[$b]['type'].")<br>".$rows[$b]['teacher']."</td>
		<td>".$rows[$c]['name']."(".$rows[$c]['type'].")<br>".$rows[$c]['teacher']."</td>
		<td>".$rows[$d]['name']."(".$rows[$d]['type'].")<br>".$rows[$d]['teacher']."</td>
		<td>".$rows[$e]['name']."(".$rows[$e]['type'].")<br>".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
		}else{
			$period="<td>".$rows[$f]['name']."(".$rows[$f]['type'].")<br>".$rows[$f]['teacher']."</td>";
			}
		}else{$period="";}
		"</tr>";
	echo $firsttime.$period;}
	$i++;
}
if($st3 != "")
{
	echo "<tr><td> $et2 $k4 $m7&nbsp - &nbsp $st3 $k5 $m8</td>".$recesscol."</tr>";
}

if($recess != "1")
 {
for($i=0;$i<$times3;)
{
	$a=$k+1;
	$b=$k+2;
	$c=$k+3;
	$d=$k+4;
	$e=$k+5;
	$f=$k+6;
	$k=$e;
	if($saturday == "0"){
		if(($saturday == 0)&($halfday == 1)){
	if($mycount != $stoploop)	
	{		
	$f=$mycount+1;
	$mycount=$f;
	}
	$k=$e;
    }else{
	$k=$f;
	}
	}
	$y2=$time3[$i];
	if($y2 <= 11){
			$m1="Am";
			}else{$m1="Pm";}

	$x=$i-1;
	if($x == -1)
	{
		$firsttime1="<tr>
		<td> $st3 $k5 $m8 &nbsp - &nbsp $time3[$i] $k6 $m1</td>
		<td>".$rows[$a]['name']."(".$rows[$a]['type'].")<br>".$rows[$a]['teacher']."</td>
		<td>".$rows[$b]['name']."(".$rows[$b]['type'].")<br>".$rows[$b]['teacher']."</td>
		<td>".$rows[$c]['name']."(".$rows[$c]['type'].")<br>".$rows[$c]['teacher']."</td>
		<td>".$rows[$d]['name']."(".$rows[$d]['type'].")<br>".$rows[$d]['teacher']."</td>
		<td>".$rows[$e]['name']."(".$rows[$e]['type'].")<br>".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
		}else{
			$period="<td>".$rows[$f]['name']."(".$rows[$f]['type'].")<br>".$rows[$f]['teacher']."</td>";
			}
		}else{$period="";}
		"</tr>";
		echo $firsttime1.$period;
	}else{
		$y2=$time3[$x];
	if($y2 <= 11){
			$m2="Am";
			}else{$m2="Pm";}
		$firsttime="<tr>
	       <td> $time3[$x] $k6 $m2 &nbsp - &nbsp $time3[$i] $k6 $m1</td>
		   <td>".$rows[$a]['name']."(".$rows[$a]['type'].")<br>".$rows[$a]['teacher']."</td>
		<td>".$rows[$b]['name']."(".$rows[$b]['type'].")<br>".$rows[$b]['teacher']."</td>
		<td>".$rows[$c]['name']."(".$rows[$c]['type'].")<br>".$rows[$c]['teacher']."</td>
		<td>".$rows[$d]['name']."(".$rows[$d]['type'].")<br>".$rows[$d]['teacher']."</td>
		<td>".$rows[$e]['name']."(".$rows[$e]['type'].")<br>".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
		}else{
			$period="<td>".$rows[$f]['name']."(".$rows[$f]['type'].")<br>".$rows[$f]['teacher']."</td>";
			}
		}else{$period="";}
		"</tr>";
	echo $firsttime.$period;}
	$i++;
}
 }
 '</center>
 </table>
 
';
}
}else{
	if($result1  == "" ) 
       {
		   $data="TIME DETAILS";
	   }
     if($result2  == ""){
		   $data="SUBJECT ";
	   }
	   if(($result1  != "" ) && ($result2  != ""))
{
	 $data="TIME DETAILS AND SUBJECT  ";
}
header('Location:adminhome.php');
	$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="'.$classname.$classdiv.' CLASS '.$data.' NOT FOUND . INSERT '.$classname.$classdiv.' CLASS '.$data.' PROPER AND TRY IT AGAIN"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
}

?>
</td></tr>
			</table> 
			</table> 
		
			<div id=myhidediv3>
				
					<?php echo $button; ?>
					
					</div>
				
			</section>
		</div>
         </div>
		  </div>
      </div>
	  <div id=myhidediv4 style="color:black;">
<?php
include ("footer.php");
?>	
			</div> 	
			<script type="text/javascript">
$a=2;
$f=1;
  $(function() {
      $("#adds").click(function() {
		  $g=$f++;
		  $ans=document.getElementById("teacher"+$g+"").value;
		  if($ans != "")
		  {
		  $b=$a++;
		  document.getElementById("loopvalue").value = $b;
          div = document.createElement("div");
          $(div).addClass("").html("<tr><td colspan=3>teacher name "+$b+"</td><td colspan=3><input type=text id=teacher"+$b+" name=teacher"+$b+" placeholder=Enter teacher name></td> </tr>");
          $("#container").append(div);
		   bottomFunction();
		  }else{
			  $f=$g--;
		  }
        });
    });
	$scroll=0;
	function bottomFunction() {
		$scroll=$scroll+300;
    document.body.scrollTop = $scroll;
    document.documentElement.scrollTop = $scroll;
}

			function printFunction() {	
			      $('td').addClass('colors');
				  $('tr').addClass('colors');
				  $('#myhidediv4').addClass('hides');
                  $('#myhidediv3').addClass('hides');
				  $('#myhidediv2').addClass('hides');
				  $('#myhidediv1').addClass('hides');

			 if (window.print) {
            window.print();
			  location.reload();
        }
		}
</script>
</body>
</html>