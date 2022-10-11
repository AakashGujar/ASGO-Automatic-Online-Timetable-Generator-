<?php
include('session.php');
include('userheader.php');
?>
<!DOCTYPE html>
<html>
<style>body{color:black;}

	input[type=submit]
	{	
		display: inline-block;
		padding: 0.9% 1.5%;
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
		position:relative;
		margin:01% 28% 1% 1%;
	}

	input[type=submit]:hover
	{
		background-color: #2b4c6;
	}

	input[type=submit]:active
	{
		background-color: #2b4c61;
		box-shadow: 0 2px #666;
		transform: translateY(2px);
	}

</style>
<body>

<?php
$error1="";
$error="";
$n=0;
$database1=$login_session."_subjects"; 
 $srnos=0;
 
$formupload='<form  method="post" enctype="multipart/form-data" action="addsubjects.php">
<table border:none;>
<tr>
	<td colspan=2>Add subject</td>
	</tr>
    <tr>
	<td colspan=2>name of the subject</td>
	</tr>
	<tr>
    <td colspan=2><input type="text" name="subject" id="subject" placeholder="enter name of subject"></td>
	</tr>
</table>
<input type="submit" value="back" name="back" ><input type="submit" value="Add subject" name="addsubject" >	
</form>';
$formremove='<form  method="post" enctype="multipart/form-data" action="addsubjects.php">
<table border:none;>
<tr>
	<td colspan=2>Remove subject</td>
	</tr>
<tr>
	<td colspan=2>name of the subject</td>
	</tr>
	<tr>
    <td colspan=2><input type="text" name="subject" id="subject" placeholder="enter name of subject"></td>
	</tr>
</table>
<input type="submit" value="back" name="back"><input type="submit" value="Remove subject" name="removesubject">	
</form>';
if(isset($_POST['addsubjects']))
{
$_SESSION['actiontype']="$formupload";
}
if(isset($_POST['removesubjects']))
{
$_SESSION['actiontype']="$formremove";
}
if(isset($_POST['back']))
{
header('Location:adminhome.php');
$_SESSION['actiontype']="";
}
if(isset($_POST['removesubject']))
{
$subject =$_POST['subject'];
if($subject == "")
{
	 $error= "PLEASE ENTER SUBJECT NAME TO REMOVE";
}else{
$sql5="SELECT subjectname FROM $database1 where subjectname='$subject'";
$result5 = $conn->query($sql5);
if ($result5->num_rows > 0) 
{

$sql2 = "DELETE FROM `$database1` WHERE subjectname='$subject'";
$result2 = $conn->query($sql2);
$sql3 = "ALTER TABLE $database1
DROP srno;";
$result3 = $conn->query($sql3);
$sql4 = "ALTER TABLE $database1 ADD `srno` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`srno`);";
$result4 = $conn->query($sql4);	
$error= "Deleted $subject";

}
else
  {
   $error= "PLEASE SEE BELOW TABLE AND ENTER SUBJECT NAME TO REMOVE";
  }
}
}

if(isset($_POST['addsubject']))
{
	$subjectname =$_POST['subject'];

$query1 = "SELECT * FROM $database1";
$result1 = $conn->query($query1);
if($result1 != "")
{
	$query2 = "SELECT subjectname FROM $database1 WHERE subjectname='$subjectname'";
$result2 = $conn->query($query2);
if ($result2->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result2->fetch_array())
		{
		 $subjectnames    =	 $row1['subjectname'];
		}
}else{
			 $subjectnames="1";
		}
if($subjectnames != $subjectname)
{	
$query3="INSERT INTO $database1(subjectname)VALUES('$subjectname')";
$result3 = $conn->query($query3);
}else{
	$error= "SUBJECT IS ALREADY PRESENT IN LIST";
}
}else{
	
	$sql2 = "CREATE TABLE $database1(
  `srno`INT NOT NULL AUTO_INCREMENT , 
  `subjectname`text,
  PRIMARY KEY (`srno`),
  UNIQUE(`srno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
;";
$result2 = $conn->query($sql2);	

	
$query3="INSERT INTO $database1(subjectname)VALUES('$subjectname')";
$result3 = $conn->query($query3);

}
    }



$srno1		 			= 	array();
$subjectname1				= 	array(); 
$query1 = "SELECT * FROM $database1";
$result1 = $conn->query($query1);
if($result1 != "")
{	
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$srnos		 			= 	$row1['srno']; 
			$srno1[]		 			= 	$row1['srno']; 
			$subjectname1[]					= 	$row1['subjectname']; 		
		}
}
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
	$y=$x+4;
	if($y < $srnos){

$x=$x+4;
updated($conn ,$database1,$x);
	}else{
		if($x > 0){
		$x=$srnos-4;
		}else{
			$x=0;
		}
		updated($conn ,$database1,$x);
	
	}
}
else if(isset($_POST['previous']))
{
	$x=counts($conn ,$database1);
	$x=$x-4;
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
	$x=$srnos-4;
	if($x < -0){
		$x=0;
	}else{
		$x=$srnos-4;
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

?>
<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
 <section class="s-12 l-12">

<div id="file details">


<p><?php echo $_SESSION['actiontype'];
echo $error.$error1;?></p>
<p><?php

$n=$x+4;
if($srnos != 0){
 echo '
<table style="width:100%" border="1px">
<center>
  <tr>
    <th colspan=2>Sr no</th>
    <th colspan=2>subject name</th> 
	</tr>';
for($i=$x;$i<$n;)
{
if($i < $srnos){
	
echo	$row='<tr>
	<td colspan=2>'.$srno1[$i].'</td>
	<td colspan=2>'.$subjectname1[$i].'</td>
	</tr>
	';
}else{
	echo	$row='<tr>
	<td colspan=2>----</td>
	<td colspan=2>----</td>
	</tr>
	';
}
$i++;
}
if($srnos > 4){
echo '<form method="POST" action="addsubjects.php"> <tr >
<td ><button name="previous">&#8249; Previous</button></td>
<td ><button name="first">&laquo; start</button></td>
<td ><button name="last">end &raquo;</button></td>
<td><button name="next">Next &#8250;</button></td>
</tr></form>';

	'</center>
 </table>';
}}else{
echo '
<table style="width:100%" border="1px">
<center>
  <tr>
    <th>Sr no</th>
    <th>subject name</th> 
	</tr>
	<tr>
	<td>No data found</td>
	<td>No data found</td>
	</tr>
</center>
</table >
';
}?></p>

 </div>
 </section>
</table>
</center>	  
  
</body>

</div>
</div>
</div>
<?php
include ("footer.php");
?>
</html>
