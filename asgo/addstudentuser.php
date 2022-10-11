<?php
include('session.php');
include('connection.php');
if(isset($_POST['firstname'])){
$firstnames=$_POST['firstname'];
$lastnames=$_POST['lastname'];
$studentids=$_POST['studentid'];
$securityquestions=$_POST['securityquestion'];
$recoveryanss=$_POST['recoveryans'];
$passwords=$_POST['password'];
$recoveryemailids=$_POST['recoveryemailid'];
$recoveryphones=$_POST['recoveryphone'];
$adresss=$_POST['adress'];
$countrys=$_POST['country'];
$states=$_POST['state'];
$citys=$_POST['city'];
$towns=$_POST['town'];
$districts=$_POST['district'];
$pincodes=$_POST['pincode'];
$databasename=$adminusername."_studentusers";
$databasename1=$adminusername."_studentinformation";

if(isset($_POST['createstudent'])){
	session_start();
	$query1="SELECT password FROM $databasename WHERE username='$login_user'";
$result1 = $conn->query($query1);
if($result1 != ""){	
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$passwords     =	 $row1['password'];
		}
}
}
$query1="SELECT srno FROM  $databasename1";
$result1 = $conn->query($query1);
if($result1 == ""){
$sql2 = "CREATE TABLE $databasename1(
  `srno`INT NOT NULL AUTO_INCREMENT , 
  `firstname`text,
  `lastname`text,
  `studentid`text,
  `password`text,
  `securityquestion`text,
  `recoveryans`text,
  `recoveryemailid`text,
  `recoveryphone`text,
  `adress`text,
  `country`text,
  `state`text,
  `city`text,
  `town`text,
  `district`text,
  `pincode`text, 
  PRIMARY KEY (`srno`),
  UNIQUE(`srno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
;";
$result2 = $conn->query($sql2);	

$query4="INSERT INTO   $databasename1( `firstname`,`lastname`,`studentid`,`password`,`securityquestion`,`recoveryans`,`recoveryemailid`,`recoveryphone`,`adress`,`country`,`state`,`city`,`town`,`district`,`pincode`) VALUES('$firstnames','$lastnames','$login_user','$passwords','$securityquestions','$recoveryanss','$recoveryemailids','$recoveryphones','$adresss','$countrys','$states','$citys','$towns','$districts','$pincodes');";
$result4 = $conn->query($query4);
$query5="UPDATE $databasename SET firstname='$firstnames',lastname='$lastnames',password='$passwords' WHERE username='$login_user'";
$result5 = $conn->query($query5);
header('location:index.php');
}else{
$query6="INSERT INTO   $databasename1( `firstname`,`lastname`,`studentid`,`password`,`securityquestion`,`recoveryans`,`recoveryemailid`,`recoveryphone`,`adress`,`country`,`state`,`city`,`town`,`district`,`pincode`) VALUES('$firstnames' ,'$lastnames' ,'$login_user' ,'$passwords' ,'$securityquestions' ,'$recoveryanss' ,'$recoveryemailids' ,'$recoveryphones' ,'$adresss' ,'$countrys' ,'$states' ,'$citys' ,'$towns' ,'$districts' ,'$pincodes');";
$result6 = $conn->query($query6);
$query7="UPDATE $databasename SET firstname='$firstnames',lastname='$lastnames',password='$passwords' WHERE username='$login_user'";
$result7 = $conn->query($query7);
header('location:logout.php');
}
}
if(isset($_POST['updatestudent'])){
	include('session.php');
	$query6="UPDATE $databasename1 SET `firstname`='$firstnames',`lastname`='$lastnames',`studentid`='$studentids',`password`='$passwords',`securityquestion`='$securityquestions',`recoveryans`='$recoveryanss',`recoveryemailid`='$recoveryemailids',`recoveryphone`='$recoveryphones',`adress`='$adresss',`country`='$countrys',`state`='$states',`city`='$citys',`town`='$towns',`district`='$districts',`pincode`='$pincodes' WHERE studentid='$user_check';";
$result6 = $conn->query($query6);
$query7="UPDATE $databasename SET firstname='$firstnames',lastname='$lastnames',username='$studentids',password='$passwords' WHERE username='$user_check'";
$result7 = $conn->query($query7);
header('location:aboutyou.php');
}
}
?>