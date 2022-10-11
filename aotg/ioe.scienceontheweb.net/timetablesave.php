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
?>
<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section >
<div id="timetable">
     <fieldset style="width:99%">
        <legend>TIMETABLE PREVIEW</legend> 
		<fieldset style="width:99.7%">
        <legend>TIMETABLE PREVIEW FOR SAVE</legend>
           <form method="POST" action="timetablesave.php"> 
				<table border="0"> 
					
					<tr><td><?php
					
	if(isset($_POST['save']))
	{
		header('Location:adminhome.php');
		$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="timetable save"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
	}
if(isset($_POST['print']))
	{
	header('Location:printpage.php');
	}	
		
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
}

?>
</td></tr>
 
					<tr >
					<td></td>
					
					<td colspan="1" ><button name=save type=submit >save</button></td>
					<td></td>
					<td></td>
					<td colspan="1" ><button name=print type=submit >print</button></td>
					<td></td>
					<?php if($saturday == 0){
						echo '<td></td';
					}
					?>
					</tr>
				</table> 
				</table> 
				</div> 
			</form> 
				</fieldset>
		</fieldset>
			</div> 
	</section>
		</div>
         </div>
      </div>
<?php
include ("footer.php");
?>	  
			<script>
			function bottomFunction() {
			$scroll=500;
    document.body.scrollTop = $scroll;
    document.documentElement.scrollTop = $scroll;
			}
		function printFunction() {	
                  $('#myhidediv').addClass('hides');
			 if (window.print) {
            window.print();
        }
		}
</script>
</body>
</html>