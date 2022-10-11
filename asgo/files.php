<!DOCTYPE html>
<html>
<style>body{color:black;}</style>
<body>

<?php
include('session.php');
include('userheader.php');
$error1="";
$error="";
$n=0;
$database1=$login_database."filelist"; 
 $srnos=0;
 
$formupload='<form  method="post" enctype="multipart/form-data" action="files.php">
<table border:none;>
    <tr>
	<td colspan=2>Select image to upload:</td>
	</tr>
	<tr>
    <td colspan=2><input type="file" name="fileToUpload" id="fileToUpload"></td>
	</tr>
	<tr>
	<td colspan=2>file permission:</td>
	</tr>
	<tr>
    <td><input type="radio" value="yes" name="permission" checked>yes</td>
	<td><input type="radio" value="no" name="permission">no</td>
	</tr>
	<tr>
	<td colspan=2><input style="padding:1%;float:right;margin-right:24%; width:10%; "type="submit" value="Upload file" name="upload"> <input style="padding:1%;float:left;margin-left:24%;width:10%;" type="submit" value="back" name="back"></td>
	</tr>
</table>	
</form>';
$formremove='<form  method="post" enctype="multipart/form-data" action="files.php">
<table border:none;>
<tr>
	<td colspan=2>File remove</td>
	</tr>
	<tr>
	<td>file name:</td>
    <td><input type="text"  name="filename"></td>
	</tr>
	<tr>
	<td colspan=2><input type="submit" value="remove file" name="fileremove"style="padding:1%;float:right;margin-right:24%; width:10%;"><input style="padding:1%;float:left;margin-left:24%;width:10%;" type="submit" value="back" name="back"></td>
	</tr>
	
</table>	
</form>';
$formpermission='<form  method="post" enctype="multipart/form-data" action="files.php">
<table border:none;>
<tr>
	<td>student permission</td>
	<td></td>
	<td></td>
	</tr>
	<tr>
	<td>file name:</td>
    <td><input type="text"  name="filename"></td>
	<td></td>
	</tr>
	<tr>permission
	<td>file permission:</td>
    <td><input type="radio" value="yes" name="permission" checked>yes</td>
	<td><input type="radio" value="no" name="permission">no</td>
	</tr>
	<tr>
	<td colspan=3><input type="submit" value="change permission" name="changepermission" style="padding:1%;float:right;margin-right:24%; width:15%;"><input style="padding:1%;float:left;margin-left:24%;width:10%;" type="submit" value="back" name="back"></td>
	</tr>
</table>	
</form>';


if(isset($_POST['uploadfile']))
{
$_SESSION['actiontype']="$formupload";
}
if(isset($_POST['removefile']))
{
$_SESSION['actiontype']="$formremove";

}
if(isset($_POST['permissionchange']))
{
$_SESSION['actiontype']="$formpermission";
}
if(isset($_POST['back']))
{
header('Location:teacherhome.php');
$_SESSION['actiontype']="";
}
if(isset($_POST['fileremove']))
{
$path=chdir("'$foldername'/");
$file =$_POST['filename'];
if($file == "")
{
	 $error= "please enter filename to remove";
}else{
$sql5="SELECT filename FROM $database1 where filename='$file'";
$result5 = $conn->query($sql5);
if ($result5->num_rows > 0) 
{
if (unlink($path.$file))
  {
$sql2 = "DELETE FROM `$database1` WHERE filename='$file'";
$result2 = $conn->query($sql2);
$sql3 = "ALTER TABLE $database1
DROP srno;";
$result3 = $conn->query($sql3);
$sql4 = "ALTER TABLE $database1 ADD `srno` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`srno`);";
$result4 = $conn->query($sql4);	
$error= "Deleted $file";
}
  else
  {
   $error= "Error deleting $file";
  }
}
else
  {
   $error= "please see below table and enter filename to remove";
  }
}
}
if(isset($_POST['changepermission']))
{
	$studentpermission=$_POST['permission'];
	$filename=$_POST['filename'];
	if($filename == "")
	{
		$error=" enter filename to change permission";
	}else{
	$query1 = "SELECT * FROM $database1 where filename='$filename'";
$result1 = $conn->query($query1);
if($result1 != "")
{	
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$studentpermissions	  	= 	$row1['studentpermission'];	
		}
}
$modifydate = date("d/m/y")." ".date("h:i:sa");
if($studentpermissions != $studentpermission)
{
$query1 = "UPDATE $database1 SET modifydate='$modifydate' ,studentpermission='$studentpermission' WHERE filename='$filename'";
$result1 = $conn->query($query1);
$error="permission of file $filename is updated to $studentpermission";
}else{
	$error="permission of file $filename is already set to $studentpermissions";
}
}else{
	$error=" $filename is not upload";
}
}
}
if(isset($_POST['upload']))
{
$studentpermission=$_POST['permission'];	
$path=chdir("'$foldername'");

$filename = trim(addslashes($_FILES['fileToUpload']['name']));
$filename = str_replace(' ', '_', $filename);
$filename = preg_replace('/\s+/', '_', $filename);
$target_dir = $path;
$target_file = $target_dir . basename($filename);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    $error1= "because file is already exists.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
     $error= "your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $error= "The file ". basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
$modifydate     		= 	""; 
$uploaddate  			=	date("d/m/y")." ".date("h:i:sa");


$query1 = "SELECT * FROM $database1";
$result1 = $conn->query($query1);
if($result1 != "")
{	
$query3="INSERT INTO $database1(filename,uploaddate,modifydate,studentpermission)VALUES('$filename','$uploaddate','$modifydate','$studentpermission')";
$result3 = $conn->query($query3);
}else{
	$sql2 = "CREATE TABLE $database1(
  `srno`INT NOT NULL AUTO_INCREMENT , 
  `filename`text,
  `uploaddate`text,
  `modifydate`text,
  `studentpermission`text,
  PRIMARY KEY (`srno`),
  UNIQUE(`srno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
;";
$result2 = $conn->query($sql2);	
$query3="INSERT INTO $database1(filename,uploaddate,modifydate,studentpermission)VALUES('$filename','$uploaddate','$modifydate','$studentpermission')";
$result3 = $conn->query($query3);
}
    } else {
        $error= "there was an error uploading your file.";
    }
}

}
$srno1		 			= 	array();
$filename1				= 	array(); 
$uploaddate1     		= 	array();
$studentpermission1  	= 	array();
$modifydate1 			=	array();
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
			$filename1[]					= 	$row1['filename']; 
			$uploaddate1[]	     		= 	$row1['uploaddate']; 
			$studentpermission1[]	  	= 	$row1['studentpermission'];	
			$modifydate1[]	 			= 	$row1['modifydate'];				
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
    <th>Sr no</th>
    <th>file name</th> 
	<th>upload date(time is as per IST time zone)</th> 
	<th>modify date(time is as per IST time zone)</th> 
	<th>student permission</th> 
	</tr>';
for($i=$x;$i<$n;)
{
if($i < $srnos){
	if($modifydate1[$i] == "")
	{
		$modifydate1[$i]="----";
	}else{
		$modifydate1[$i]=$modifydate1[$i];
	}	
echo	$row='<tr>
	<td>'.$srno1[$i].'</td>
	<td>'.$filename1[$i].'</td>
	<td>'.$uploaddate1[$i].'</td>
	<td>'.$modifydate1[$i].'</td>
	<td>'.$studentpermission1[$i].'</td>
	</tr>
	';
}else{
	echo	$row='<tr>
	<td>----</td>
	<td>----</td>
	<td>----</td>
	<td>----</td>
	<td>----</td>
	</tr>
	';
}
$i++;
}
if($srnos > 4){
echo '<form method="POST" action="files.php"> <tr >
<td ><button name="previous">&#8249; Previous</button></td>
<td ><button name="first">&laquo; start</button></td>
<td> &nbsp </td>
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
    <th>file name</th> 
	<th>upload date(time is as per IST time zone)</th> 
	<th>modify date(time is as per IST time zone)</th> 
	<th>student permission</th> 
	</tr>
	<tr>
	<td>No data found</td>
	<td>No data found</td>
	<td>No data found</td>
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
