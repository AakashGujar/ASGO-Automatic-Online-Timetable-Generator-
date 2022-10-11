<!DOCTYPE html>
<html>
	<?php
include('session.php');
include('userheader.php');
$databasename=$adminusername."_teacherusers";
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
?>
				
<div class="line">
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
						<td>teacher full name :</td>
						<td> <input type="text" name="firstname" placeholder="enter first name" autofocus ></input></td>
						<td> <input type="text" name="lastname" placeholder="enter last name" ></input></td>
					</tr> 
					<tr> 
						<td>teacher id :</td>
						<td> <input type="text" name=" teacherid" value="<?php echo $usernames;?>" disabled></input></td>
					</tr> 
					<tr> 
						<td>Password :</td>
						<td> <input type="password" name="password" value="<?php echo $passwords;?>" disabled maxlength=8></input></td>
					</tr> 
					<tr> 
	                 <td>Address :-</td>
					 </tr>
					 <tr>
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
					<td><button type="submit" name="createteacher" >Update Information</button></td>
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
					 <li><h4>how to select proper answer for recovery question</h4><li>
					 <ol style="text-align: left;">
					 <li>choose easiest remember to you<li>
					 </ol>
					 <li><h4>password and id can not be changed</h4><li>
					 </ol> 
                  </div>
               </aside>
            </div>
         </div>
      </div>
</html>