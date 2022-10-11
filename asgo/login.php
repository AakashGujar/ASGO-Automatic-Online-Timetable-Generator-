<?php
include('connection.php');
  session_start();
if(isset($_POST['admincreateform']))
{
	header('Location:admincreateform.php');
}
if(isset($_POST['adminsubmit']))
{
$adminusername = $_POST['adminid'];
$adminpassword = $_POST['adminpass']; 
$database1=	"adminusers";
$query1 = "SELECT * FROM $database1 where username='$adminusername'";
$result1 = $conn->query($query1);
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$usernames		= 	$row1['username']; 
			$passwords		= 	$row1['password']; 
			$firstname		= 	$row1['firstname']; 
			$lastname		= 	$row1['lastname']; 
			$srno		 	= 	$row1['srno']; 
		}
}else{$srno=0;}
if($srno != 0){
if(($adminusername == $usernames) && ($adminpassword == $passwords))
{
	$_SESSION['login_useradmin'] = $adminusername;
	$_SESSION['login_user'] = $usernames;
	$_SESSION['login_userhome'] = "admin";
	$_SESSION['database'] = $database1;
if (!file_exists("F:\wamp\www\b\'$adminusername'")) {
	$_SESSION['foldername'] = "$adminusername";
   mkdir("F:\wamp\www\b\'$adminusername'");
   $_SESSION['location'] = "adminhome.php";
   header('Location:password.php');
}else{
	$_SESSION['foldername'] = "$adminusername";
	chdir("F:\wamp\www\b\'$adminusername'");
	$_SESSION['location'] = "adminhome.php";
header('Location:password.php');
}
}else{
$myfile2 = fopen("error1.php", "w");
$txt2 = '<?php $error="Username and password  not match"; echo $error;?>';
fwrite($myfile2, $txt2);
fclose($myfile2);
header('Location:index.php');
}
}else	{
	$myfile3 = fopen("error1.php", "w");
$txt3 = '<?php $error="Username not found"; echo $error;?>';
fwrite($myfile3, $txt3);
fclose($myfile3);
	header('Location:index.php');
}
 
}
else if(isset($_POST['teachersubmit']))
{
$adminusername = $_POST['adminid1'];
$teacherusername = $_POST['teacherid'];
$teacherpassword = $_POST['teacherpass']; 
if($adminusername == "")
{
	$myfile2 = fopen("error2.php", "w");
$txt2 = '<?php $error=" please enter admin id"; echo $error;?>';
fwrite($myfile2, $txt2);
fclose($myfile2);
header('Location:index.php');
}
else{

	$database1=$adminusername."_teacherusers";
	
$query1 = "SELECT * FROM $database1 where username='$teacherusername'";
$result1 = $conn->query($query1);
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$username		= 	$row1['username']; 
			$passwords		= 	$row1['password']; 
			$firstname		= 	$row1['firstname']; 
			$lastname		= 	$row1['lastname']; 
			$srno		= 	$row1['srno']; 
		}
}else{$srno=0;}

if($srno != 0){
if(($teacherusername == $username) && ($teacherpassword == $passwords))
{
	$_SESSION['login_useradmin'] = $adminusername;
	$_SESSION['login_user'] = $username;
    $_SESSION['login_userhome'] = "teacher";
	$_SESSION['database'] = $database1;
if (!file_exists("'$adminusername$teacherusername'")) {
	 $_SESSION['foldername'] = "$adminusername$teacherusername";
   mkdir("'$adminusername$teacherusername'");
   chdir("'$adminusername$teacherusername'");
   $_SESSION['location'] = "teacherhome.php";
   header('Location:password.php');
}else{
	 $_SESSION['foldername'] = "$adminusername$teacherusername";
chdir("'$teacherusername'");
$_SESSION['location'] = "teacherhome.php";
header('Location:password.php');
}
}else{
	$_SESSION['error'] = $error;
$myfile2 = fopen("error2.php", "w");
$txt2 = '<?php $error="Username and password  not match"; echo $error;?>';
fwrite($myfile2, $txt2);
fclose($myfile2);
header('Location:index.php');
}
}else	{
	$myfile3 = fopen("error2.php", "w");
$txt3 = '<?php $error="Username not found"; echo $error;?>';
fwrite($myfile3, $txt3);
fclose($myfile3);
	header('Location:index.php');
}
}
}
else if(isset($_POST['studentsubmit']))
{
$adminusername = $_POST['adminid2'];
$studentusername = $_POST['studentid'];
$studentpassword = $_POST['studentpass']; 
if($adminusername == "")
{
	$myfile2 = fopen("error3.php", "w");
$txt2 = '<?php $error=" please enter admin id"; echo $error;?>';
fwrite($myfile2, $txt2);
fclose($myfile2);
header('Location:index.php');
}
else{

	$database1=$adminusername."_studentusers";
	
$query1 = "SELECT * FROM $database1 where username='$studentusername'";
$result1 = $conn->query($query1);
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$username	= 	$row1['username']; 
			$passwords		= 	$row1['password'];
			$firstname		= 	$row1['firstname']; 
			$lastname		= 	$row1['lastname']; 			
			$srno		= 	$row1['srno']; 
		}
}else{$srno=0;}

if($srno != 0){
if(($studentusername == $username) && ($studentpassword == $passwords))
{
	$_SESSION['login_useradmin'] = $adminusername;
    $_SESSION['login_user'] = $username;
	$_SESSION['login_userhome'] = "student";
	$_SESSION['foldername'] ="";
   $_SESSION['database'] = $database1;
   $_SESSION['location'] = "studenthome.php";
   header('Location:password.php');
   
}else{
	$_SESSION['error'] = $error;
$myfile2 = fopen("error3.php", "w");
$txt2 = '<?php $error="Username and password  not match"; echo $error;?>';
fwrite($myfile2, $txt2);
fclose($myfile2);
header('Location:index.php');
}
}else	{
	$myfile3 = fopen("error3.php", "w");
$txt3 = '<?php $error="Username not found"; echo $error;?>';
fwrite($myfile3, $txt3);
fclose($myfile3);
	header('Location:index.php');
}
}
}

?>