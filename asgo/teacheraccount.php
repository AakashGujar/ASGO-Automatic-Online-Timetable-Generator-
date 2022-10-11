<!DOCTYPE html>

<html>
<?php
include('session.php');
include('userheader.php');
include('connection.php');
?>
<html> <div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section class="s-12 l-8">
<?php
$button1='<form method="POST" action=""> 
				<table> 
				<tr > 
			<td colspan=>teacher deregister</td>
			<td> </td>
		</tr>  
		<tr> 
			<td>for delete enter teacher name in below field</td>
			<td> </td>
		</tr>
		<tr>	
			<td> teacher name</td>
			<td> </td>
		</tr>
		<tr> 
		<td> teacher full name</td>	
		<td> <input type="text" id="teacher" name="teacher" placeholder="Enter teacher full name" autofocus  ></td>
		</tr> 
		<tr  style="border:none;">
		    <td colspan=3  style="border:none;"><button style="width:50%; float:left;" id="add" name=delete >deregister teacher</button></td>
		</tr>
		</table> 
		</form>';

$button2='<form method="POST" action=""> 
				<table border="0" > 
				<tr > 
			<td colspan=>teacher register</td>
			<td> </td>
			<td> </td>
		</tr>  
		<tr>	
			<td> teacher name</td>
			<td> </td>
			<td> </td>
		</tr>
		<tr>	
			<td> teacher first name</td>
			<td>&nbsp</td>
			<td> teacher last name</td>
			
		</tr>
		<tr>	
			<td> <input type="text" id="teacher1" name="teacher1" placeholder="Enter teacher first name" autofocus ></input></td>
			<td>&nbsp</td>
			<td> <input type="text" id="teacher2" name="teacher2" placeholder="Enter teacher last name" ></input></td>
		</tr>
		<tr> 
			<td>password</td>
			<td> </td>
			<td> </td>
		</tr> 
		<tr> 
			<td> <input type="text" id="password" name="password" placeholder="aoutomatic generated" class=disable></td>
			<td> </td>
			<td> </td>
		</tr>		
		<tr style="border:none;">
		   <td colspan=3 style="border:none;"> <button style="width:50%; float:left"  id="add" name=add >register teacher</button></td>
		</tr>
		</table> 
		</form> ';


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
$database1=$login_session."_teacherusers";

$error="";
if(isset($_POST['add']))
{
	$teacher1=$_POST['teacher1'];
	$teacher2=$_POST['teacher2'];
	$password=$_POST['password'];
	$a=1;
		if($teacher1 == ""){
			$error="please enter teacher first name in filed to create account of teacher";
			
		}else if($teacher2 == ""){
			$error="please enter teacher last name in filed to create account of teacher";
			
		}else if(($teacher2 == "")&&($teacher1 == "")){
			$error="please enter teacher first name and last  name in filed to create account of teacher";
			
		}else{
		if($password == ""){
		$password=$alphabets.$numericals.$specialchar.$alphabet.$numerical;
		}
$check1="";		
$sql1="SELECT * FROM $database1 ";
$result1 = $conn->query($sql1);
if($result1 != "")
{
$sql2="SELECT username FROM $database1 WHERE username='$teacher1 $teacher2'";
$result2 = $conn->query($sql2);
$check1="1";

if ($result2->num_rows > 0) 
{
 
}else{
	$check1="";
}
}

if($check1 == ""){	
$sql1 = "INSERT INTO `$database1`(`adminname`,`name`,`username`, `password`) VALUES ('$login_session','$teacher1 $teacher2','$teacher1$teacher2@bvp.com','$password')";
$result1 = $conn->query($sql1);
$error="$teacher1 $teacher2 account created ";
if($result1 ==  "")	
{$sql3 = "CREATE TABLE `$database1` (
  `srno` INT NOT NULL AUTO_INCREMENT , 
  `firstname` TEXT,
  `lastname` TEXT,
  `username` TEXT NOT NULL , 
  `adminname` TEXT NOT NULL , 
  `name` TEXT NOT NULL , 
  `password` TEXT NOT NULL , 
  PRIMARY KEY (`srno`),
  UNIQUE(`srno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
;";
$result3 = $conn->query($sql3);
	$sql2 = "INSERT INTO `$database1`(`adminname`,`name`,`username`, `password`) VALUES ('$login_session','$teacher1 $teacher2','$teacher1$teacher2@bvp.com','$password')";
$result2 = $conn->query($sql2);
$error="$teacher1 $teacher2 account created";
}
}else{
	$error="$teacher1 $teacher2 account is already exist";
}
}
$button=$button2;
$instruction='<ol style="text-align: left;">
<li><h4>Instruction for Create account</h4></li>
<ol type=i style="text-align: left;">
<li>1.enter teacher name and click on create account</li>
<li>2.password will automatically genrated</li>
</ol>
</ol>';
}
if(isset($_POST['delete']))
{
	$teacher=$_POST['teacher'];

	$a=1;
		if($teacher == ""){
			$error="please enter teacher name in filed to remove account of teacher";
		}else{
	$sql5="SELECT username FROM $database1 where name='$teacher'";
$result5 = $conn->query($sql5);
if ($result5->num_rows > 0) 
{
		$sql2 = "DELETE FROM `$database1` WHERE `name`= '$teacher';";
$result2 = $conn->query($sql2);
$sql3 = "ALTER TABLE $database1
DROP srno;";
$result3 = $conn->query($sql3);
$sql4 = "ALTER TABLE $database1 ADD `srno` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`srno`);";
$result4 = $conn->query($sql4);	
$error="$teacher account removed";
}else{
	 $error="$teacher username is invaild";
 }
}
 $button=$button1;
 $instruction='<ol style="text-align: left;">
<li><h4>Instruction for remove account</h4></li>
<ol type=i style="text-align: left;">
<li>1.enter teacher name which is presert in table and click on remove account</li>
</ol>
</ol>';
}	
?>

<div id="Period Details">
     <fieldset style="width:100%">
        <legend>Timetable Details</legend> 
		<fieldset style="width:99.9%">
        <legend>School/College teacher Details</legend>
 <form method="POST" action="">    
					<?php	
if(isset($_POST['removeteacheraccount']))
{
$button=$button1;
$instruction='<ol style="text-align: left;">
<li><h4>Instruction for remove account</h4></li>
<ol type=i style="text-align: left;">
<li>1.enter teacher name which is presert in table and click on remove account</li>
</ol>
</ol>';
}
if(isset($_POST['addteacheraccount']))
{
$button=$button2;
$instruction='<ol style="text-align: left;">
<li><h4>Instruction for Create account</h4></li>
<ol type=i style="text-align: left;">
<li>1.enter teacher name and click on create account</li>
<li>2.password will automatically genrated</li>
</ol>
</ol>';
}	
if(isset($_POST['printteacheraccount']))
{
	$instruction="";
	$_SESSION['printteacheraccount'] = "1";
	header('Location:printteacheraccount.php');
	$button=1;
}									
?>
	<div name=button value=<?php if($button == ""){
	header('Location:adminhome.php');}echo $button;
	?> </div>		
				<div> 
                       <td>	
	
 </td >	
  <td>	
<a href="adminhome.php" class="bottom"><button id="add" name=back style="width:20%;font-size:70%;" >back</button></a>
</td>
<br><br>
<td colspan=2>				
<?php echo $error;?>

</td>
					</div>		
			

		</fieldset>
<fieldset style="width:99.9%">
        <legend>all teacher details</legend>
<?php

 
$database1=$login_session."_teacherusers";
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
			$rows2[]		=	 $row2['name'];
			$rows3[]		=	 $row2['adminname'];
			$rows4[]		=	 $row2['username'];
			$rows5[]		=	 $row2['password'];
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
	<th>Name</th>
	<th>admin name</th> 
    <th>teacher User id</th> 
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
		</tr>
		";
		echo $firsttime;
		$i++;
}
 '</center>
 </table>
 
';
}else{
	echo ' <div><tr><td style="border:none;">no teacher user found</td> </tr></div>';
}}else{
	echo ' <div><tr><td style="border:none;">teacher database not found</td> </tr></div>';
}
?>

 <tr>
<td style="border:none;" colspan=3 ><button name="viewmore" id="myBtn">view more</button></td>
 </tr>
 </table>
 </fieldset>
</fieldset>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p><iframe src="printteacheraccount.php" style="height:500px;width:100%;"  scrolling="no"></iframe></p>
  </div>
   </table>
   
</div>
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