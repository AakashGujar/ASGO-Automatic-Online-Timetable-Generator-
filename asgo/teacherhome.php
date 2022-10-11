<?php
   include('session.php');
include('userheader.php');
?>
<html>
   
   <head>
      <title>Welcome</title>
   </head>
   
   <body>
   <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               <!-- ASIDE NAV 1 -->
               <aside class="s-12 l-3">
                 
                  <div class="aside-nav">
				   <div>
   <p>
  <div class="pos" id="error4"><?php include("error4.php");$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error=""; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);?></div>
<p></p>

	  <button class="accordion">timetable: preview and print</button>
<div class="panel">
<form method="POST" action="previewtimetableall.php">
   <p class="accordionmenubg">
	<button name="teacherpreviewtimetable" class="accordionmenu">preview timetable</button>
	  <br><br>
	  <button name="teacherprinttimetable" class="accordionmenu">print timetable</button>
	  <br>
	</p>
	</form>  
</div>
<button class="accordion">file: upload ,remove and change permission</button>
<div class="panel">
<form method="POST" action="files.php">
   <p class="accordionmenubg">
	<button name="uploadfile" class="accordionmenu">upload file</button>
	  <br><br>
	  <button name="removefile" class="accordionmenu">remove file</button>
	  <br><br>
	  <button name="permissionchange" class="accordionmenu">file permission change</button>
	  <br>
	</p>
	</form>  
</div>
       </p>
	   </div>
	        
                  </div>
               </aside>
               <!-- CONTENT -->
               <section class="s-12 l-6">
 <?php
 $database1=$login_database."filelist"; 
 function counts($conn ,$database1){
	$x=0;
	$sql1="SELECT counts FROM $database1 WHERE srno=1";
$result1 = $conn->query($sql1);
if($result1 != ""){
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$counts     =	 $row1['counts'];
		}
}
$x=$counts;
return $x;
}else{
	$sql4 = "ALTER TABLE $database1 ADD `counts` INT(11);";
$result4 = $conn->query($sql4);
$x=0;	
 updated($conn ,$database1,$x);
return $x;	
}

}
function updated($conn ,$database1,$x){
$sql5 = "UPDATE `$database1` SET `counts` = '$x' WHERE `srno` = 1";
$result5 = $conn->query($sql5);	
}
if(isset($_POST['next']))
{
	$x=counts($conn ,$database1);
	$y=$x+3;
	if($y < $srnos){

$x=$x+3;
updated($conn ,$database1,$x);
	}else{
		if($x > 0){
		$x=$srnos-3;
		}else{
			$x=0;
		}
		updated($conn ,$database1,$x);
	
	}
}
else if(isset($_POST['previous']))
{
	$x=counts($conn ,$database1);
	$x=$x-3;
	if($x >= 0)
		{
	updated($conn ,$database1,$x);
	}else{
		$x=0;
		updated($conn ,$database1,$x);
	}
}
else if(isset($_POST['last']))
{
	$x=counts($conn ,$database1);
	$x=$srnos-3;
	if($x < -0){
		$x=0;
	}else{
		$x=$srnos-3;
	}
	updated($conn ,$database1,$x);
}
else if(isset($_POST['first']))
{
	$x=counts($conn ,$database1);
	$x=0;
	updated($conn ,$database1,$x);
}else{
	$x=0;;
	updated($conn ,$database1,$x);
	}

 $query1 = "SELECT * FROM $database1";
$result1 = $conn->query($query1);
if($result1 != "")
{	
if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$studentpermissions[]	  	= 	$row1['studentpermission'];	
			$srno	  	= 	$row1['srno'];	
			$filename	  	= 	$row1['filename'];	
			$upload	  	= 	$row1['uploaddate'];	
		}
}
$ycount=0;
$ncount=0;
for($i=0;$i<$srno;)
{
	if($studentpermissions[$i]=="yes")
	{
		$ycount=$ycount+1;
	}else{
		$ncount=$ncount+1;
	}
	$i++;
}
echo '<table>
	<tr>
	    <th colspan=2><center>file Record</center></th>
	</tr>
   <tr>	
		<td>Total uploaded file</td>
		<td>'.$srno.'</td>
	</tr>
	<tr>
		<td>Last Uploaded file name</td>
		<td>'.$filename.'</td>
	</tr>
	<tr>
		<td>Last Uploaded file Date</td>
		<td>'.$upload.'</td>
	</tr>
	<tr>
		<td>Total permission give to student for acess file</td>
		<td>'.$ycount.'</td>
	</tr>
	<tr>
		<td>Total permission give to student for not acess file</td>
		<td>'.$ncount.'</td>
	</tr>
 </table>';
}else{
	  echo '<table>
	<tr>
	    <th colspan=2><center>file Record</center></th>
	</tr>
   <tr>	
		<td>Total uploaded file</td>
		<td>There is No Record Of files</td>
	</tr>
	<tr>
		<td>Last Uploaded file name</td>
		<td>There is No Record Of files</td>
	</tr>
	<tr>
		<td>Last Uploaded file Date</td>
		<td>There is No Record Of files</td>
	</tr>
	<tr>
		<td>Total permission give to student for acess file</td>
		<td>There is No Record Of files</td>
	</tr>
	<tr>
		<td>Total permission give to student for not acess file</td>
		<td>There is No Record Of files</td>
	</tr>
 </table>';
 }
 
 $query2 = "SELECT filename FROM $database1 WHERE studentpermission='yes'";
$result2 = $conn->query($query2);
if($result2 != "")
{	
$rowscounts=$result2->num_rows;
if ($rowscounts > 0) 
{
	$filename=array();
    // output data of each row
    while($row2 = $result2->fetch_array())
		{
			$filename[]	  	= 	$row2['filename'];	
		}
}

echo '<table>
<tr>
<td colspan=4></td>
</tr>
	<tr>
	    <th colspan=4><center>Record of permited files</center></th>
	</tr>
   <tr>	
		<td colspan=2>srno</td>
		<td colspan=2>Filename</td>
	</tr>';
	$n=$x+3;
 for($i=$x;$i<$n;){
	 if($i < $rowscounts){
 echo '<tr><td colspan=2>'.($i+1).'</td><td colspan=2>'.$filename[$i].'</td></tr>';
	 }else{
	echo'<tr>
	<td colspan=2>----</td>
	<td colspan=2>----</td>
	</tr>
	';
}
 $i++;
     
 }
 if($rowscounts > 3){
echo '<form method="POST" action="teacherhome.php"> <tr >
<td ><button name="previous">&#8249; Previous</button></td>
<td ><button name="first">&laquo; start</button></td>
<td ><button name="last">end &raquo;</button></td>
<td><button name="next">Next &#8250;</button></td>
</tr></form>';

	'</center>
 </table>';
}
}else{
	 echo "<table>
	<tr>
	    <th colspan=2><center>Record of permited files</center></th>
	</tr>
	<tr>	
		<td colspan=2>srno</td>
		<td colspan=2>Filename</td>
	</tr>
   <tr>
		<td colspan=2>There is No Record Of files</td>
		<td colspan=2>There is No Record Of files</td>
	</tr></table>";
 }
  $query3 = "SELECT filename FROM $database1 WHERE studentpermission='no'";
$result3 = $conn->query($query3);
if($result3 != "")
{	
$rowscounts1=$result3->num_rows;
if ($rowscounts1 > 0) 
{
	$filename=array();
    // output data of each row
    while($row3 = $result3->fetch_array())
		{
			$filename[]	  	= 	$row3['filename'];	
		}
}

echo '<table>
<tr>
<td colspan=4></td>
</tr>
	<tr>
	    <th colspan=4><center>Record of not permited files</center></th>
	</tr>
   <tr>	
		<td colspan=2>srno</td>
		<td colspan=2>Filename</td>
	</tr>';
	$n=$x+3;
 for($i=$x;$i<$n;){
	 if($i < $rowscounts1){
 echo '<tr><td colspan=2>'.($i+1).'</td><td colspan=2>'.$filename[$i].'</td></tr>';
	 }else{
	echo'<tr>
	<td colspan=2>----</td>
	<td colspan=2>----</td>
	</tr>
	';
}
 $i++;
     
 }
 if($rowscounts1 > 3){
echo '<form method="POST" action="files.php"> <tr >
<td ><button name="previous">&#8249; Previous</button></td>
<td ><button name="first">&laquo; start</button></td>
<td ><button name="last">end &raquo;</button></td>
<td><button name="next">Next &#8250;</button></td>
</tr></form>';

	'</center>
 </table>';
}
}else{
	 echo "<table>
<tr>
<td colspan=4></td>
</tr>
	<tr>
	    <th colspan=4><center>Record of not permited files</center></th>
	</tr>
   <tr>	
		<td colspan=2>srno</td>
		<td colspan=2>Filename</td>
	</tr>
   <tr>	
		<td colspan=2>There is No Record Of files</td>
		<td colspan=2>There is No Record Of files</td>
	</tr></table>";
 }
 ?>
 </table>
   </section> 
<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
				  <ol>
                     <li>you have to click on print timetable under timetable: preview and print to get print</li>
						<li><br></li>
						<li>you have to click on  preview timetable under timetable: preview and print to preview timetable </li>
						<li><br></li>
						<li>you have to click on upload file  under file: upload ,remove and change permission
						   to upload file</li>
						<li><br></li>
						<li>you have to click on remove file  under file: upload ,remove and change permission
						   to remove file </li>
						<li><br></li>
						<li>file that you doent want to display to student change file permission to no by click on  change permission under file: upload ,remove and change permission for  </li>
						<li><br></li>
						<li>file that you  want to display to student change file permission to yes by click on  change permission under file: upload ,remove and change permission for  </li>
						<li><br></li>
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