<!DOCTYPE html>
<html>
<?php
include('session.php');
include('userheader.php');
include('connection.php');
$newtimetable=$_SESSION['newtimetable'];
if($newtimetable != "newtimetable")
{
$_SESSION['classnames'] = $_POST['classname'];
$_SESSION['classdivs'] = $_POST['classdiv'];
}
$classname  = $_SESSION['classnames'];
$classdiv  = $_SESSION['classdivs'];

$database1=$login_session."_".$classname.$classdiv."subject";
$query4="SELECT srno FROM $database1";
$result4 = $conn->query($query4);
if($newtimetable == "newtimetable")
{
	if($result4 == ""){
	$button='<td ><input id="button" type="submit" name="newtimetable" value="next"></td>';
	
}else{
	header('Location:adminhome.php');
	$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="CLASS '.$classname.$classdiv.' SUBJECTS DATA IS PRESENT SO UPDATE SUBJECT BY CLICKING ON  UPDATE SUBJECT BUTTON IN SUBJECT SECTION"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);

}
	
}else if(isset($_POST['updatesubject'])){

	if($result4 != ""){
	$button='<td ><input id="button" type="submit" name="updatesubject" value="Update Subject"></td>';	

}else{
	header('Location:adminhome.php');
	$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="SUBJECTS ARE NOT THERE SO ADD SUBJECT OF CLASS '.$classname.$classdiv.' BY CLICKING IN ADD SUBJECT IN SUBJECT SECTION "; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);

}	
	
}else if(isset($_POST['addsubject'])){
 if($result4 == ""){
	$button='<td ><input id="button" type="submit" name="addsubject" value="Add Subject"></td>';

}else{
	header('Location:adminhome.php');
	$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="CLASS '.$classname.$classdiv.' ALREADY THIER SO USE UPDATE SUBJECT BUTTON IN SUBJECT SECTION"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);

}	
}else{
	header('Location:adminhome.php');
	 $myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="TRY AGAIN AND MAKE SURE TO FILL DATA IN FIELD"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
}
?>
<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">            
		<section class="s-12 l-8">
<div id="Period Details">
     <fieldset >
        <legend>Timetable Details</legend> 
		<fieldset style="width:99.9%">
        <legend>School/College Period Details</legend>
           <form method="POST" action="addsubject.php"> 
				<table border="0"> 
					<tr> 
						<td>Subject information No 1</td>
						<td></td><td rowspan=6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					</tr> 
					<tr> 
						<td>id</td>
						<td ><input type=text name=id1 value="1" style="border:none;cursor:none;background-color:#F0F0F0;"></input> </td>
					</tr> 
					<tr> 
						<td>Name Of New subject</td>
						<td> <select id="subject1" name="subject1"><?php 
						$database2=$login_session."_subjects";
						$sql1="SELECT * FROM $database2 ";
                        $result1 = $conn->query($sql1);
						if($result1 != "")
						{
							if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$subjectnames[]     =	 $row1['subjectname'];
			$srno     =	 $row1['srno'];
		}
}
for($i=0;$i<$srno;)
{
echo '<option value="'.$subjectnames[$i].'" >'.$subjectnames[$i].'</option>';
$i++;
}
						}
						
						?>
						</select></td>
					</tr>
					<tr> 
						<td>Select Subject is Theory OR Partical</td>
						<td><select id="subjecttype1" name="subjecttype1" >
                                    <option value="TH" >Theory(TH)</option>
                                    <option value="PR">Partical(PR)</option>
                            </select>
						</td>
					</tr>
					<tr> 
						<td>Teacher Name For New subject</td>
						<td> <select id="subjectteacher1" name="subjectteacher1"><?php 
						$database1=$login_session."_teacherusers";
						$sql1="SELECT * FROM $database1 ";
                        $result1 = $conn->query($sql1);
						if($result1 != "")
						{
							if ($result1->num_rows > 0) 
{
    // output data of each row
    while($row1 = $result1->fetch_array())
		{
			$usernames[]     =	 $row1['name'];
			$srno     =	 $row1['srno'];
		}
}
for($i=0;$i<$srno;)
{
echo '<option value="'.$usernames[$i].'" >'.$usernames[$i].'</option>';
$i++;
}
						}
						
						?>
						</select></td>
					</tr>
					<tr> 	
						<td>total slots Number of subject in week</td>
						<td><select id=piority1 name=piority1 >
                                    <option value="1" >1</option>
                                    <option value="2">2</option>
									<option value="3" >3</option>
                                    <option value="4">4</option>
									<option value="5" >5</option>
                                    <option value="6">6</option>
                            </select>
						</td>
					</tr> 
				</table> 
				<table> 
					<tr id="container">

					</tr>			 
				</table> 
				<div id=submitbutton class=hides> 
                       <?php
					echo $button;
					?>
					</div>	
			</form>
<button id="add" type=submit style="width:40%;float:right;">Add new Subject information</button>
	
<button style="width:50%;float:left;" class="totallecture" id="totallecture" name="totallecture" value=<?php

$database=$login_session."_".$classname.$classdiv."details";

 $sql2="SELECT saturday,dailyperiod,saturdayperiod,halfday FROM $database";
 $result2 = $conn->query($sql2);
 if ($result2 != ""){
if ($result2->num_rows > 0) 
{
    // output data of each row
    while($row2 = $result2->fetch_array())
		{
			$dailyperiod		= 	$row2['dailyperiod']; 
			$saturday			= 	$row2['saturday']; 
			$saturdayperiod 	= 	$row2['saturdayperiod']; 
			$halfday 			= 	$row2['halfday'];	
		}
}	

$fivedaysperiod=$dailyperiod *5;
$dailydaysperiod=$dailyperiod *6;
$halfdayanddailyperiod=$fivedaysperiod + $saturdayperiod ;
if(($saturday == 1)&($halfday == 1)){
	$totallecture=$fivedaysperiod;
}
else if(($saturday == 0)&($halfday == 1)){
	$totallecture=$halfdayanddailyperiod;
}
else if(($saturday == 0)&($halfday == 0)){
	$totallecture=$dailydaysperiod;
}
if($totallecture == 0)
{
	header('Location:adminhome.php');
	$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="please add time details of  class '.$classname.$classdiv.' then try again to add subject of '.$classname.$classdiv.'"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
}
$query1 = "UPDATE $database SET totallecture=$totallecture WHERE srno=1";

$result1 = $conn->query($query1);

 echo $totallecture;?>><?php  echo "TOTAL SLOTS ALLOCATED IN WEEK IS <b style='color:blue'>".$totallecture."</b> OUT OF WHICH <DIV style='color:blue'  id='totalpiority' class=totallecture><b>0</b></DIV> SLOTS USED";}else{
	 header('Location:adminhome.php');
$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="PLEASE ADD TIME DETAILS OF  CLASS '.$classname.$classdiv.' THEN TRY AGAIN TO ADD SUBJECT OF '.$classname.$classdiv.'"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);

 }?> </button>			
<div>	
<p id="hidden"></p>	
	<div id=error1 style="margin-top:10%;color:blue;" class="errordiv"> *YOUR TOTAL PIORITY IS MORE THAN TOTAL PIORITY LIMITED & YOU CAN'NT PROCEED TO SUBMIT</div>
<div id=error2 style="margin-top:10%;color:blue;" class="errordiv">*YOUR TOTAL PIORITY IS LESS THAN TOTAL PIORITY LIMITED & YOU CAN'NT PROCEED TO SUBMIT</div>
<div id=error3 style="margin-top:10%;color:blue;" class="errordiv">*YOUR TOTAL PIORITY IS EXACTED TO YOUR TOTAL PIORITY LIMITED & YOU CAN PROCEED TO SUBMIT</div> 			

		
</div> 

 

		</fieldset>
		</fieldset>

 </div>
<script type="text/javascript">
$a=1;
$b=2;
$c=2;
$e=0;
$f=0;
  $(function() {
      $("#add").click(function() {
		  $g=$f++;
		  $ans=document.getElementById("subject"+$g+"").value;
		  if($ans != "")
		  {
		  $n=$a++;
		  $d=0;
		  $ans=0;
		  $idno=$c++;
		  $check=$e++;
		  for($i=0;$i<$n;$i++)
		  {
			$d++;
			 $no = document.getElementById("piority"+$d+"").value;
			 $ans =  Number($ans)+ Number($no);
			 document.getElementById("totalpiority").innerHTML = $ans;
		  if($check == $i){
		$piority =document.getElementById("totallecture").value;
		  if($ans > $piority){
 $('error1').removeClass('errordiv');
        $('error2').addClass('errordiv');
		 $('error3').addClass('errordiv');	
   $('#submitbutton').addClass('hides');		 
          div = document.createElement('div');
          $(div).addClass("errordiv").html("<select id=piority"+$idno+" name=piority"+$id+" class=errordiv></select>");
          $("#hidden").append(div);
		   $f=$g--;
		  } 
		  else if($ans < $piority){
			   $('#error2').removeClass('errordiv');
        $('#error1').addClass('errordiv');
		 $('#error3').addClass('errordiv');
		 $('#submitbutton').addClass('hides');
			  $id=$b++;
          div = document.createElement('tr');
          $(div).addClass("").html("<tr><td>Subject information No "+$id+"</td></tr><tr><td>id</td><td><input type=text name=id"+$id+" value="+$id+" style='border:none;cursor:none;background-color:#F0F0F0;'></input></td></tr><tr><td>Name of New subject</td><td> <select id=subject"+$id+" name=subject"+$id+"><?php $database2=$login_session."_subjects";$sql1="SELECT * FROM $database2 ";$result1 = $conn->query($sql1);if($result1 != ""){if ($result1->num_rows > 0) { /* output data of each row*/while($row1 = $result1->fetch_array()){$subjectnames[]     =	 $row1['subjectname'];$srno     =	 $row1['srno'];}}for($i=0;$i<$srno;){echo '<option value='.$subjectnames[$i].' >'.$subjectnames[$i].'</option>';$i++;}}?></select></td></tr><tr> <td>Select Subject is Theory OR Partical</td><td><select id=subjecttype"+$idno+" name=subjecttype"+$idno+" ><option value=TH >Theory(TH)</option><option value=PR>Partical(PR)</option></select></td></tr><tr> <td>Teacher Name For New subject</td><td> <select id=subjectteacher"+$idno+" name=subjectteacher"+$idno+"><?php $database1=$login_session."_teacherusers";$sql1="SELECT * FROM $database1 "; $result1 = $conn->query($sql1);if($result1 != ""){if ($result1->num_rows > 0) {/* output data of each row*/ while($row1 = $result1->fetch_array()){$usernames[]     =	 $row1['name'];$srno     =	 $row1['srno'];}}for($i=0;$i<$srno;){echo '<option value='.$usernames[$i].' >'.$usernames[$i].'</option>';$i++;}}?></select></td></tr><tr><td>total slots Number of subject in week</td><td><select id=piority"+$idno+" name=piority"+$id+"><option value=1>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option><option value=5>5</option><option value=6>6</option></select></td></tr>");
          $("#container").append(div);
		   bottomFunction();
									} 
									else if($ans == $piority){
										$('#error3').removeClass('errordiv');
        $('#error1').addClass('errordiv');
		 $('#error2').addClass('errordiv');
	   $('#submitbutton').removeClass('hides');
																 div = document.createElement('div');
          $(div).addClass("errordiv").html("<select id=piority"+$idno+" name=piority"+$id+" class=errordiv></select>");
          $("#hidden").append(div);
		   div = document.createElement('div');
          $(div).addClass("errordiv").html("<input type=hidden id=loopvalue name=loopvalue class=hides value="+$id+"></input>");
          $("#container").append(div);
		   $f=$g--;
																}
		  }
		  }
		  }else{
			  $f=$g--;
		  }
        });
    });
	$scroll=0;
	function bottomFunction() {
		$scroll=$scroll+300;
    document.body.scrollTop = $scroll;
    document.documentElement.scrollTop = $scroll;
}
</script>
</section>
		<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
                    <ol>
					 <li>1.please enter new subject button utill next buton not occour</li>
					 <li>2.if next button is not occour and new field is not add then check your total pririty count of subject</li>
					 <ol> 
                  </div>
               </aside>
            </div>
         </div>
      </div>
	  <?php
include ("footer.php");
?>
</html>