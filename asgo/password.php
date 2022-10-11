<?php
include('session.php');
 include('userheader.php');
 function updatepassword($databasename,$conn,$oldpassword,$newpassword,$user_check,$databasename1){
	$query1="SELECT password FROM $databasename WHERE username='$user_check'";
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

if($passwords == $oldpassword)
{
$query5="UPDATE $databasename SET password='$newpassword' WHERE username='$user_check'";
$result5 = $conn->query($query5);
$query6="UPDATE $databasename1 SET password='$newpassword' WHERE adminid='$user_check'";
$result6 = $conn->query($query6);
if($result5 == "")
{
 return  $error="Password is not update";
}else{
	return  $check=1;
}
}else{
	return $error= "old password not match";
}
}
}
 $error1="";
 
if((isset($_POST['adminprofile'])) || (isset($_POST['teacherprofile'])) || (isset($_POST['studentprofile'])))
{
	$button='<td ><input type="submit" value="back" name="back"></td>
	<td ><input type="submit" value="update password" name="update"></td>';
	
}else if(isset($_POST['next']))
{
	$button='<td ><input type="submit" value="next" name="next"></td>
	<td ></td>';
	$check=0;
	$oldpassword=$_POST['oldpassword'];
	$newpassword=$_POST['newpassword'];
	$againnewpassword=$_POST['againnewpassword'];
	if($newpassword == $oldpassword)
	{
		$error1= "new passord should different";
	}else{
	if($newpassword == $againnewpassword)
	{
	

	if($location == "adminhome.php"){
		$databasename="adminusers";
		$databasename1="admininformation";
		$error=updatepassword($databasename,$conn,$oldpassword,$newpassword,$user_check,$databasename1);
		if($error == 1){
	header('Location:adminhome');
	}
	}
	if($location == "teacherhome.php"){
		$databasename=$adminusername."_teacherusers";
		$databasename1=$adminusername."admininformation";
		$error=updatepassword($databasename,$conn,$oldpassword,$newpassword,$user_check,$databasename1);
		if($error==1){
	header('Location:teachercreateform');
	}
	}
	if($location == "studenthome.php"){
		$databasename=$adminusername."_studentusers";
		$databasename1=$adminusername."admininformation";
		 $error=updatepassword($databasename,$conn,$oldpassword,$newpassword,$user_check,$databasename1);
		if($error == 1){
	header('Location:studentcreateform');
	}else
		$error1=$error;
    }
	}else{
	$error1= "new passords not match with each other";
}
}
}else if(isset($_POST['update']))
{
	$button='<td ><input type="submit" value="back" name="back"></td>
	<td ><input type="submit" value="update password" name="update"></td>';
	$check=0;
	$oldpassword=$_POST['oldpassword'];
	$newpassword=$_POST['newpassword'];
	$againnewpassword=$_POST['againnewpassword'];
	if($newpassword == $oldpassword)
	{
		$error1= "new passord should different";
	}else{
	if($newpassword == $againnewpassword)
	{
	

	if($location == "adminhome.php"){
		$databasename="adminusers";
		$databasename1="admininformation";
		$error=updatepassword($databasename,$conn,$oldpassword,$newpassword,$user_check, $databasename1);
		if($error == 1){
	header('location:aboutyou.php');
	}
	}
	if($location == "teacherhome.php"){
		$databasename=$adminusername."_teacherusers";
		$databasename1=$adminusername."admininformation";
		$error=updatepassword($databasename,$conn,$oldpassword,$newpassword,$user_check, $databasename1);
		if($error==1){
	header('location:aboutyou.php');
	}
	}
	if($location == "studenthome.php"){
		$databasename=$adminusername."_studentusers";
		$databasename1=$adminusername."admininformation";
		 $error=updatepassword($databasename,$conn,$oldpassword,$newpassword,$user_check, $databasename1);
		if($error == 1){
	header('location:aboutyou.php');
	}else
		$error1=$error;
    }
	}else{
	$error1= "new passords not match with each other";
}
}
}else if(isset($_POST['back']))
{
	if($location == "adminhome.php"){
	header('location:aboutyou.php');
	}
	if($location == "teacherhome.php"){
	header('location:aboutyou.php');
	}
	if($location == "studenthome.php"){
	header('location:aboutyou.php');
	}
}else{

$button='<td ><input type="submit" value="next" name="next"></td>
	<td ></td>';	
	
if (strpos($login_user, '@') === false) {
    header('Location:'.$location.'');
}

}
?>
<html>
<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section class="s-12 l-6">
<form  method="post" enctype="multipart/form-data" action="">
<p>
<table style="margin:0% 0% 27% 0%;">
<tr>
<tr>
   <th colspan=2><h4>Change password<h4></th>
</tr>
<tr>
   <td>enter old password</td>
	<td><input type="password"  name="oldpassword" maxlength=8></td>
	</tr>
<tr>
<tr>
   <td>enter new password</td>
	<td><input type="password"  name="newpassword" maxlength=8></td>
	</tr>
<tr>
<tr>
   <td>enter again new password</td>
	<td><input type="password"  name="againnewpassword" maxlength=8></td>
	</tr>
<tr>
<?php
echo $button;
echo $error1;
?>
	</tr>
	</table>
</p>	
	</form>
	
	</section>
		<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
                     <li><h4>how to select proper  password</h4><li>
					 <ol style="text-align: left;">
					 <li>choose charcter,number and special character like @,!,#,$,^,&,*  for your password<li>
					 <li>never entered your old passwords in new password field<li>
					 </ol>
                  </div>
               </aside>
            </div>
         </div>
      </div>
	  <?php
include ("footer.php");
?>
</html>