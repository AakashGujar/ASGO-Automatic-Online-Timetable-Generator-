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

</style>
<body>

</div>
<div id="timetable">
    
           
				<table border="0"> 
					
					<tr><td><?php
										
if(isset($_POST['studentpreviewtimetable']))
{
	
            $button='<form method="POST" action="previewtimetableall.php">
			<button style="width:20%;float:left;margin-left:1%;" name=back type=submit class=buttons>back</button></form>';
$check="1";
$x="2";
}
else if(isset($_POST['teacherpreviewtimetable']))
{
	
            $button='<form method="POST" action="previewtimetableall.php">
			<button style="width:20%;float:left;margin-left:1%;" name=back1 type=submit class=buttons>back</button></form>';
			$check="0";
			$sql1="SELECT timecounts FROM $database WHERE username='$user_check'";
$result1 = $conn->query($sql1);
if($result1 != ""){
	$check="1";
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$timecounts     =	 $row1['timecounts'];
		}
}
	$x=$timecounts;
}else{
	$x=2;
}
}
else if (isset($_POST['studentprinttimetable']))
{
	
$button='<td style="border:none;">
		<form method="POST" action="previewtimetableall.php">			
		<button style="width:40%;margin-left:1%;" name=back type=submit class=buttons>back</button>
		</form></td>
		<td style="border:none;"><button style="width:40%;float:left;margin-left:1%;" name=studentprinttimetable type=submit onclick="printFunction()" class=buttons>print</button></td>';
		$check="1";
	$x="2";
				
}else if (isset($_POST['teacherprinttimetable']))
{
	
$button='<td style="border:none;">
		<form method="POST" action="previewtimetableall.php">			
		<button style="width:40%;margin-left:1%;" name=back1 type=submit class=buttons>back</button>
		</form></td><td style="border:none;"><button style="width:40%;float:left;margin-left:1%;" name=teacherprinttimetable type=submit onclick="printFunction()" class=buttons>print</button></td>';
		$check="0";
$sql1="SELECT timecounts FROM $database WHERE username='$user_check'";
$result1 = $conn->query($sql1);
if($result1 != ""){
	$check="1";
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$timecounts     =	 $row1['timecounts'];
		}
}
	$x=$timecounts;
}else{
	$x=2;
}
				
}else{
	header('Location:studenthome.php');
}	
if(isset($_POST['back']))
{
	header('Location:studenthome.php');
}
if(isset($_POST['back1']))
{
	header('Location:teacherhome.php');
}
function doneworking($database,$conn,$j,$button,$user_check){	
$sql6="SELECT previewtimetable$j FROM $database Where username='$user_check'";
$result6 = $conn->query($sql6);
$sql7="SELECT previewtime$j FROM $database Where username='$user_check'";
$result7 = $conn->query($sql7);
if ($result6->num_rows > 0) 
{
    // output data of each row
    while($row6 = $result6->fetch_array())
		{
			$rows6		=	 $row6['previewtimetable'.$j.''];
		}
if ($result7->num_rows > 0) 
{
    // output data of each row
    while($row7 = $result7->fetch_array())
		{
			$rows7		=	 $row7['previewtime'.$j.''];
		}
}	

$database2=$rows6;
$database1=$rows7;

$query1="SELECT * FROM $database1";
	$result1 = $conn->query($query1);
	$query2="SELECT * FROM $database2";
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
		$classname[]=$row1["classname"];
		
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
$adminusername=$_SESSION['login_useradmin'];
$sql6 = "SELECT * FROM admininformation WHERE adminid='$adminusername@aotg.com'";
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
echo'
<table style="width:100%" border="1px">
<br><br>
<b style="font-size:120%">
<h4 style="text-transform: uppercase">'.$rows6["institutefullname"].'('.$rows6["institutecode"].')<br>
'.$rows6["instituteadress"].', '.$rows6["institutecountry"].', '.$rows6["institutestate"].',<br> '.$rows6["institutecity"].', '.$rows6["institutetown"].', '.$rows6["institutedistrict"].'-'.$rows6["institutepincode"].'
<br>
<p style="float:left">'.$classname[0].'</p>
</b>
</p></h4>
<br>
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
}else{
	echo "there is no timetable to preview";
}

}
if($check == 1){
for($j=1;$j<$x;)
{
doneworking($database,$conn,$j,$button,$user_check);

$j++;
}
}else{
	echo "there is no timetable to preview";
}

?>
</td></tr>
 
			</table> 	
<br><br><br>			
				<table id=myhidediv3  class="border:none;">
				<tr style="border:none;"><td style="border:none;"><?php echo $button; ?></td><td style="border:none;"></tr>
			</table> 
				
			</div> 	
			<script>
			function printFunction() {	
			      $('td').addClass('colors');
				  $('tr').addClass('colors');
                  $('#myhidediv3').addClass('hides');
				  $('#myhidediv2').addClass('hides');
				  $('#myhidediv1').addClass('hides');

			 if (window.print) {
            window.print();
			  location.reload();
        }
		}
</script>
</table>
<br>
<div id=myhidediv2>
<?php
include ("footer.php");
?>
</div>
</body>
</html>