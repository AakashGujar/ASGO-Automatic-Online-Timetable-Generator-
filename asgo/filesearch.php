<?php
   include('session.php');
include('userheader.php');
if(isset($_POST['back']))
{
header('Location:studenthome.php');
}

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
                <!-- CONTENT -->
               <section class="s-12 l-9">
 
 
 <?php
 $database1=$adminusername."_teacherusers";
 
 $sql1="SELECT * FROM $database1 ";
$result1 = $conn->query($sql1);
if($result1 != "")
{
 $sql2="SELECT * FROM $database1";
$result2 = $conn->query($sql2);
$check="1";
if ($result2->num_rows > 0) 
{
    // output data of each row
    while($row2 = $result2->fetch_array())
		{
			$srno 		    =	 $row2['srno'];
			$rows1[]		=	 $row2['srno'];
			$rows3[]		=	 $row2['firstname'];
			$rows4[]		=	 $row2['lastname'];
			$rows2[]		=	 $row2['name'];
			$rows5[]		=	 $row2['username'];
		}
}else{
	$check="";
}
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
	$y=$x+6;
	if($y < $srno){

$x=$x+6;
updated($conn ,$database1,$x);
	}else{
		if($x > 0){
		$x=$srno-6;
		}else{
			$x=0;
		}
		updated($conn ,$database1,$x);
	}
}
else if(isset($_POST['previous']))
{
	$x=counts($conn ,$database1);
	$x=$x-6;
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
$x=$srno-6;
	if($x < -0){
		$x=0;
	}else{
		$x=$srno-6;
	}
	updated($conn ,$database1,$x);
}
else if(isset($_POST['first']))
{
	$x=counts($conn ,$database1);
	$x=0;
	updated($conn ,$database1,$x);
}else{
	$x=0;
	updated($conn ,$database1,$x);
	}
if($check != ""){
		
echo'
<table style="width:100%;text-align:center;border-collapse:collapse;border: 1px solid  white;" border="1px">
<center>
  <tr>
    <th>Sr no</th>
	<th>Name</th>
	<th>First File</th> 
    <th>Second File</th> 
    <th>More</th> 
	';
	$srno1 =$x+6;
	for($i=$x;$i<$srno1;)
{
	if($i < $srno){
	$database2=$adminusername."_".$rows3[$i].$rows4[$i]."_filelist";
	$sql3="SELECT * FROM $database2 WHERE studentpermission='yes'";
$result3 = $conn->query($sql3);
$check=0;
$srnos=array();
if($result3 != ""){
	$rowcount=$result3->num_rows;
if ($rowcount > 0) 
{
    // output data of each row
    while($row2 = $result3->fetch_array())
		{
			$rows6[]		=	 $row2['filename'];	
		}
		$check=1;
		$srnos=$rowcount;
}else{
	$check=0;
}
}
if($i < $srno){
	if($rows1[$i] != "")
	{
	$firsttime="<tr>
		   <td>".$rows1[$i]."</td>
		<td>".$rows2[$i]."</td>";
	if($check==1){
    $_SESSION['teacherfoldername']="'$adminusername$rows5[$i]'";
	$firsttime1="<td><a href=download.php?link=".$rows6[0].">".$rows6[0]."</a></td>
	<td><a href=download.php?link=".$rows6[1].">".$rows6[1]."</a></td>";
	}else{$firsttime1="<td>----</td><td>----</td>";
	$srnos=0;}
	if($srnos >= 3){
		$firsttime2="<td><a href=teacherfile.php?username=".$rows3[$i]."%20".$rows4[$i].">more files</a><td>
		</tr>
		";
}else{
		$firsttime2="<td>----<td>
		</tr>
		";
}
		echo $firsttime;
		echo $firsttime1;
		echo $firsttime2;
		}
}
	}else{
		$firsttimen="<tr>
		   <td>------</td>
		<td>------</td>
		<td>------</td>
		<td>------</td>
		<td>------</td>
		</tr>
		";
		echo $firsttimen;
	}
		$i++;
		
}
 '</center>
 </table>
 
';
}else{
	echo ' <div><tr><td style="border:none;">no teacher user found</td> </tr><br><br><br><br><br><br><br></div>';
}}else{
	echo ' <div><tr><td style="border:none;">teacher database not found</td> </tr><br><br><br><br><br><br></div>';
}
if($srno > 6){
echo '<table>
<form  method="post" enctype="multipart/form-data" action="">
<tr >
<td ><button name="previous">&#8249; Previous</button></td>
<td ><button name="first">&laquo; start</button></td>
<td ><button name="last">end &raquo;</button></td>
<td><button name="next">Next &#8250;</button></td>
</tr>
</form></table> ';
}
 ?> 
 </table> 
 <form  method="post" enctype="multipart/form-data" action="">
<tr>
	<td colspan=2><input type="submit" value="back" name="back"></td>
	</tr>
	</form>
  </section>
 
  <!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
				  <li><h4>how to find file which is not there on this  page</h4><li>
					 <ol style="text-align: left;">
					 <li>click on more file and it will direcited you to all file upload by teacher page for download<li>
					 </ol>
                     <li><h4>how to download file</h4><li>
					 <ol style="text-align: left;">
					 <li>just click on file name which you whant to download<li>
					 </ol>
                  </div>
               </aside>
            </div>
         </div>
      </div>
	  
	
  <?php
include ("footer.php");
?>  