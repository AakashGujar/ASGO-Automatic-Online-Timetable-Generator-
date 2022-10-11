<?php ob_start();?>
<?php

session_start();
include('header.php');

?>
<html> <div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section class="s-12 l-6">
			<div class="homesec">
				
				<form method="POST" action="login.php">
						<p>
						<h1>Login Section</h1>
						<h4>
						<br>
						<input type="radio" name="radiobutton" id="AdminLogin" checked>Admin Login</input>&nbsp&nbsp&nbsp
						<input type="radio" name="radiobutton" id="TeacherLogin">Teacher Login</input>&nbsp&nbsp&nbsp
						<input type="radio" name="radiobutton" id="StudentLogin">Student Login</input>&nbsp&nbsp&nbsp
						<br>
					    <br>
						<div class="loginsec " id="admin">
						<div class="pos" id="error1"><?php include("error1.php");$myfile1 = fopen("error1.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error=""; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);?></div>
							Admin User Id
							<br>
							
							<input type="text" name="adminid" autofocus ></input>
							<br>
							<br>
							Password
							<br>
							<input type="password" name="adminpass"></input>
							<br>
							<br>
							<button type="submit" name="adminsubmit" style="float:right">Login</button><br><br><div style="color:blue;">you does'nt have account till now
							<br>then create account now<br><button type="submit" name="admincreateform" >Create Account</button></div>

						</div>
						<div class="loginsec hides" id="teacher" >
						<div class="pos"><?php include("error2.php");$myfile2 = fopen("error2.php", "w") or die("Unable to open file!");$txt2 = '<?php $error=""; echo $error;?>';fwrite($myfile2, $txt2);fclose($myfile2);?></div>
							Admin Name
							<br>
							
							<input type="text" name="adminid1" autofocus></input>
							<br>
							<br>
							Teacher User Id
							<br>
							
							<input type="text" name="teacherid"></input>
							<br>
							<br>
							Password
							<br>
							
							<input type="password" name="teacherpass" ></input>
							<br>
							<br>
							<button type="submit" name="teachersubmit">Login</button>
						</div>
						<div class="loginsec hides" id="student">
						<div class="pos"><?php include("error3.php");$myfile3 = fopen("error3.php", "w") or die("Unable to open file!");
   $txt3 = '<?php $error=""; echo $error;?>';
fwrite($myfile3, $txt3);
fclose($myfile3);?></div>
							Admin Name
							<br>
							
							<input type="text" name="adminid2" autofocus></input>
							<br>
							<br>
							Student User Id
							<br>
							
							<input type="text" name="studentid"></input>
							<br>
							<br>
							Password
							<br>
							
							<input type="password" name="studentpass"></input>
							<br>
							<br>
							<button type="submit" name="studentsubmit">Login</button>
							
						</div>
						
						</h4>
						</p>
					</form>
			
				
			</div>
		</section>
		<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-6">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
                     <ol>
					 <li>login to admin</li>
					 <ol>
					 <li>1.enter password and admin user id properly and click on login</li>
					 <li>2.if user doest not have password and admin user id then click on create account</li>
					 </ol>
					 <li>login to teacher</li>
					 <ol>
					 <li>1.enter password ,admin name and Teacher User Id properly and click on login</li>
					 <li>2.if user doest not have password ,admin name and Teacher User Id then contact admin </li>
					 </ol>
					 <li>login to student</li>
					 <ol>
					 <li>1.enter password ,admin name and student User Id properly and click on login</li>
					 <li>2.if user doest not have password ,admin name and student User Id then contact admin </li>
					 </ol>
					 </ol>
                  </div>
               </aside>
            </div>
         </div>
      </div>
			<script type="text/javascript">

	$(document).ready(function(){
    $('#AdminLogin').click(function(){ 
	$("#error1").load(" #error1 > *");
         $('#admin').removeClass('hides');
        $('#teacher').addClass('hides');
        $('#student').addClass('hides');
    });
    $('#TeacherLogin').click(function(){
		$("#error2").load(" #error1 > *");
         $('#teacher').removeClass('hides');
        $('#admin').addClass('hides');
        $('#student').addClass('hides');
    });
    $('#StudentLogin').click(function(){
		$("#error3").load(" #error1 > *");
		$('#student').removeClass('hides');
        $('#teacher').addClass('hides');
        $('#admin').addClass('hides');
    });
});

</script>
</body>
<?php
include ("footer.php");
?>
	
</html>

