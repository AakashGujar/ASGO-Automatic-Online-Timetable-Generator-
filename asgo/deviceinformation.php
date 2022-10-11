<?php
include('session.php');
include('userheader.php');

  //fetching class time
  if(isset($_POST['class_name']))
  {
	  //print_r($_POST);
	  $class_name=trim(str_replace(' ', '',$_POST["class_name"]));
	  $srno=trim(str_replace(' ', '',$_POST["id"]));
	 
	  if($class_name != " "){
		  
		  /* Extractin  freesolt information from free_solt_detail table in database */
      $query3="UPDATE startup_details SET class_name='".$class_name."' WHERE ID='".$srno."'";
	  $result3=$conn->query($query3);/* execution of query */
	  
	  $myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="Sucefully Update"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
	
	  }else{
		  $myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="Something went wrong!. Please Contact Website Adminstrative"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
		  
	  }
  }
	   
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
<form method="POST" action="classinformation">
   <p class="accordionmenubg">
   <button  class="accordionmenu" name="adddetails">Add time</button>
    <br>  <br>
	<button  class="accordionmenu" name="updatedetails">Update time</button>
	  <br>
	</p>
	</form>  
</div>
	  <button class="accordion">Subject details</button>
<div class="panel">
<form method="POST" action="classinformation.php">
   <p class="accordionmenubg">
   <button  class="accordionmenu" name="addsubject" >Add Subject </button>
    <br>  <br>
	<button  class="accordionmenu" name="updatesubject">Update Subject</button>
	  <br>
	</p>
	</form>  
</div>
<button class="accordion">add all:Subject and teacher</button>
<div class="panel">
<form method="POST" action="classinformation.php">
   <p class="accordionmenubg">
   <button  class="accordionmenu" formaction="addsubjects" name="addsubjects">Add Subject </button>
    <br>  <br>
	<p style=" background-color: #eee;text-align: left;font-size: 18px;padding: 15px;color:red;">*ATTENTION:-teachers are automatical added on creation of their account</p>
	  <br>
	</p>
	</form>  
</div>
<button class="accordion">remove all:Subject and teacher</button>
<div class="panel">
<form method="POST" action="classinformation.php">
   <p class="accordionmenubg">
   <button  class="accordionmenu" formaction="addsubjects" name="removesubjects">remove Subject </button>
    <br>  <br>
	<p style=" background-color: #eee;text-align: left;font-size: 18px;padding: 15px;color:red;">*ATTENTION:-
    	teachers are automatical removed on deletion of their account</p>
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
               <section class="s-12 l-9">
			<form method="POST" action="deviceinformation.php">   
 <?php
 
 $query2="SELECT * FROM startup_details WHERE adminid='$user_check'";
$result2 = $conn->query($query2);
if($result2 != ""){	
if ($result2->num_rows > 0) 
{
	echo '<table>
<tr>
<td>Sr No</td>
<td>Device Id</td>
<td>Class Name</td>
<td>day</td>
<td>Current Lecture No</td>
<td>Current Date and Time</td>
<td>Update</td>
</tr>';
$day_array=array('Monday','Tuesday','Wensday','Thursday','Friday','Saturday');
while($row2 = $result2->fetch_array())
		{
			$lecture_ids=$row2["lecture_id"]-1;
			$class_name=$row2["class_name"];
			 /* Extractin  freesolt information from free_solt_detail table in database */
      $sql_query0="SELECT  *  FROM  ".$class_name."_time_detail";
	  $result0=$conn->query($sql_query0);/* execution of query */
      /* extractinng from free_solt_detail table in database */
      $data0 = $result0->fetch_array();
			
			
			if($lecture_ids == 0)
			{
				$lecture_ids=$data0['col_daily_lecture_count'];
			}
			echo '
<tr>
<td>'.$row2["ID"].'</td>
<td>'.$row2["Device_id"].'</td>
<td><select name="class_name">';
						
						
						echo '
							<option value="'.$class_name.'">'.$class_name.'</option>
						  ';
						$query3="SELECT col_class_name FROM free_solt_detail";
$result3 = $conn->query($query3);
						while($row3 = $result3->fetch_array())
		{
							if($row2["class_name"] != $row3["col_class_name"] && $row3["col_class_name"] != Null)
							{
								echo '<option value="'.$row3["col_class_name"].'">'.$row3["col_class_name"].'</option>';
							}
						}
						
              echo '</select> </td>
<td>'.$day_array[$row2["weekday"]].'</td>
<td>'.$lecture_ids.'</td>
<td>'.$row2["date"]." ".$row2["time"].'</td>
<td><button name="id" value="'.$row2["ID"].'">Update</button></td>
</tr>';
		}
	echo '</table>';	
	
}
else{
echo '<table>
<tr>
<td>Sr No</td>
<td>Device Id</td>
<td>Class Name</td>
<td>day</td>
<td>Current Lecture No</td>
<td>Current Date and Time</td>
<td>Update</td>
</tr>
<tr>
<td colspan="7"><center>No Device Found</center></td>
</tr>

 
</table>';
}
}
 ?>
 </form>
  </section>
            </div>
         </div>
      </div>
	   <?php
include ("footer.php");
?>

	 
   </body>
   
</html>