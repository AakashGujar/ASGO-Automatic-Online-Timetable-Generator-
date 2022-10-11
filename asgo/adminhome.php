<?php
   include('session.php');
include('userheader.php');
$_SESSION['classnames']="";
 $_SESSION['classdivs']="";
 $_SESSION['newtimetable'] = "";
 $_SESSION['printteacheraccount'] = "";
 $_SESSION['printstudentaccount'] = "";
?>
<html>
   
   <head>
      <title>Welcome</title>
   </head>
   
   <body>
   <div class="pos" id="error4"><?php include("error4.php");$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error=""; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);?></div>
   <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               <!-- ASIDE NAV 1 -->
               <aside class="s-12 l-3">
                 
                  <div class="aside-nav">
   <div>
   <p>
  
<p></p>

<button class="accordion">Create timetable</button>
<div class="panel">
<form method="POST" action="classinformation.php">
   <p  class="accordionmenubg">
   <button  class="accordionmenu" name="oldtimetable">use old data</button>
   <br>  <br>
	<button class="accordionmenu" name="newtimetable">add new data</button>
	<br>  
	</p>
	</form>  
</div>
<button class="accordion">Time details</button>
<div class="panel">
<form method="POST" action="time_detail.php">
   <p class="accordionmenubg">
   <button  class="accordionmenu" name="institute_time_detail">Institute</button>
    <br>  <br>
	<button  class="accordionmenu" name="teacher_time_detail">Teacher</button>
        <br>  <br>
	<button  class="accordionmenu" name="class_time_detail">Class</button>
	  <br>
	</p>
	</form>  
</div>
	  <button class="accordion">Information</button>
<div class="panel">
<form method="POST" action="insert_information.php">
   <p class="accordionmenubg">
   <button  class="accordionmenu" name="lecture_detail" >Lecture</button>
    <br>  <br>
	<button  class="accordionmenu" name="lecture_place_detail">Lecture Place
                    Name</button>
       <br>  <br>
	<button  class="accordionmenu" name="teacher_detail">Teacher</button>
	  <br>
	</p>
	</form>  
</div>

	  <button class="accordion">timetable: preview, print and preview to all</button>
<div class="panel">
<form method="POST" action="classinformation.php">
   <p class="accordionmenubg">
	<button  class="accordionmenu" name="previewtimetable">preview timetable</button>
	  <br><br>
	  <button  class="accordionmenu" name="previewtimetableall">preview timetable to all</button>
	  <br><br>
	  <button  class="accordionmenu" name="printtimetable">print timetable</button>
	  <br>
	</p>
	</form>  
</div>
<button class="accordion">Teacher: preview, print, create and remove account</button>
<div class="panel">
<form method="POST" action="teacheraccount.php">
   <p class="accordionmenubg">
   <button  class="accordionmenu" name="addteacheraccount">create account</button>
    <br>  <br>
	<button  class="accordionmenu"  name="removeteacheraccount">remove account</button>
	  <br>  <br>
	<button  class="accordionmenu" name="printteacheraccount">preview and print teacher accounts</button>
	  <br>
	</p>
	  </form>
</div>
	  <button class="accordion">student: preview, print, create and remove account</button>
<div class="panel">
<form method="POST" action="studentaccount.php">
   <p class="accordionmenubg"> 
   <button  class="accordionmenu" name="addstudentaccount">create account</button>
    <br>  <br>
	<button  class="accordionmenu" name="removestudentaccount">remove account</button>
	  <br>  <br>
	<button  class="accordionmenu" name="printstudentaccount">preview and print student accounts</button>
	  <br>
	</p>
	  </form>
</div>
 <button class="accordion">Device information</button>
<div class="panel">
<form method="POST" action="deviceinformation.php">
   <p class="accordionmenubg"> 
   <button  class="accordionmenu" name="deviceinformation">View information</button>
    <br>
	</p>
	  </form>
</div>
</p>
	   </div>
  <br>	
     </div>
               </aside>
               <!-- CONTENT -->
               <section class="s-12 l-6">
			   
 <?php
 $used1="";
 $used2="";
 $limit1="";
 $limit2="";
$databasename=$login_session."_teacherusers";
$query1="SELECT * FROM $databasename";
$result1 = $conn->query($query1);
if($result1 != ""){	
$row1=$result1->num_rows;
}else{
	$row1=0;
}	
$databasename1=$login_session."_studentusers";
$query3="SELECT * FROM $databasename1";
$result3 = $conn->query($query3);
if($result3 != ""){	
$row3=$result3->num_rows;
}else{
	$row3=0;
}		
 $query2="SELECT * FROM admininformation WHERE adminid='$user_check'";
$result2 = $conn->query($query2);
if($result2 != ""){	
if ($result2->num_rows > 0) 
{
    while($row2 = $result2->fetch_array())
		{
			$row     =	 $row2;
		}
		if($row['plan'] == "Basic")
{
	$limit1="100 out of ".$row1." used";
	$limit2="1000 out of ".$row3." used";
}
if($row['plan'] == "Pro")
{
	$limit1="1000 out of ".$row1." used";
	$limit2="5000 out of ".$row3." used";
}
if($row['plan'] == "Premium")
{
	$limit1="Unlimited";
	$limit2="Unlimited";
	$used1="Unlimited";
	$used2="Unlimited";
}
}

echo '<table>
<tr>
<td>Acocount</td>
<td>Acocount created</td>
</tr>
<tr>
<td>Teacher Account</td>
<td>'.$used1.$limit1.'</td>
</tr>
<tr>
<td>Student Account</td>
<td>'.$used2.$limit2.'</td>
</tr>

 
</table>';
}
 ?>
  </section>
		<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
                     <ol style="text-align: left;">
					 <li><h4>how to create timetable</h4><li>
<ol style="text-align: left;">
<li>There is two ways for creating timetable</li>
<ol style="text-align: left;">
<li>First way</li>
<ol style="text-align: left;">
<li>1.this way is only effective to update old subject timtable(to create new timetable of old subject)</li>
<li>2.click on use old data under create timetable</li>
<li>3.Then fill class name and div which is old created before and click on next button</li>
</ol>
</ol>
<ol style="text-align: left;">
<li>second way</li>
<ol style="text-align: left;">
<li>1.this way is use to create new timetable</li>
<li>2.click on add new data under create timetable</li>
<li>3.Then fill class name and div which is not used at all and click on next button</li>
<li>4.Then fill detail table properly with help of instruction given on that page then click next button</li>
<li>5.Then fill subject table properly with help of instruction given on that page then click next button</li>
</ol>
</ol>
</ol>
</ol>
                  </div>
               </aside>
            </div>
         </div>
      </div>
	   <?php
include ("footer.php");
?>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
		panel.style.maxHeight = null;
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

	   
	 
   </body>
   
</html>