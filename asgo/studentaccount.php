<!DOCTYPE html>

<html>

<?php
include('session.php');
include('userheader.php');
include('connection.php');
$instruction="";
if(isset($_POST['printstudentaccount']))
{
	$_SESSION['printstudentaccount'] = "1";
	header('Location:printstudentaccount.php');
	$button=1;
}
$error1="";	
$button1='
<form method="POST" action=""> 
<h4 style="color:red;">please read instrution carefully</h4>
				<table border="0" >
				<tr> 
				<td colspan=4><input type="radio" name="Manually" id="adds1" value="1" checked>Delete account computerized(group of student without entering each student roll no)</input></td>
			   <td colspan=4> <input type="radio" name="Manually" id="adds2" value="0">Delete account Manually(one by one student with entering roll no of  student that you want to delete)</input></td>
				</tr > 
				<tr > 
			<td colspan=8>student deregister</td>
		</tr>  
		<tr>
	<td colspan=3>class name</td>
	<td colspan=3><input id="classname" type="text" name="classname" placeholder="class name" autofocus></td>
	</tr>
	<tr>
	<td colspan=3>class div</td>
	<td colspan=3><input id="classdiv" type="text" name="classdiv" placeholder="class div" ></td>
	</tr>
	<div id=add1 >
		<tr id=add1 > 
			<td colspan=3>starting students roll no</td>
			<td colspan=3> <input type="text" id="rollstart" name="rollstart" placeholder="Enter student start roll no"></td>
		</tr> 
		<tr id=add1> 
			<td colspan=3>ending students roll no </td>
			<td colspan=3> <input type="text" id="rollend" name="rollend" placeholder="Enter student end roll no"></td>
		</tr>
		<tr>
		<th colspan=9><center>OR</center></th>
		<tr>
		</div>
		<div id=add2>
		<tr id=add2>	
			<td colspan=3>student roll no</td>
		
			<td colspan=3> <input type="text" id="rollno" name="rollno" placeholder="Enter roll no"></td>
		</tr>  
		<tr id=add2>
		    <td colspan=3><button id="add" name=delete >deregister student</button></td>
		</tr> 
		</div>
		</table> 
		</form>
		<a href="adminhome.php" class="bottom"><button id="add" name="back" style="width:20%;font-size:70%;">back</button></a>
		';

$button2='
 <form method="POST" action=""> 
 <h4 style="color:red;">please read instrution carefully</h4>
				<table border="0" > 
				<tr > 
				<td colspan=3><input type="radio" name="Manually" id="adds1" value="1" checked>Create account computerized(group of student without name)</input></td>
			   <td colspan=3><input type="radio" name="Manually" id="adds2" value="0">Create account Manually(one by one student with name)</input></td>
				</tr >
				<tr > 
			<td colspan=3>students register</td>
		</tr> 
		<tr>
	<td>class name</td>
	<td><input id="classname" type="text" name="classname" placeholder="class name" ></td>
	</tr>
	<tr>
	<td>class div</td>
	<td><input id="classdiv" type="text" name="classdiv" placeholder="class div" ></td>
	</tr>
				<div  id=add1 >				
		<tr> 
			<td colspan=2>starting students roll no</td>
			<td colspan=2> <input type="text" id="rollstart" name="rollstart" placeholder="Enter student start roll no"></td>
		</tr> 
		<tr> 
			<td colspan=2>starting students roll no </td>
			<td colspan=2> <input type="text" id="rollend" name="rollend" placeholder="Enter student end roll no"></td>
		</tr>		
		<tr>
		<th colspan=9><center>OR</center></th>
		<tr>
		</div>
		<div id=add2 class="hides">
		<tr> 
			<td colspan=2>student name for register</td>
			<td colspan=2> <input type="text" id="student" name="student" placeholder="Enter student name"></td>
		</tr> 
		<tr> 
			<td colspan=2>student roll no for register</td>
			<td colspan=2> <input type="text" id="rollno" name="rollno" placeholder="Enter student roll no"></td>
		</tr> 
		<tr> 
			<td colspan=2> password</td>
			<td colspan=2> <input type="text" id="password" name="password" placeholder="aoutomatic generated" class=disable></td>
		</tr>		
		<tr>
		   <td colspan=3> <button id="add" name=add >register student</button></td>
		</tr>
		</div>
		</table> 
		</form>
		<a href="adminhome.php" class="bottom"><button id="add" name="back" style="width:20%;font-size:70%;">back</button></a>';

$database1=$login_session."_studentusers";

$error="";
if(isset($_POST['add']))
{
	$classnames = $_POST['classname'];
	$classdivs = $_POST['classdiv'];
	$class=$classnames.$classdivs;
	$manually=$_POST['Manually'];
	if($manually == "1")
	{
	$rs=$_POST['rollstart'];
	$re=$_POST['rollend'];
	}else{
		$rollno=$_POST['rollno'];
		$students=$_POST['student'];
	}			
function createaccount($check1, $rollno ,$conn ,$database1 ,$student,$class,$login_session){
$password = "";	

if($password == ""){
			$specialchar2 = array("`", "~", "!", "@", "$","#", "%", "^", "&", "*", "-", "_", "=", "+", ".", "/" , "|", "?");
			$specialchar1 = array_rand($specialchar2, 2);
			$specialchar=$specialchar2[$specialchar1[0]];

			$alphabet2 = array("a", "b", "c", "d", "e","f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p" , "q", "r", "s", "t", "u", "v", "w","x", "y", "z","A", "B", "C", "D", "E","F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P" , "Q", "R", "S", "T", "U", "V", "W","X", "Y", "Z" );
			$alphabet1 = array_rand($alphabet2, 4);
			$alphabets = $alphabet2[$alphabet1['0']].$alphabet2[$alphabet1['1']];
			$alphabet =$alphabet2[$alphabet1['2']].$alphabet2[$alphabet1['3']];

			$numerical2 = array("1", "2", "3", "4", "5","6", "7", "8", "9");
			$numerical1 = array_rand($numerical2, 4);
			$numericals = $numerical2[$numerical1['0']].$numerical2[$numerical1['1']];
			$numerical=$numerical2[$numerical1['2']].$numerical2[$numerical1['3']];

			$password=$alphabets.$numericals.$specialchar.$alphabet.$numerical;
			}
	

if($check1 == ""){	
$sql1 = "INSERT INTO `$database1`(`adminusername`,`class`, `rollno`, `username`, `password`) VALUES ('$login_session','$class','$rollno','$student@bvp.com','$password')";
$result1 = $conn->query($sql1);

if($result1 ==  "")	
{$sql3 = "CREATE TABLE `$database1` (
  `srno` INT NOT NULL AUTO_INCREMENT ,
  `firstname` TEXT,
  `lastname` TEXT,  
  `class` TEXT NOT NULL , 
  `rollno` INT NOT NULL ,
  `adminusername` TEXT NOT NULL ,  
  `username` TEXT NOT NULL , 
  `password` TEXT NOT NULL , 
  PRIMARY KEY (`srno`),
  UNIQUE(`srno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
;";

$result3 = $conn->query($sql3);
	$sql2 = "INSERT INTO `$database1`(`adminusername`,`class`, `rollno`, `username`, `password`) VALUES ('$login_session','$class','$rollno','$student@bvp.com','$password')";
$result2 = $conn->query($sql2);

}
}

}

if($manually == "0"){
$student=$students;
$rollno=$rollno;
$check1="";	

$sql2="SELECT username FROM $database1 WHERE username='$student'";
$result2 = $conn->query($sql2);
$check1="1";
if($result2 != ""){
if ($result2->num_rows > 0) 
{
 $error="$student account is already exist";
 
}else{
	$sql3="SELECT rollno FROM $database1 WHERE rollno='$rollno'";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) 
{
 $error="$rollno roll no account is already exist";
 
}else{
	$check1="";
	createaccount($check1, $rollno ,$conn ,$database1 ,$student ,$class,$login_session);
$error="$student account created ";
}
}}else{
	createaccount($check1, $rollno ,$conn ,$database1 ,$student ,$class,$login_session);
$error="$student account created ";
}

}else{		if($rs == ""){
			$error="please enter student stating rollno ";
			
		}else if($re == ""){
			$error="please enter student ending rollno ";
			
		}else{
			
if($rs<$re){			
for($i=$rs;$i<=$re;)	{
	$rollno=$i;
	$sql2="SELECT rollno FROM $database1 WHERE rollno='$rollno'";
$result2 = $conn->query($sql2);
$check1="1";
if($result2 != ""){
if ($result2->num_rows > 0) 
{
 $error1="some of  roll no account is already exits";
 
}else{
			
$check1="";
$student=$rollno;
createaccount($check1, $rollno ,$conn ,$database1 ,$student ,$class,$login_session);
$error="students account created ";
}
}else{
	$check1="";
	$student=$rollno;
	createaccount($check1, $rollno ,$conn ,$database1 ,$student ,$class,$login_session);
$error="students account created ";
}
$i++;
}

}else{
	$error="please enter student ending rollno porper";
}
}
}
$button=$button2;
$instruction='<ol style="text-align: left;">
<li><h4>Instruction for Create account Manually</h4></li>
<ol type=i style="text-align: left;">
<li>1.This is helpful only for when you want to create one student account</li>
<li>2.fill class name add div field first</li>
<li>3.click on Create account Manually and enter student name in studet name for registor field</li>
 <li>4.click on register account</li>
<li>5.password will automatically genrated</li>
</ol>
<li><h4>Instruction for Create account computerized</h4></li>
<ol type=i style="text-align: left;">
<li>1.This is helpful when group of student account you want to create</li>
<li>2.fill class name add div field first</li>
<li>3.click on Create account computerized and enter first roll no of student in class and studet last roll no of student in class in respective field</li>
 <li>4.click on register account</li>
<li>5.password will automatically genrated</li>
</ol>
</ol>';
}
if(isset($_POST['delete']))
{
	$classnames = $_POST['classname'];
	$classdivs = $_POST['classdiv'];
$class=$classnames.$classdivs;	
	$manually=$_POST['Manually'];
	if($manually == "1")
	{
	$rs=$_POST['rollstart'];
	$re=$_POST['rollend'];
	}else{
		$rollno=$_POST['rollno'];
		
	}
function extractrollno($rollno,$conn ,$database1 ,$class){

$sql5="SELECT * FROM $database1 where rollno=$rollno";
$result5 = $conn->query($sql5);

if ($result5->num_rows > 0) 
{
		$sql2 = "DELETE FROM `$database1` WHERE `rollno`= '$rollno'  AND `class` = '$class';";
$result2 = $conn->query($sql2);
if($result2 == ""){
	return	$error=" roll no account removed";
}else{
	return	$error="roll no account is not exits";
}	
}else{
	return $error="roll no account is not exits";	
}

}	
if($manually == "1"){
			if($rs == ""){
			$error="please enter student stating rollno ";
			
		}else if($re == ""){
			$error="please enter student ending rollno ";
			
		}else{
			
if($rs<$re){			
for($i=$rs;$i<=$re;)	{
	$rollno=$i;
	$error =extractrollno($rollno,$conn ,$database1 ,$class);
$i++;
}

}else{
	$error="please enter student ending rollno porper";
}
}
	}else{		if($rollno == ""){
			$error="please enter rollno in filed to remove account of student";
		}else{
	$error =extractrollno($rollno,$conn ,$database1 ,$class);
	

 }
	}

$sql3 = "ALTER TABLE $database1
DROP srno;";
$result3 = $conn->query($sql3);
$sql4 = "ALTER TABLE $database1 ADD `srno` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`srno`);";
$result4 = $conn->query($sql4);	


 $button=$button1;
 $instruction='<ol style="text-align: left;">
<li><h4>Instruction for Delete account Manually</h4></li>
<ol type=i style="text-align: left;">
<li>1.This is helpful only for when you want to remove one student account</li>
<li>2.fill class name add div field first</li>
<li>3.click on Delete account Manually and enter student roll no in studet roll no field</li>
 <li>4.click on deregister account</li>
</ol>
<li><h4>Instruction for Delete account computerized</h4></li>
<ol type=i style="text-align: left;">
<li>1.This is helpful when group of student account you want to remove</li>
<li>2.fill class name add div field first</li>
<li>3.click on Delete account computerized and enter first roll no of student in class and studet last roll no of student in class in respective field</li>
 <li>4.click on deregister account</li>
</ol>
</ol>';
}	
?>
  <div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section class="s-12 l-8">
<div id="Period Details">
     <fieldset style="width:99%">
        <legend>Timetable Details</legend> 
		<fieldset style="width:99.7%">
        <legend>School/College student Details</legend>
 <form method="POST" action="">    
					<?php	
if(isset($_POST['removestudentaccount']))
{
$button=$button1;
$instruction='<ol style="text-align: left;">
<li><h4>Instruction for Delete account Manually</h4></li>
<ol type=i style="text-align: left;">
<li>1.This is helpful only for when you want to remove one student account</li>
<li>2.fill class name add div field first</li>
<li>3.click on Delete account Manually and enter student roll no in studet roll no field</li>
 <li>4.click on deregister account</li>
</ol>
<li><h4>Instruction for Delete account computerized</h4></li>
<ol type=i style="text-align: left;">
<li>1.This is helpful when group of student account you want to remove</li>
<li>2.fill class name add div field first</li>
<li>3.click on Delete account computerized and enter first roll no of student in class and studet last roll no of student in class in respective field</li>
 <li>4.click on deregister account</li>
</ol>
</ol>';
}
if(isset($_POST['addstudentaccount']))
{
$button=$button2;
$instruction='<ol style="text-align: left;">
<li><h4>Instruction for Create account Manually</h4></li>
<ol type=i style="text-align: left;">
<li>1.This is helpful only for when you want to create one student account</li>
<li>2.fill class name add div field first</li>
<li>3.click on Create account Manually and enter student name in studet name for registor field</li>
 <li>4.click on register account</li>
<li>5.password will automatically genrated</li>
</ol>
<li><h4>Instruction for Create account computerized</h4></li>
<ol type=i style="text-align: left;">
<li>1.This is helpful when group of student account you want to create</li>
<li>2.fill class name add div field first</li>
<li>3.click on Create account computerized and enter first roll no of student in class and studet last roll no of student in class in respective field</li>
 <li>4.click on register account</li>
<li>5.password will automatically genrated</li>
</ol>
</ol>';
}										
?>
	<div name="button" value=<?php if($button == ""){
	header('Location:adminhome.php');}
	echo $button;
	?> 	
	 
                      	

				
<?php if($error1 != "") 
{ 
if($error != "")
{
	echo " some ".$error." and ".$error1;
	}else
	{
		echo "all roll no account is aready exits";}
		}else
		{
	 echo $error;
}?>


<script type="text/javascript">

	$(document).ready(function(){
    $('#adds1').click(function(){ 
	   $('#add1').removeClass('hides');
       $('#add2').addClass('hides');
    });
    $('#adds2').click(function(){
        $('#add2').removeClass('hides');
        $('#add1').addClass('hides');   
    });
   
<?php
?>
</script>
					</div>		
			

		</fieldset>
<fieldset style="width:99.9%">
        <legend>all student details</legend>
<?php

 
$database1=$login_session."_studentusers";
$sql1="SELECT * FROM $database1 ";
$result1 = $conn->query($sql1);
if($result1 != "")
{
 $sql2="SELECT * FROM $database1 limit 5";
$result2 = $conn->query($sql2);
$check="1";
if ($result2->num_rows > 0) 
{
    // output data of each row
    while($row2 = $result2->fetch_array())
		{
			$srno 		    =	 $row2['srno'];
			$rows1[]		=	 $row2['srno'];
			$rows2[]		=	 $row2['class'];
			$rows3[]		=	 $row2['rollno'];
			$rows4[]		=	 $row2['adminusername'];
			$rows5[]		=	 $row2['username'];
			$rows6[]		=	 $row2['password'];
		}
}else{
	$check="";
}
if($check != ""){
	


echo'
<table style="width:100%;text-align:center;border-collapse:collapse;border: 1px solid  white;" border="1px">
<center>
  <tr>
    <th>Sr no</th>
	<th>class</th>
	<th>roll no</th>
	<th>admin Name</th> 
    <th>student User id</th> 
    <th>Password</th> 
	</tr>
	';
	for($i=0;$i<$srno;)
{
	$firsttime="<tr>
		   <td>".$rows1[$i]."</td>
		   <td>".$rows2[$i]."</td>
		   <td>".$rows3[$i]."</td>
		<td>".$rows4[$i]."</td>
		<td>".$rows5[$i]."</td>
		<td>".$rows6[$i]."</td>
		</tr>
		";
		echo $firsttime;
		$i++;
}
 '</center>
 </table>
 
';
}else{
	echo ' <div><tr><td style="border:none;">no student user found</td> </tr></div>';
}}else{
	echo ' <div><tr><td style="border:none;">student database not found</td> </tr></div>';
}
?>
 <tr>
<td style="border:none;" colspan=4><button name="viewmore" id="myBtn">view more</button></td>
 </tr>

 </fieldset>
</fieldset>
 <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p><iframe src="printstudentaccount.php" style="height:500px;width:100%;"  scrolling="no"></iframe></p>
  </div>
  </table>
</section>
		<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
                    <?php echo $instruction;?>
             </div>
               </aside>
            </div>
         </div>
      </div>

<?php
include ("footer.php");
?>
</div>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
 </div>
</html>