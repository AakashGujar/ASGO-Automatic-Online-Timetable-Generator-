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

</style>
<body onload="bottomFunction()">
<?php
include ("connection.php");
include('session.php');
include('userheader.php');
$classname  = $_SESSION['classnames'];
$classdiv  = $_SESSION['classdivs'];

if(($classname == "") & ($classdiv == ""))
{
	header('Location:adminhome.php');
	$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="please insert class name and class div proper and try it again"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
}
$database1=$login_session."_".$classname.$classdiv."details";
$database2=$login_session."_".$classname.$classdiv."timetable";
$count=0;
	
if(isset($_POST['excange']))
	{
		 $id1=$_POST['id1'];
		 $id2=$_POST['id2'];
		$sql1 = "SELECT * FROM $database2  WHERE srno='$id1'";
$result1 = $conn->query($sql1);	
$sql2 = "SELECT * FROM $database2  WHERE srno='$id2'";
$result2 = $conn->query($sql2);	
if(($result1 != "")&($result2 != ""))
{
	if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$subject1 	  =		$row1['name'];
			$teacher1     =		$row1['teacher'];
			$type1  	  =		$row1['type'];
		}
}
if ($result2->num_rows > 0) 
{
    // output data of each row
    while($row2 = $result2->fetch_array())
		{
			$subject2 	  =		$row2['name'];
			$teacher2     =		$row2['teacher'];
			$type2  	  =		$row2['type'];
		}
}	
		
	$sql4 = "UPDATE  $database2 SET name='$subject1',teacher='$teacher1',type='$type1'  WHERE srno='$id2'";
$result4 = $conn->query($sql4);	
$sql5 = "UPDATE  $database2 SET name='$subject2',teacher='$teacher2',type='$type2'  WHERE srno='$id1'";
$result5 = $conn->query($sql5);	
if(($result4 != "")&($result5 != ""))
{
	include("error4.php");$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="subject updated"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
	}else	{
	include("error4.php");$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="try it again"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
	}}else	{
	include("error4.php");$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="Fill ids porperly"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
	}}
?>
<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section >
<div id="timetable">
     <fieldset >
        <legend>TIMETABLE PREVIEW</legend> 
		<fieldset style="width:99.9%">
        <legend>EDDITABLE TIMETABLE PREVIEW</legend>
           <form method="POST" action="timetablepreview.php"> 
				<table border="0"> 
		<div class="pos" id="error4"><?php include("error4.php");$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error=""; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);?></div>			
					<tr><td><?php
		


 $query1="SELECT starttimehrs FROM $database1";
	$result1 = $conn->query($query1);
	$query2="SELECT name FROM $database2";
	$result2 = $conn->query($query2);
	
if(($result1  != "" ) && ($result2  != ""))
{
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
		$rows1[]=$row1[1];
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

if(isset($_POST['next']))
	{
		header('Location:timetablesave.php');
	}



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
		<td>"."id:     ".$rows[$a]['srno']."<br>subject name: ".$rows[$a]['name']."(".$rows[$a]['type'].")<br>teacher name: ".$rows[$a]['teacher']."</td>
		<td>"."id:     ".$rows[$b]['srno']."<br>subject name: ".$rows[$b]['name']."(".$rows[$b]['type'].")<br>teacher name: ".$rows[$b]['teacher']."</td>
		<td>"."id:     ".$rows[$c]['srno']."<br>subject name: ".$rows[$c]['name']."(".$rows[$c]['type'].")<br>teacher name: ".$rows[$c]['teacher']."</td>
		<td>"."id:     ".$rows[$d]['srno']."<br>subject name: ".$rows[$d]['name']."(".$rows[$d]['type'].")<br>teacher name: ".$rows[$d]['teacher']."</td>
		<td>"."id:     ".$rows[$e]['srno']."<br>subject name: ".$rows[$e]['name']."(".$rows[$e]['type'].")<br>teacher name: ".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>"."id:     ".$myrows[$f]['srno']."<br>subject name: ".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>teacher name: ".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
	
		}else{
			$period="<td>"."id:     ".$rows[$f]['srno']."<br>subject name: ".$rows[$f]['name']."(".$rows[$f]['type'].")<br>teacher name: ".$rows[$f]['teacher']."</td>";
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
		   <td>"."id:     ".$rows[$a]['srno']."<br>subject name: ".$rows[$a]['name']."(".$rows[$a]['type'].")<br>teacher name: ".$rows[$a]['teacher']."</td>
		<td>"."id:     ".$rows[$b]['srno']."<br>subject name: ".$rows[$b]['name']."(".$rows[$b]['type'].")<br>teacher name: ".$rows[$b]['teacher']."</td>
		<td>"."id:     ".$rows[$c]['srno']."<br>subject name: ".$rows[$c]['name']."(".$rows[$c]['type'].")<br>teacher name: ".$rows[$c]['teacher']."</td>
		<td>"."id:     ".$rows[$d]['srno']."<br>subject name: ".$rows[$d]['name']."(".$rows[$d]['type'].")<br>teacher name: ".$rows[$d]['teacher']."</td>
		<td>"."id:     ".$rows[$e]['srno']."<br>subject name: ".$rows[$e]['name']."(".$rows[$e]['type'].")<br>teacher name: ".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>"."id:     ".$myrows[$f]['srno']."<br>subject name: ".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>teacher name: ".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
	
		}else{
			$period="<td>"."id:     ".$rows[$f]['srno']."<br>subject name: ".$rows[$f]['name']."(".$rows[$f]['type'].")<br>teacher name: ".$rows[$f]['teacher']."</td>";
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
		<td>"."id:     ".$rows[$a]['srno']."<br>subject name: ".$rows[$a]['name']."(".$rows[$a]['type'].")<br>teacher name: ".$rows[$a]['teacher']."</td>
		<td>"."id:     ".$rows[$b]['srno']."<br>subject name: ".$rows[$b]['name']."(".$rows[$b]['type'].")<br>teacher name: ".$rows[$b]['teacher']."</td>
		<td>"."id:     ".$rows[$c]['srno']."<br>subject name: ".$rows[$c]['name']."(".$rows[$c]['type'].")<br>teacher name: ".$rows[$c]['teacher']."</td>
		<td>"."id:     ".$rows[$d]['srno']."<br>subject name: ".$rows[$d]['name']."(".$rows[$d]['type'].")<br>teacher name: ".$rows[$d]['teacher']."</td>
		<td>"."id:     ".$rows[$e]['srno']."<br>subject name: ".$rows[$e]['name']."(".$rows[$e]['type'].")<br>teacher name: ".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>"."id:     ".$myrows[$f]['srno']."<br>subject name: ".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>teacher name: ".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
	
		}else{
			$period="<td>"."id:     ".$rows[$f]['srno']."<br>subject name: ".$rows[$f]['name']."(".$rows[$f]['type'].")<br>teacher name: ".$rows[$f]['teacher']."</td>";
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
		   <td>"."id:     ".$rows[$a]['srno']."<br>subject name: ".$rows[$a]['name']."(".$rows[$a]['type'].")<br>teacher name: ".$rows[$a]['teacher']."</td>
		<td>"."id:     ".$rows[$b]['srno']."<br>subject name: ".$rows[$b]['name']."(".$rows[$b]['type'].")<br>teacher name: ".$rows[$b]['teacher']."</td>
		<td>"."id:     ".$rows[$c]['srno']."<br>subject name: ".$rows[$c]['name']."(".$rows[$c]['type'].")<br>teacher name: ".$rows[$c]['teacher']."</td>
		<td>"."id:     ".$rows[$d]['srno']."<br>subject name: ".$rows[$d]['name']."(".$rows[$d]['type'].")<br>teacher name: ".$rows[$d]['teacher']."</td>
		<td>"."id:     ".$rows[$e]['srno']."<br>subject name: ".$rows[$e]['name']."(".$rows[$e]['type'].")<br>teacher name: ".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>"."id:     ".$myrows[$f]['srno']."<br>subject name: ".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>teacher name: ".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
	
		}else{
			$period="<td>"."id:     ".$rows[$f]['srno']."<br>subject name: ".$rows[$f]['name']."(".$rows[$f]['type'].")<br>teacher name: ".$rows[$f]['teacher']."</td>";
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
		<td>"."id:     ".$rows[$a]['srno']."<br>subject name: ".$rows[$a]['name']."(".$rows[$a]['type'].")<br>teacher name: ".$rows[$a]['teacher']."</td>
		<td>"."id:     ".$rows[$b]['srno']."<br>subject name: ".$rows[$b]['name']."(".$rows[$b]['type'].")<br>teacher name: ".$rows[$b]['teacher']."</td>
		<td>"."id:     ".$rows[$c]['srno']."<br>subject name: ".$rows[$c]['name']."(".$rows[$c]['type'].")<br>teacher name: ".$rows[$c]['teacher']."</td>
		<td>"."id:     ".$rows[$d]['srno']."<br>subject name: ".$rows[$d]['name']."(".$rows[$d]['type'].")<br>teacher name: ".$rows[$d]['teacher']."</td>
		<td>"."id:     ".$rows[$e]['srno']."<br>subject name: ".$rows[$e]['name']."(".$rows[$e]['type'].")<br>teacher name: ".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>"."id:     ".$myrows[$f]['srno']."<br>subject name: ".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>teacher name: ".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
	
		}else{
			$period="<td>"."id:     ".$rows[$f]['srno']."<br>subject name: ".$rows[$f]['name']."(".$rows[$f]['type'].")<br>teacher name: ".$rows[$f]['teacher']."</td>";
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
		   <td>"."id:     ".$rows[$a]['srno']."<br>subject name: ".$rows[$a]['name']."(".$rows[$a]['type'].")<br>teacher name: ".$rows[$a]['teacher']."</td>
		<td>"."id:     ".$rows[$b]['srno']."<br>subject name: ".$rows[$b]['name']."(".$rows[$b]['type'].")<br>teacher name: ".$rows[$b]['teacher']."</td>
		<td>"."id:     ".$rows[$c]['srno']."<br>subject name: ".$rows[$c]['name']."(".$rows[$c]['type'].")<br>teacher name: ".$rows[$c]['teacher']."</td>
		<td>"."id:     ".$rows[$d]['srno']."<br>subject name: ".$rows[$d]['name']."(".$rows[$d]['type'].")<br>teacher name: ".$rows[$d]['teacher']."</td>
		<td>"."id:     ".$rows[$e]['srno']."<br>subject name: ".$rows[$e]['name']."(".$rows[$e]['type'].")<br>teacher name: ".$rows[$e]['teacher']."</td>
		";
		if($saturday == 0){
			if(($saturday == 0)&($halfday == 1)){
				if($mycount != $stoploop)	
			{	
				$period="<td>"."id:     ".$myrows[$f]['srno']."<br>subject name: ".$myrows[$f]['name']."(".$myrows[$f]['type'].")<br>teacher name: ".$myrows[$f]['teacher']."</td>";
			}else{
					$period="<td></td>";
				}
	
		}else{
			$period="<td>"."id:     ".$rows[$f]['srno']."<br>subject name: ".$rows[$f]['name']."(".$rows[$f]['type'].")<br>teacher name: ".$rows[$f]['teacher']."</td>";
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
}

?>
</td></tr>
 
					<tr>
<td colspan="7">subject exchange section</td>
</tr>
					<tr> 
<td colspan="2">first Subject information</td>
<td colspan="2">second Subject information</td>
<td rowspan=3 colspan=3"><h5 style="color:black;">Instruction<h5>
<ol style="color:black;text-align: left;">
<li>To exchange subject follow following step</li>
<ol type=i style="color:black;text-align: left;">
<li>write subject id of subject which you want to raplace in first id no box</li>
<li>write subject id of subject which you want to raplace with first subject in second id no box</li>
<li>then click on excange subject button</li>
<ol>
<ol>
</td>
				</tr> 
				<tr> 
						<td>first id no</td>
						<td colspan=1><input type=text name=id1 placeholder="Enter Id" autofocus></td>

						<td>second id no</td>
						<td colspan=1><input type=text name=id2 placeholder="Enter Id"></td>
					</tr> 
					<tr>
					<td colspan="2"><button name=excange type=submit >Excange subjects</button></td>
					
					<td colspan="2"><button name=next type=submit >next(save page)</button></td>
					</tr>
				</table> 
				</table> 	 
			</form> 
				</fieldset>
		</fieldset>
			</div> 	
			</section>
		
            </div>
         </div>
      </div>
	  
	   
	
			<script>
			function bottomFunction() {
			$scroll=500;
    document.body.scrollTop = $scroll;
    document.documentElement.scrollTop = $scroll;
			}
</script>
</body>
</html>
  <?php
include ("footer.php");
?>