<?php
include('connection.php');

if(isset($_POST['firstname'])){
$firstnames=$_POST['firstname'];
$lastnames=$_POST['lastname'];
$adminids=$_POST['adminid'];
$passwords=$_POST['password'];
$securityquestions=$_POST['securityquestion'];
$recoveryanss=$_POST['recoveryans'];
$recoveryemailids=$_POST['recoveryemailid'];
$recoveryphones=$_POST['recoveryphone'];
$institutetypes=$_POST['institutetype'];
$institutefullnames=$_POST['institutefullname'];
$instituteshortnames=$_POST['instituteshortname'];
$institutecodes=$_POST['institutecode'];
$institutephonenos=$_POST['institutephoneno'];
$instituteemailids=$_POST['instituteemailid'];
$instituteadresss=$_POST['instituteadress'];
$institutecountrys=$_POST['institutecountry'];
$institutestates=$_POST['institutestate'];
$institutecitys=$_POST['institutecity'];
$institutetowns=$_POST['institutetown'];
$institutedistricts=$_POST['institutedistrict'];
$institutepincodes=$_POST['institutepincode'];
$planname = $_SESSION['planname'];
$adresss=$_POST['adress'];
$countrys=$_POST['country'];
$states=$_POST['state'];
$citys=$_POST['city'];
$towns=$_POST['town'];
$districts=$_POST['district'];
$pincodes=$_POST['pincode'];
$price = $_SESSION['price'] ;
if(isset($_POST['createadmin'])){
	session_start();
$query1="SELECT srno FROM admininformation";
$result1 = $conn->query($query1);
if($result1 == ""){
$sql2 = "CREATE TABLE admininformation(
  `srno`INT NOT NULL AUTO_INCREMENT , 
  `firstname`text,
  `lastname`text,
  `adminid`text,
  `password`text,
  `securityquestion`text,
  `recoveryans`text,
  `recoveryemailid`text,
  `recoveryphone`text,
  `institutetype`text,
  `institutefullname`text,
  `instituteshortname`text,
  `institutecode`text,
  `institutephoneno`text,
  `instituteemailid`text,
  `instituteadress`text,
  `institutecountry`text,
  `institutestate`text,
  `institutecity`text,
  `institutetown`text,
  `institutedistrict`text,
  `institutepincode`text,
  `plan`text,
  `price`text, 
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
$sql3 = "CREATE TABLE adminusers(
  `srno`INT NOT NULL AUTO_INCREMENT , 
  `firstname`text,
  `lastname`text,
  `username`text,
  `password`text,
  PRIMARY KEY (`srno`),
  UNIQUE(`srno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
;";
$result3 = $conn->query($sql3);	
$query4="INSERT INTO  admininformation( `firstname`,`lastname`,`adminid`,`password`,`securityquestion`,`recoveryans`,`recoveryemailid`,`recoveryphone`,`institutetype`,`institutefullname`,`instituteshortname`,`institutecode`,`institutephoneno`,`instituteemailid`,`instituteadress`,`institutecountry`,`institutestate`,`institutecity`,`institutetown`,`institutedistrict`,`institutepincode`,`plan`,`price`,`adress`,`country`,`state`,`city`,`town`,`district`,`pincode`) VALUES('$firstnames','$lastnames','$adminids@aotg.com','$passwords','$securityquestions','$recoveryanss','$recoveryemailids','$recoveryphones','$institutetypes','$institutefullnames','$instituteshortnames','$institutecodes','$institutephonenos','$instituteemailids','$instituteadresss','$institutecountrys','$institutestates','$institutecitys','$institutetowns','$institutedistricts','$institutepincodes','$planname','$price','$adresss','$countrys','$states','$citys','$towns','$districts','$pincodes');";
$result4 = $conn->query($query4);
$query5="INSERT INTO adminusers(firstname,lastname,username,password)VALUES('$firstnames','$lastnames','$adminids@aotg.com','$passwords')";
$result5 = $conn->query($query5);
header('location:index.php');
}else{
$query6="INSERT INTO  admininformation( `firstname`,`lastname`,`adminid`,`password`,`securityquestion`,`recoveryans`,`recoveryemailid`,`recoveryphone`,`institutetype`,`institutefullname`,`instituteshortname`,`institutecode`,`institutephoneno`,`instituteemailid`,`instituteadress`,`institutecountry`,`institutestate`,`institutecity`,`institutetown`,`institutedistrict`,`institutepincode`,`plan`,`price`,`adress`,`country`,`state`,`city`,`town`,`district`,`pincode`) VALUES('$firstnames' ,'$lastnames' ,'$adminids@aotg.com' ,'$passwords' ,'$securityquestions' ,'$recoveryanss' ,'$recoveryemailids' ,'$recoveryphones' ,'$institutetypes' ,'$institutefullnames' ,'$instituteshortnames' ,'$institutecodes' ,'$institutephonenos' ,'$instituteemailids' ,'$instituteadresss' ,'$institutecountrys' ,'$institutestates' ,'$institutecitys' ,'$institutetowns' ,'$institutedistricts' ,'$institutepincodes','$planname','$price','$adresss','$countrys','$states','$citys','$towns','$districts','$pincodes');";
$result6 = $conn->query($query6);
$query7="INSERT INTO adminusers(firstname,lastname,username,password)VALUES('$firstnames','$lastnames','$adminids@aotg.com','$passwords')";
$result7 = $conn->query($query7);
header('location:index.php');
}
}
if(isset($_POST['updateadmin'])){
	include('session.php');
	$query2="SELECT * FROM admininformation WHERE adminid='$user_check'";
$result2 = $conn->query($query2);
if($result2 != ""){	
if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_array())
		{
			$row     =	 $row2;
		}
		$planname=$row['plan'];
		$price=$row['price'];
}
}
$query6="UPDATE admininformation SET `firstname`='$firstnames',`lastname`='$lastnames',`adminid`='$adminids',`password`='$passwords',`securityquestion`='$securityquestions',`recoveryans`='$recoveryanss',`recoveryemailid`='$recoveryemailids',`recoveryphone`='$recoveryphones',`institutetype`='$institutetypes',`institutefullname`='$institutefullnames',`instituteshortname`='$instituteshortnames',`institutecode`='$institutecodes',`institutephoneno`='$institutephonenos',`instituteemailid`='$instituteemailids',`instituteadress`='$instituteadresss',`institutecountry`='$institutecountrys',`institutestate`='$institutestates',`institutecity`='$institutecitys',`institutetown`='$institutetowns',`institutedistrict`='$institutedistricts',`institutepincode`='$institutepincodes',`plan`='$planname',`price`='$price',`adress`='$adresss',`country`='$countrys',`state`='$states',`city`='$citys',`town`='$towns',`district`='$districts',`pincode`='$pincodes' WHERE adminid='$user_check';";
$result6 = $conn->query($query6);
$query7="UPDATE adminusers SET firstname='$firstnames',lastname='$lastnames',username='$adminids',password='$passwords' WHERE username='$user_check'";
$result7 = $conn->query($query7);
header('location:aboutyou.php');
}
}
?>