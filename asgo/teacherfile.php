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
                <!-- CONTENT -->
               <section class="s-12 l-9">
 <?php
$database1=$adminusername."_teacherusers";

 $sql1="SELECT * FROM $database1 ";
$result1 = $conn->query($sql1);
if($result1 != "")
{
	$username=$_GET['username'];
	$usernames = str_replace('', '%20', $username);
 $sql2="SELECT * FROM $database1 WHERE name='$usernames'";
$result2 = $conn->query($sql2);
$check="1";
if ($result2->num_rows > 0) 
{
    // output data of each row
    while($row2 = $result2->fetch_array())
		{
			$srno 		    =	 $row2['srno'];
			$rows1		=	 $row2['srno'];
			$rows3		=	 $row2['firstname'];
			$rows4		=	 $row2['lastname'];
			$rows2		=	 $row2['name'];
			$rows5		=	 $row2['username'];
		}
}else{
	$check="";
}
if($check != ""){
	echo'<h4>Teacher name : '.$rows2.'</h4> 
	
<table style="width:100%;text-align:center;border-collapse:collapse;border: 1px solid  white;" border="1px">
<center>
  <tr>
    <th>Sr no</th>
	<th>files Name</th>
	</tr>
	';
	
	$database2=$adminusername."_".$rows3.$rows4."_filelist";
	$sql3="SELECT * FROM $database2 WHERE studentpermission='yes'";
$result3 = $conn->query($sql3);

if($result3 != ""){
	$rowcount=$result3->num_rows;
if ($rowcount > 0) 
{
    // output data of each row
    while($row2 = $result3->fetch_array())
		{
			$rows6[]		=	 $row2['filename'];		
		}
$srnos=$rowcount;
for($i=0; $i < $rowcount;){
$srnoss[$i]=$i+1;
$i++;
}
}

}

function counts($conn ,$database2){
	$x=0;
	$sql1="SELECT counts FROM $database2 WHERE srno=1";
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
	$sql4 = "ALTER TABLE $database2 ADD `counts` INT(11);";
$result4 = $conn->query($sql4);
$x=0;	
 updated($conn ,$database2,$x);
return $x;	
}

}
function updated($conn ,$database2,$x){
$sql5 = "UPDATE `$database2` SET `counts` = '$x' WHERE `srno` = 1";
$result5 = $conn->query($sql5);	
}
if(isset($_POST['next']))
{
	$x=counts($conn ,$database2);
	$y=$x+5;
	if($y < $srnos){

$x=$x+5;
updated($conn ,$database2,$x);
	}else{
		if($x > 0){
		$x=$srnos-5;
		}else{
			$x=0;
		}
		updated($conn ,$database2,$x);
	}
}
else if(isset($_POST['previous']))
{
	$x=counts($conn ,$database2);
	$x=$x-5;
	if($x >= 0)
		{
	updated($conn ,$database2,$x);
	}else{
		$x=0;
		updated($conn ,$database2,$x);
	}
}
else if(isset($_POST['last']))
{
	$x=counts($conn ,$database2);
$x=$srnos-5;
	if($x < -0){
		$x=0;
	}else{
		$x=$srnos-5;
	}
	updated($conn ,$database2,$x);
}
else if(isset($_POST['first']))
{
	$x=counts($conn ,$database2);
	$x=0;
	updated($conn ,$database2,$x);
}else{
	$x=0;
	updated($conn ,$database2,$x);
	}
$srno1 =$x+5;	
for($i=$x;$i < $srno1;)
{
	if($i < $srnos){
	$firsttime="<tr>
		   <td>".$srnoss[$i]."</td>
		<td><a href=download.php?link=".$rows6[$i].">".$rows6[$i]."</a></td></tr>";
	echo $firsttime;
	}else{
		$firsttime="<tr>
		   <td>------</td>
		<td>------</td>
		</tr>
		";
		echo $firsttime;
	}
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
if(isset($_POST['back']))
{
header('Location:filesearch.php');
}

if($srnos > 5){
echo '<form  method="post" enctype="multipart/form-data" action=""><table>
<tr >
<td ><button name="previous">&#8249; Previous</button></td>
<td ><button name="first">&laquo; start</button></td>
<td ><button name="last">end &raquo;</button></td>
<td><button name="next">Next &#8250;</button></td>
</tr></table></form>';
}

echo '<form  method="post" enctype="multipart/form-data" action="">
<tr>
	<td colspan=2><input type="submit" value="back" name="back"></td>
	</tr>
	</form>
	';
?>

</center>
</table>
</section>
<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
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
</div>