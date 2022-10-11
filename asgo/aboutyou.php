<?php
include('session.php');
$instruction="";
 if(isset($_POST['back'])){
		if($location == "adminhome.php"){
	header('Location:adminhome');
	}
	if($location == "teacherhome.php"){
	header('Location:teacherhome');
	}
	if($location == "studenthome.php"){
	header('Location:studenthome');
	}
	}
 	include('userheader.php');
if($location == "adminhome.php"){

$query2="SELECT * FROM admininformation WHERE adminid='$user_check'";
$result2 = $conn->query($query2);
if($result2 != ""){	
if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_array())
		{
			$row     =	 $row2;
		}
if($row['recoveryphone'] != ""){	
		$recoveryphone=$row['recoveryphone'];
}else{
	$recoveryphone="                  ----";
}
if($row['institutetype'] == "school"){	
		$institutetype='<td>which type of institute our Automatic online timetable generator</td>
						<td><input type="radio" id="4" name="institutetype" value="school" checked>school</input></td> 
                        <td><input type="radio" id="5" name="institutetype" value="college">college</input></td>' ;
}else{
	$institutetype='<td>which type of institute our Automatic online timetable generator</td>
						<td><input type="radio" id="4" name="institutetype" value="school">school</input></td> 
                        <td><input type="radio" id="5" name="institutetype" value="college" checked>college</input></td> ';
}
$instruction="To chage plan click on change plan button";
	echo '<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section class="s-12 l-8">
<div id="create form">

     <fieldset >
        <legend>Admin Details Section</legend> 
           <form method="POST" action="addadminuser.php">
				<table border="0 px">
					<tr> 
					<td> <h4>user details section</h1></td> 
					</tr>
					<tr> 
						<td>admin full name :</td>
						<td> <input type="text" name="firstname" placeholder="enter first name" value="'.$row["firstname"].'"></input></td>
						<td> <input type="text" name="lastname" placeholder="enter last name" value="'.$row["lastname"].'"></input></td>
					</tr> 
					<tr> 
						<td>admin id :</td>
						<td> <input type="text" name="adminid" placeholder="enter admin id" value="'.$row["adminid"].'" class=disable></input></td>
					</tr> 
					<tr> 
						<td>Password :</td>
						<td> <input type="password" name="password" placeholder="enter password" value="'.$row["password"].'" class=disable></input></td>
						<td><button type="submit" name="adminprofile" formaction="password.php">Change Password</button></td>
					</tr> 
					<tr> 
					<td> <h4>Recovery section</h1></td> 
					</tr> 
					<tr> 
						<td>security question</td>
					</tr> 
					<tr> 
						<td>question</td>
						<td colspan=3> <select name="securityquestion" >
									<option value="'.$row["securityquestion"].'" >'.$row["securityquestion"].'</option>
                                    <option value="What was your childhood nickname?" >What was your childhood nickname?</option>
                                    <option value="What is your favorite team?" >What is your favorite team?</option>
									<option value="In what city or town did your mother and father meet?" >In what city or town did your mother and father meet?</option>
                                    <option value="What was your favorite sport in high school?" >What was your favorite sport in high school?</option>
									<option value="What was the make and model of your first car?" >What was the make and model of your first car?</option>
                                    <option value="What was the name of the hospital where you were born?" >What was the name of the hospital where you were born?</option>
									<option value="What school did you attend for sixth grade?" >What school did you attend for sixth grade?</option>
                                    <option value="In what town was your first job?" >In what town was your first job?</option>
									<option value="What is the name of the place your wedding reception was held?" >What is the name of the place your wedding reception was held?</option>
                                    <option value="Which is your favorite college?" >Which is your favorite college?</option>
                             </select>
						</td>
					</tr>
					<tr> 
						<td>Answer :</td>
						<td> <input type="text" name="recoveryans" placeholder="enter Answer" value="'.$row["recoveryans"].'"></input></td>
					</tr> 
					<tr id="email"> 
						<td>Email Id :</td>
						<td> <input type="email" name="recoveryemailid" placeholder="enter Email-id" value="'.$row["recoveryemailid"].'"></input></td>
					</tr> 
					<tr id="phone"> 
						<td>phone no (optional) :</td>
						<td> <input type="tel" name="recoveryphone" placeholder="enter Phone no" value="'.$recoveryphone.'"></input></td>
					</tr>
					<tr>
                    <td>Address :-</td>
					</tr>
					<tr> 
					<td>Address :</td>
						<td> <input type="text" name="adress" placeholder="enter  Address"  maxlength="30" value="'.$row["adress"].'"></input></td>
					</tr> 

					<tr> 
					<td>country :</td>
						<td> <input type="text" name="country" placeholder="enter country name"  maxlength="30" value="'.$row["country"].'"></input></td>
					</tr> 
					<tr> 
					<td>state :</td>
						<td> <input type="text" name="state" placeholder="enter state name"  maxlength="30" value="'.$row["state"].'"></input></td>
					</tr>
					
					<tr> 
					<td>city :</td>
						<td> <input type="text" name="city" placeholder="enter city name"  maxlength="30" value="'.$row["city"].'"></input></td>
					</tr>
										<tr> 
					<td>town :</td>
						<td> <input type="text" name="town" placeholder="enter town name"  maxlength="30" value="'.$row["town"].'"></input></td>
					</tr>
					<tr> 
					<td>district :</td>
						<td> <input type="text" name="district" placeholder="enter district name"  maxlength="30" value="'.$row["district"].'"></input></td>
					</tr>	
					<tr> 
					<td>pin code :</td>
						<td> <input type="text" name="pincode" placeholder="enter pin code"  maxlength="30" value="'.$row["pincode"].'"></input></td>
					</tr>								
					<tr> 
					<td> <h4>User institute section</h1></td> 
					</tr> 
					<tr> 
						'.$institutetype.'
					</tr>
					<tr> 
						<td>institute full name  :</td>
						<td> <input type="text" name="institutefullname" placeholder="enter institute full name" value="'.$row["institutefullname"].'"></input></td>
					</tr> 
					<tr> 
						<td>institute short name :</td>
						<td> <input type="text" name="instituteshortname" placeholder="enter institute short name"  maxlength="6" value="'.$row["instituteshortname"].'"></input></td>
					</tr> 
					<tr>
					<tr> 
					<td>institute code :</td>
						<td> <input type="text" name="institutecode" placeholder="enter institute code"  maxlength="30" value="'.$row["institutecode"].'"></input></td>
					</tr>
					<tr> 
					<td>institute phone no :</td>
						<td> <input type="text" name="institutephoneno" placeholder="enter institute phone no"  maxlength="30" value="'.$row["institutephoneno"].'"></input></td>
					</tr>
					<tr> 
					<td>institute Email id :</td>
						<td> <input type="email" name="instituteemailid" placeholder="enter institute Email id" value="'.$row["instituteemailid"].'"></input></td>
					</tr>
					<td>institute Address :-</td>
					</tr>
					<tr> 
					<td>Address :</td>
						<td> <input type="text" name="instituteadress" placeholder="enter  Address"  maxlength="30" value="'.$row["instituteadress"].'"></input></td>
					</tr> 

					<tr> 
					<td>country :</td>
						<td> <input type="text" name="institutecountry" placeholder="enter country name"  maxlength="30" value="'.$row["institutecountry"].'"></input></td>
					</tr> 
					<tr> 
					<td>state :</td>
						<td> <input type="text" name="institutestate" placeholder="enter state name"  maxlength="30" value="'.$row["institutestate"].'"></input></td>
					</tr>
					
					<tr> 
					<td>city :</td>
						<td> <input type="text" name="institutecity" placeholder="enter city name"  maxlength="30" value="'.$row["institutecity"].'"></input></td>
					</tr>
										<tr> 
					<td>town :</td>
						<td> <input type="text" name="institutetown" placeholder="enter town name"  maxlength="30" value="'.$row["institutetown"].'"></input></td>
					</tr>
					<tr> 
					<td>district :</td>
						<td> <input type="text" name="institutedistrict" placeholder="enter district name"  maxlength="30" value="'.$row["institutedistrict"].'"></input></td>
					</tr>	
					<tr> 
					<td>pin code :</td>
						<td> <input type="text" name="institutepincode" placeholder="enter pin code"  maxlength="30" value="'.$row["institutepincode"].'"></input></td>
					</tr>					
					<tr>
					<td>Your Subcribed Plan is '.$row["plan"].'</td>
					<td>Total Price '.$row["price"].'</td>
					<td><button type="submit" name="adminprofile" formaction="pricing.php">Change Plan</button></td>
					</tr>					
					<tr>
					<td><button type="submit" name="updateadmin" >Update account</button></td>
					<td><button type="submit" name="back" formaction="">back</button></td>
					</tr>
					
		</table> 
			</form> 		
</fieldset>
		</fieldset>
		</div></section>';
		}
		}
	}
	if($location == "teacherhome.php"){
		$databases1=$adminusername."_teacherinformation";
	$query2="SELECT * FROM $databases1 WHERE teacherid='$user_check'";
$result2 = $conn->query($query2);
if($result2 != ""){	
if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_array())
		{
			$row     =	 $row2;
		}
if($row['recoveryphone'] != ""){	
		$recoveryphone=$row['recoveryphone'];
}else{
	$recoveryphone="                  ----";
}
	echo '<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section class="s-12 l-8">
<div id="create form">

     <fieldset >
        <legend>Teacher Details Section</legend> 
           <form method="POST" action="addteacheruser.php">
				<table border="0 px">
					<tr> 
					<td> <h4>user details section</h1></td> 
					</tr>
					<tr> 
						<td>admin full name :</td>
						<td> <input type="text" name="firstname" placeholder="enter first name" value="'.$row["firstname"].'"></input></td>
						<td> <input type="text" name="lastname" placeholder="enter last name" value="'.$row["lastname"].'"></input></td>
					</tr> 
					<tr> 
						<td>admin id :</td>
						<td> <input type="text" name="teacherid" placeholder="enter admin id" value="'.$row["teacherid"].'" class=disable></input></td>
					</tr> 
					<tr> 
						<td>Password :</td>
						<td> <input type="password" name="password" placeholder="enter password" value="'.$row["password"].'" class=disable></input></td>
						<td><button type="submit" name="teacherprofile" formaction="password.php">Change Password</button></td>
					</tr> 
					<tr>
                    <td>Address :-</td>
					</tr>
					<tr> 
					<td>Address :</td>
						<td> <input type="text" name="adress" placeholder="enter  Address"  maxlength="30" value="'.$row["adress"].'"></input></td>
					</tr> 

					<tr> 
					<td>country :</td>
						<td> <input type="text" name="country" placeholder="enter country name"  maxlength="30" value="'.$row["country"].'"></input></td>
					</tr> 
					<tr> 
					<td>state :</td>
						<td> <input type="text" name="state" placeholder="enter state name"  maxlength="30" value="'.$row["state"].'"></input></td>
					</tr>
					
					<tr> 
					<td>city :</td>
						<td> <input type="text" name="city" placeholder="enter city name"  maxlength="30" value="'.$row["city"].'"></input></td>
					</tr>
										<tr> 
					<td>town :</td>
						<td> <input type="text" name="town" placeholder="enter town name"  maxlength="30" value="'.$row["town"].'"></input></td>
					</tr>
					<tr> 
					<td>district :</td>
						<td> <input type="text" name="district" placeholder="enter district name"  maxlength="30" value="'.$row["district"].'"></input></td>
					</tr>	
					<tr> 
					<td>pin code :</td>
						<td> <input type="text" name="pincode" placeholder="enter pin code"  maxlength="30" value="'.$row["pincode"].'"></input></td>
					</tr>								
					<tr> 
					<td> <h4>Recovery section</h1></td> 
					</tr> 
					<tr> 
						<td>security question</td>
					</tr> 
					<tr> 
						<td>question</td>
						<td colspan=3> <select name="securityquestion" >
									<option value="'.$row["securityquestion"].'" >'.$row["securityquestion"].'</option>
                                    <option value="What was your childhood nickname?" >What was your childhood nickname?</option>
                                    <option value="What is your favorite team?" >What is your favorite team?</option>
									<option value="In what city or town did your mother and father meet?" >In what city or town did your mother and father meet?</option>
                                    <option value="What was your favorite sport in high school?" >What was your favorite sport in high school?</option>
									<option value="What was the make and model of your first car?" >What was the make and model of your first car?</option>
                                    <option value="What was the name of the hospital where you were born?" >What was the name of the hospital where you were born?</option>
									<option value="What school did you attend for sixth grade?" >What school did you attend for sixth grade?</option>
                                    <option value="In what town was your first job?" >In what town was your first job?</option>
									<option value="What is the name of the place your wedding reception was held?" >What is the name of the place your wedding reception was held?</option>
                                    <option value="Which is your favorite college?" >Which is your favorite college?</option>
                             </select>
						</td>
					</tr>
					<tr> 
						<td>Answer :</td>
						<td> <input type="text" name="recoveryans" placeholder="enter Answer" value="'.$row["recoveryans"].'"></input></td>
					</tr> 
					<tr id="email"> 
						<td>Email Id :</td>
						<td> <input type="email" name="recoveryemailid" placeholder="enter Email-id" value="'.$row["recoveryemailid"].'"></input></td>
					</tr> 
					<tr id="phone"> 
						<td>phone no (optional) :</td>
						<td> <input type="tel" name="recoveryphone" placeholder="enter Phone no" value="'.$recoveryphone.'"></input></td>
					</tr>
					<tr> 
								<td><button type="submit" name="updateteacher" >Update account</button></td>
					<td><button type="submit" name="back" formaction="">back</button></td>
					</tr>
					
		</table> 
			</form> 		
</fieldset>
		</fieldset>
		</div></section>';
		}
		}
	}
	if($location == "studenthome.php"){
	$databases1=$adminusername."_studentinformation";
	$query2="SELECT * FROM $databases1 WHERE studentid='$user_check'";
$result2 = $conn->query($query2);
if($result2 != ""){	
if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_array())
		{
			$row     =	 $row2;
		}
if($row['recoveryphone'] != ""){	
		$recoveryphone=$row['recoveryphone'];
}else{
	$recoveryphone="                  ----";
	
}
	echo '<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section class="s-12 l-8">
<div id="create form">

     <fieldset >
        <legend>Teacher Details Section</legend> 
           <form method="POST" action="addstudentuser.php">
				<table border="0 px">
					<tr> 
					<td> <h4>user details section</h1></td> 
					</tr>
					<tr> 
						<td>admin full name :</td>
						<td> <input type="text" name="firstname" placeholder="enter first name" value="'.$row["firstname"].'"></input></td>
						<td> <input type="text" name="lastname" placeholder="enter last name" value="'.$row["lastname"].'"></input></td>
					</tr> 
					<tr> 
						<td>admin id :</td>
						<td> <input type="text" name="studentid" placeholder="enter admin id" value="'.$row["studentid"].'" class=disable autocomplete="off"></input></td>
					</tr> 
					<tr> 
						<td>Password :</td>
						<td> <input type="password" name="password" placeholder="enter password" value="'.$row["password"].'" class=disable autocomplete="off"></input></td>
						<td><button type="submit" name="teacherprofile" formaction="password.php">Change Password</button></td>
					</tr> 
					<tr>
                    <td>Address :-</td>
					</tr>
					<tr> 
					<td>Address :</td>
						<td> <input type="text" name="adress" placeholder="enter  Address"  maxlength="30" value="'.$row["adress"].'"></input></td>
					</tr> 

					<tr> 
					<td>country :</td>
						<td> <input type="text" name="country" placeholder="enter country name"  maxlength="30" value="'.$row["country"].'"></input></td>
					</tr> 
					<tr> 
					<td>state :</td>
						<td> <input type="text" name="state" placeholder="enter state name"  maxlength="30" value="'.$row["state"].'"></input></td>
					</tr>
					
					<tr> 
					<td>city :</td>
						<td> <input type="text" name="city" placeholder="enter city name"  maxlength="30" value="'.$row["city"].'"></input></td>
					</tr>
										<tr> 
					<td>town :</td>
						<td> <input type="text" name="town" placeholder="enter town name"  maxlength="30" value="'.$row["town"].'"></input></td>
					</tr>
					<tr> 
					<td>district :</td>
						<td> <input type="text" name="district" placeholder="enter district name"  maxlength="30" value="'.$row["district"].'"></input></td>
					</tr>	
					<tr> 
					<td>pin code :</td>
						<td> <input type="text" name="pincode" placeholder="enter pin code"  maxlength="30" value="'.$row["pincode"].'"></input></td>
					</tr>								
					<tr> 
					<td> <h4>Recovery section</h1></td> 
					</tr> 
					<tr> 
						<td>security question</td>
					</tr> 
					<tr> 
						<td>question</td>
						<td colspan=3> <select name="securityquestion" >
									<option value="'.$row["securityquestion"].'" >'.$row["securityquestion"].'</option>
                                    <option value="What was your childhood nickname?" >What was your childhood nickname?</option>
                                    <option value="What is your favorite team?" >What is your favorite team?</option>
									<option value="In what city or town did your mother and father meet?" >In what city or town did your mother and father meet?</option>
                                    <option value="What was your favorite sport in high school?" >What was your favorite sport in high school?</option>
									<option value="What was the make and model of your first car?" >What was the make and model of your first car?</option>
                                    <option value="What was the name of the hospital where you were born?" >What was the name of the hospital where you were born?</option>
									<option value="What school did you attend for sixth grade?" >What school did you attend for sixth grade?</option>
                                    <option value="In what town was your first job?" >In what town was your first job?</option>
									<option value="What is the name of the place your wedding reception was held?" >What is the name of the place your wedding reception was held?</option>
                                    <option value="Which is your favorite college?" >Which is your favorite college?</option>
                             </select>
						</td>
					</tr>
					<tr> 
						<td>Answer :</td>
						<td> <input type="text" name="recoveryans" placeholder="enter Answer" value="'.$row["recoveryans"].'"></input></td>
					</tr> 
					<tr id="email"> 
						<td>Email Id :</td>
						<td> <input type="email" name="recoveryemailid" placeholder="enter Email-id" value="'.$row["recoveryemailid"].'"></input></td>
					</tr> 
					<tr id="phone"> 
						<td>phone no (optional) :</td>
						<td> <input type="tel" name="recoveryphone" placeholder="enter Phone no" value="'.$recoveryphone.'"></input></td>
					</tr>
					<tr> 
								<td><button type="submit" name="updatestudent" >Update account</button></td>
					<td><button type="submit" name="back" formaction="">back</button></td>
					</tr>
					
		</table> 
			</form> 		
</fieldset>
		</fieldset>
		</div></section>';
	}
		}
	}
	
	
?>

		<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
                     <ol type="1">
					 <li> you can't change your id</li>
						<li><br></li>
						<li>to change password you have to click on change password button</li>
						<li><br></li>
						<li>for change in your details change field text</li>
						<li><br></li>
						<li><?php echo $instruction;?></li>
						<li><br></li>
					 </ol>
					  <br><br><br><br> <br><br><br><br>
                  </div>
               </aside>
            </div>
         </div>
      </div>

<?php
include ("footer.php");
?>  
