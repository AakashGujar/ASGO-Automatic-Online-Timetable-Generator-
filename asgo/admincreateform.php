<?php ob_start();?>
<!DOCTYPE html>
<html>
	<?php
	include('connection.php');
include('header.php');
 session_start();
if(isset($_POST['userPro'])){
	$user_check = $_SESSION['login_user'];
	$planname="Pro";
	$price="$ 19.99 / year";
	$query5="UPDATE admininformation SET `plan`='$planname',`price`='$price' WHERE adminid='$user_check';";
$result5 = $conn->query($query5);
header('location:aboutyou.php');
}else if(isset($_POST['userBasic'])){
	$user_check = $_SESSION['login_user'];
	$planname="Basic";
	$price="$ 4.99 / year";
	$query5="UPDATE admininformation SET `plan`='$planname',`price`='$price' WHERE adminid='$user_check';";
	header('location:aboutyou.php');
$result5 = $conn->query($query5);
	
}else if(isset($_POST['userPremium'])){
	$user_check = $_SESSION['login_user'];
	$planname="Premium";
	$price="$ 44.99 / year";
	$query5="UPDATE admininformation SET `plan`='$planname',`price`='$price' WHERE adminid='$user_check';";
$result5 = $conn->query($query5);
header('location:aboutyou.php');
}
?>
				
<div class="line">
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
						<td> <input type="text" name="firstname" placeholder="enter first name" autofocus ></input></td>
						<td> <input type="text" name="lastname" placeholder="enter last name" ></input></td>
					</tr> 
					<tr> 
						<td>admin id :</td>
						<td> <input type="text" name="adminid" placeholder="enter admin id" ></input></td>
                        <td>@aotg.com</td>
					</tr> 
					<tr> 
						<td>Password :</td>
						<td> <input type="password" name="password" placeholder="enter password" ></input></td>
					</tr> 
					<tr> 
						<td>Conform Password :</td>
						<td> <input type="password" name="password" placeholder="enter password Again" ></input></td>
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
						<td> <input type="text" name="recoveryans" placeholder="enter Answer" ></input></td>
					</tr> 
					<tr>
					<tr id="email"> 
						<td>Email Id :</td>
						<td> <input type="email" name="recoveryemailid" placeholder="enter Email-id" ></input></td>
					</tr> 
					<tr id="phone"> 
						<td>phone no (optional) :</td>
						<td> <input type="tel" name="recoveryphone" placeholder="enter Phone no" ></input></td>
					</tr>
										<tr>
                    <td>Address :-</td>
					</tr>
					<tr> 
					<td>Address :</td>
						<td> <input type="text" name="adress" placeholder="enter  Address"  maxlength="30" ></input></td>
					</tr> 

					<tr> 
					<td>country :</td>
						<td> <input type="text" name="country" placeholder="enter country name"  maxlength="30" ></input></td>
					</tr> 
					<tr> 
					<td>state :</td>
						<td> <input type="text" name="state" placeholder="enter state name"  maxlength="30" ></input></td>
					</tr>
					
					<tr> 
					<td>city :</td>
						<td> <input type="text" name="city" placeholder="enter city name"  maxlength="30" ></input></td>
					</tr>
										<tr> 
					<td>town :</td>
						<td> <input type="text" name="town" placeholder="enter town name"  maxlength="30" ></input></td>
					</tr>
					<tr> 
					<td>district :</td>
						<td> <input type="text" name="district" placeholder="enter district name"  maxlength="30" ></input></td>
					</tr>	
					<tr> 
					<td>pin code :</td>
						<td> <input type="text" name="pincode" placeholder="enter pin code"  maxlength="30" ></input></td>
					</tr>								
					<tr> 
					<td> <h4>User institute section</h1></td> 
					</tr> 
					<tr> 
						<td>which type of institute our Automatic online timetable generator</td>
						<td><input type="radio" id="4" name="institutetype" value="school" checked>school</input></td> 
                        <td><input type="radio" id="5" name="institutetype" value="college">college</input></td> 
					</tr>
					<tr> 
						<td>institute full name  :</td>
						<td> <input type="text" name="institutefullname" placeholder="enter institute full name" ></input></td>
					</tr> 
					<tr> 
						<td>institute short name :</td>
						<td> <input type="text" name="instituteshortname" placeholder="enter institute short
						name"  maxlength="6"></input></td>
					</tr> 
					<tr>
					<tr> 
					<td>institute code :</td>
						<td> <input type="text" name="institutecode" placeholder="enter institute code"  maxlength="30"></input></td>
					</tr>
					<tr> 
					<td>institute phone no :</td>
						<td> <input type="text" name="institutephoneno" placeholder="enter institute phone no"  maxlength="30"></input></td>
					</tr>
					<tr> 
					<td>institute Email id :</td>
						<td> <input type="email" name="instituteemailid" placeholder="enter institute Email id"></input></td>
					</tr>
					<td>institute Address :-</td>
					</tr>
					<tr> 
					<td>Address :</td>
						<td> <input type="text" name="instituteadress" placeholder="enter  Address"  maxlength="30"></input></td>
					</tr> 

					<tr> 
					<td>country :</td>
						<td> <input type="text" name="institutecountry" placeholder="enter country name"  maxlength="30"></input></td>
					</tr> 
					<tr> 
					<td>state :</td>
						<td> <input type="text" name="institutestate" placeholder="enter state name"  maxlength="30"></input></td>
					</tr>
					
					<tr> 
					<td>city :</td>
						<td> <input type="text" name="institutecity" placeholder="enter city name"  maxlength="30"></input></td>
					</tr>
										<tr> 
					<td>town :</td>
						<td> <input type="text" name="institutetown" placeholder="enter town name"  maxlength="30"></input></td>
					</tr>
					<tr> 
					<td>district :</td>
						<td> <input type="text" name="institutedistrict" placeholder="enter district name"  maxlength="30"></input></td>
					</tr>	
					<tr> 
					<td>pin code :</td>
						<td> <input type="text" name="institutepincode" placeholder="enter pin code"  maxlength="30"></input></td>
					</tr>					
					<tr>
					<tr> <?php
			
					if(isset($_POST['Pro'])){
	$planname="Pro";
	$price="$ 24.99 / year";
	$prices="<td>Your Subcribed Plan is $planname</td>
					<td>Total Price $price</td>";
}else
if(isset($_POST['Basic'])){
	$planname="Basic";
	$price="Free";
	$prices="<td>Your Subcribed Plan is $planname</td>
					<td>Total Price $price</td>";
}else
if(isset($_POST['Premium'])){
	$planname="Premium";
	$price="$ 49.99 / year";
	$prices="<td>Your Subcribed Plan is $planname</td>
					<td>Total Price $price</td>";
}else{
	$planname="Basic";
	$price="Free";
	$prices="<td>Your Subcribed Plan is $planname</td>
					<td>Total Price $price</td>";
}
		echo $prices;			?>
					
					</tr>					
					<tr>
					<td><button type="submit" name="createadmin" >create account</button></td>
					</tr>
					
		</table> 
			</form> 		
</fieldset>
		</fieldset>
		</div>
		
<script type="text/javascript">

							  $(document).ready(function(){
    $('#1').click(function(){ 
         $('#phone').addClass('hides');
		 $('#email').removeClass('hides');
    });
    $('#2').click(function(){
         $('#email').addClass('hides');
		 $('#phone').removeClass('hides');
    });
    $('#3').click(function(){
         $('#phone')removeClass('hides');
		 $('#email').removeClass('hides');
    });
});

</script>
</section>
		<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
                     <ol style="text-align: left;">
					 <li><h4>how to select different plan</h4><li>
					 <ol style="text-align: left;">
					 <li>just go to pricing tab and select plan from giving plan and click on sign up button<li>
					 </ol>
					 <li><h4>how to select proper admin id</h4><li>
					 <ol style="text-align: left;">
					 <li>choose charcter and number both for your id<li>
					 </ol>
					 <li><h4>how to select proper admin password</h4><li>
					 <ol style="text-align: left;">
					 <li>choose charcter,number and special character like @,!,#,$,^,&,*  for your password<li>
					 </ol>
					 <li><h4>how to select proper answer for recovery question</h4><li>
					 <ol style="text-align: left;">
					 <li>choose easiest remember to you<li>
					 </ol>
					 </ol>
                  </div>
               </aside>
            </div>
         </div>
      </div>
</html>