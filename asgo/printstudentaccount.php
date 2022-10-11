<!DOCTYPE html>
<style>
tr{
height: 100%;
font-family:Times New Roman;
color:black;
background-color:lightgrey;
text-align:center;
 border: 1px solid black;
}
td{
	width:10%;
	text-align:center;
	background-color:lightgrey;
	 border: 1px solid  black;
	
}
.colors{
	color:black;
	
 border: 1px solid black;
}
table{
	border-collapse: collapse;
	 border: 1px solid black;
}
</style>
<html>
<link rel="stylesheet" href="css/style.css">


<?php
include('session.php');
include('connection.php');
$printstudentaccount=$_SESSION['printstudentaccount'];
if($printstudentaccount != "")
{
	include('userheader.php');
}

?>
  
	<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section>
<div id="Period Details">
<form method="POST" action="printstudentaccount.php"> 
<?php
	
if(isset($_POST['backhome']))
{
	header('Location:adminhome.php');
}

 $database1=$login_session."_studentusers";

 $sql1="SELECT * FROM $database1";
$result1 = $conn->query($sql1);
if($result1 != ""){
$check="1";
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$srno 		    =	 $row1['srno'];
			$rows1[]		=	 $row1['srno'];
			$rows2[]		=	 $row1['class'];
			$rows3[]		=	 $row1['rollno'];
			$rows4[]		=	 $row1['adminusername'];
			$rows5[]		=	 $row1['username'];
			$rows6[]		=	 $row1['password'];
		}
}else{
	$check="";
}
function counts($conn ,$database1){
	$x=0;
	$sql1="SELECT counts FROM $database1 WHERE srno=1";
$result1 = $conn->query($sql1);
if($result1 != ""){
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$counts     =	 $row1['counts'];
		}
}
$x=$counts;
return $x;
}else{
	$sql4 = "ALTER TABLE $database1 ADD `counts` INT(11);";
$result4 = $conn->query($sql4);
$x=0;	
 updated($conn ,$database1,$x);
return $x;	
}

}
function updated($conn ,$database1,$x){
$sql5 = "UPDATE `$database1` SET `counts` = '$x' WHERE `srno` = 1";
$result5 = $conn->query($sql5);	
}
if(isset($_POST['next']))
{
	$x=counts($conn ,$database1);
	$y=$x+20;
	if($y < $srno){

$x=$x+20;
updated($conn ,$database1,$x);
	}else{
		if($x > 0){
		$x=$srno-20;
		}else{
			$x=0;
		}
		updated($conn ,$database1,$x);
	
	}
}
else if(isset($_POST['previous']))
{
	$x=counts($conn ,$database1);
	$x=$x-20;
	if($x >= 0)
		{
	updated($conn ,$database1,$x);
	}else{
		$x=0;
		updated($conn ,$database1,$x);
	}
}
else if(isset($_POST['last']))
{
	$x=counts($conn ,$database1);
	$x=$srno-20;
	if($x < -0){
		$x=0;
	}else{
		$x=$srno-20;
	}
	updated($conn ,$database1,$x);
}
else if(isset($_POST['first']))
{
	$x=counts($conn ,$database1);
	$x=0;
	updated($conn ,$database1,$x);
}else{
	$x=0;;
	updated($conn ,$database1,$x);
	}

if($check != ""){
$srno1 =$x+20;
echo'
<table style="width:100%" border="1px" id=myhidediv6>
<center>
  <tr>
    <th>Sr no</th>
	<th>class</th>
	<th>roll no</th>
	<th>admin name</th> 
    <th>student User id</th> 
    <th>Password</th> 
	</tr>
	';

		for($i=$x;$i<$srno1;)
{
	if($i < $srno){
	$firsttime="<tr>
		   <td>".$rows1[$i]."</td>
		   <td>".$rows2[$i]."</td>
		   <td>".$rows3[$i]."</td>
		<td>".$rows4[$i]."</td>
		<td>".$rows5[$i]."</td>
		<td>".$rows6[$i]."</td>
		";
		echo $firsttime;
	}else{
		$firsttime="<tr>
		   <td>------</td>
		<td>------</td>
		<td>------</td>
		<td>------</td>
		 <td>------</td>
		 <td>------</td>
		</tr>
		";
		echo $firsttime;
	}
	$i++;
}

 '</center>
 </table>
';
}else{
	echo ' <div><tr><td style="border:none;">no student user found</td> </tr></div>';
}}else{
	echo ' <div><tr><td style="border:none;">no student user found</td> </tr></div>';
}
if($srno > 20){
echo '<table >
<tr id=myhidediv1>
<td ><button name="previous">&#8249; Previous</button></td>
<td ><button name="first">&laquo; start</button></td>
<td ><button name="last">end &raquo;</button></td>
<td><button name="next">Next &#8250;</button></td>
</tr></table>';
}


if($printstudentaccount != "")
{
echo '<table ><tr id=myhidediv4 style="background-color:white;border:none;"><td style="background-color:white;border:none;" colspan=2><button style="width:50%;" type=submit name="backhome">back home page</button></td>
<td colspan=2 style="background-color:white;border:none;"><button  style="width:50%;float:left;"  name=print type=submit onclick="printFunction()">print</button></td></tr>
</table>';
}


 $database1=$login_session."_studentusers";

 $sql1="SELECT * FROM $database1";
$result1 = $conn->query($sql1);
if($result1 != ""){
$check="1";
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$srno 		    =	 $row1['srno'];
			$rows1[]		=	 $row1['srno'];
			$rows2[]		=	 $row1['class'];
			$rows3[]		=	 $row1['rollno'];
			$rows4[]		=	 $row1['adminusername'];
			$rows5[]		=	 $row1['username'];
			$rows6[]		=	 $row1['password'];
		}
}else{
	$check="";
}
if($check != ""){
echo'
<table style="width:100%" border="1px" class=hides id=myhidediv7> 
<center>
  <tr>
    <th>Sr no</th>
	<th>class</th>
	<th>roll no</th>
	<th>admin name</th> 
    <th>student User id</th> 
    <th>Password</th> 
</tr>	
	';

		for($i=0;$i<$srno;)
{
	if($i < $srno){
	$firsttime="<tr>
		   <td>".$rows1[$i]."</td>
		   <td>".$rows2[$i]."</td>
		   <td>".$rows3[$i]."</td>
		<td>".$rows4[$i]."</td>
		<td>".$rows5[$i]."</td>
		<td>".$rows6[$i]."</td>
		</tr>
		";
		echo $firsttime;
	}
	$i++;
}

 '</center>
 </table>
';
}
}
?><tr>
</table>
</form>
</section>
            </div>
         </div>
      </div>
 </div>
 <div id=myhidediv8>
<?php
include ("footer.php");
?>
</div>
 <script>
			function printFunction() {	
			      $('td').addClass('colors');
				  $('tr').addClass('colors');
				   $('#myhidediv8').removeClass('hides');
				  $('#myhidediv7').removeClass('hides');
				   $('#myhidediv6').addClass('hides');
				  $('#myhidediv5').addClass('hides');
				  $('#myhidediv4').addClass('hides');
                  $('#myhidediv3').addClass('hides');
				  $('#myhidediv2').addClass('hides');
				  $('#myhidediv1').addClass('hides');

			 if (window.print) {
            window.print();
        }
		}
</script>

</html>