<!DOCTYPE html>
<html>
	<?php
include('session.php');
include('userheader.php');
$databasename=$adminusername."_studentusers";
$query1="SELECT * FROM $databasename WHERE username='$login_user'";
$result1 = $conn->query($query1);

if($result1 != ""){	
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$passwords     =	 $row1['password'];
			$usernames     =	 $row1['username'];
		}
}
}
$passwords     =	"h";
$usernames  =	"h1";
?>
				
<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section class="s-12 l-8">
<div id="create form">

     <fieldset >
        <legend> student Details Section</legend> 
           <form method="POST" action="partice.php">
				<table border="0 px">
					<tr> 
					<td> <h4>user details section</h1></td> 
					</tr>
					<tr> 
						<td>student full name :</td>
						<td> <input type="text" name="firstname" placeholder="enter first name" autofocus ></input></td>
						<td> <input type="text" name="lastname" placeholder="enter last name" ></input></td>
					</tr> 
					<tr> 
						<td>studenut id :</td>
						<td> <input type="text" name="adminid" value="<?php echo $usernames;?>" style="disabled"></input></td>
					</tr> 
					<tr> 
						<td>Password :</td>
						<td> <input type="password" name="password" value="<?php echo $passwords;?>" disabled></input></td>
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
                                    <option value="1" >What was your childhood nickname?</option>
                                    <option value="2" >What is your favorite team?</option>
									<option value="3" >In what city or town did your mother and father meet?</option>
                                    <option value="4" >What was your favorite sport in high school?</option>
									<option value="5" >What was the make and model of your first car?</option>
                                    <option value="6" >What was the name of the hospital where you were born?</option>
									<option value="7" >What school did you attend for sixth grade?</option>
                                    <option value="8" >In what town was your first job?</option>
									<option value="9" >What is the name of the place your wedding reception was held?</option>
                                    <option value="10" >What is the name of a college you applied to but didn't attend?</option>
                             </select>
						</td>
					</tr>
					<tr> 
						<td>Answer :</td>
						<td> <input type="text" name="recoveryans" placeholder="enter Answer" ></input></td>
					</tr> 
					<tr>
					<td>Recovery Option</td>
						<td><input type="radio" id="1" name="recovery" value="email" checked>Email</input></td> 
                        <td><input type="radio" id="2" name="recovery" value="phone">Phone no &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </input></td> 
						<td><input type="radio" id="3" name="recovery" value="both">Email and Phone no</input></td> 
					</tr>
					<tr id="email"> 
						<td>Email Id :</td>
						<td> <input type="email" name="recoveryemailid" placeholder="enter Email-id" ></input></td>
					</tr> 
					<tr id="phone" class="hides"> 
						<td>phone no :</td>
						<td> <input type="tel" name="recoveryphone" placeholder="enter Phone no" ></input></td>
					</tr>
					<tr> 
					<td> <h4>User section</h1></td> 
					</tr> 
					<td>Address :</td>
						<td> <input type="text" name="adress" placeholder="enter  Address"  maxlength="30"></input></td>
					</tr> 

					<tr> 
					<td>country :</td>
						<td> <input type="text" name="country" placeholder="enter country name"  maxlength="30"></input></td>
					</tr> 
					<tr> 
					<td>state :</td>
						<td> <input type="text" name="state" placeholder="enter state name"  maxlength="30"></input></td>
					</tr>
					
					<tr> 
					<td>city :</td>
						<td> <input type="text" name="city" placeholder="enter city name"  maxlength="30"></input></td>
					</tr>
										<tr> 
					<td>town :</td>
						<td> <input type="text" name="town" placeholder="enter town name"  maxlength="30"></input></td>
					</tr>
					<tr> 
					<td>district :</td>
						<td> <input type="text" name="district" placeholder="enter district name"  maxlength="30"></input></td>
					</tr>	
					<tr> 
					<td>pin code :</td>
						<td> <input type="text" name="pincode" placeholder="enter pin code"  maxlength="30"></input></td>
					</tr>					
					<tr>
					<td><button type="submit" name="createstudent" >Update Information</button></td>
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
                     
                  </div>
               </aside>
            </div>
         </div>
      </div>
</html>