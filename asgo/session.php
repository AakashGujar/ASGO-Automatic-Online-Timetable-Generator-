<?php
   include('connection.php');
   if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
   date_default_timezone_set("Asia/Kolkata");
   $alltables = mysqli_query($conn,"SHOW TABLES;");
 
// record the output
$output = array();
 
while($table = mysqli_fetch_assoc($alltables)){
 foreach($table as $db => $tablename){
  $sql = 'OPTIMIZE TABLE '.$tablename.';';
  $response = mysqli_query($conn,$sql) or die(mysql_error());
  $output[] = mysqli_fetch_assoc($response);
 };
};

	 $home = $_SESSION['login_userhome'];
  $adminusername = $_SESSION['login_useradmin'] ;
   $user_check = $_SESSION['login_user'];
   $foldername = $_SESSION['foldername'];
   $database = $_SESSION['database'];
   $location=$_SESSION['location'];
if(!isset($location))
{
    header("Location:index.php");
}
   $ses_sql = mysqli_query($conn,"select * from $database where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   if($row['firstname'] == "")
   {
   $login_user=$row['username'];
   }else{
	  $login_session = $row['firstname'].$row['lastname'];
	  $login_user=$row['firstname']." ".$row['lastname'];
      $login_database=$adminusername."_".$row['firstname'].$row['lastname']."_";
   }
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
?>