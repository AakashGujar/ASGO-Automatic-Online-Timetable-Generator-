<!DOCTYPE html>
<html>
	<?php
include('session.php');
include('userheader.php');

$_SESSION['classnames'] = $_POST['classname'];
  $_SESSION['classdivs'] = $_POST['classdiv'];
  $classname  = $_SESSION['classnames'];
$classdiv  = $_SESSION['classdivs'];
  $database=$login_session."_".$classname.$classdiv."details";
$query4="SELECT srno FROM $database";
$result4 = $conn->query($query4);
$database=$classname.$classdiv."details";
if(isset($_POST['newtimetable']))
{ if ($result4 == "") 
{
	$button='<td colspan="4"><input id="button" type="submit" name="newtimetable" value="next"></td>';
}	else
{
header('Location:adminhome.php');
$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="CLASS '.$classname.$classdiv.' TIME DETAIL IS PRESNT SO UPDATE TIME BY CLICKING ON  UPDATE TIME  BUTTON IN TIME DETAILS SECTION"; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);

}
}else if(isset($_POST['updatedetails']))
{
	if ($result4 != "") 
{
	$button='<td colspan="4" style="width:12%;"><input id="button" type="submit" name="updatedetails" value="update detail"></td>';
}	else
{
	header('Location:adminhome.php');
$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error=" CLASS '.$classname.$classdiv.' TIME DETAILS IS NOT PRESENT SO ADD TIME BY CLICKING ON ADD TIME BUTTON IN TIME DETAILS SECTION "; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);
}	
}else if(isset($_POST['adddetails']))
{
	if ($result4 == "") 
{
	
	$button='<td colspan="4"><input id="button" type="submit" name="adddetails" value="add detail"></td>';
}	else
{
header('Location:adminhome.php');
$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error="CLASS '.$classname.$classdiv.' TIME DETAIL IS PRESENT SO UPDATE TIME BY CLICKING ON  UPDATE TIME  BUTTON IN TIME DETAILS SECTION"; echo $error;?>';
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
<div id="Time Details">
     <fieldset style="width:100%">
        <legend>Timetable Details</legend> 
		<fieldset style="width:99.7%">
        <legend>School/College Time Details</legend>
           <form method="POST" action="adddetails.php"> 
		  <div style="color:red;"> please add time details as per 24 hours time setting</div>
				<table border="0"> 
					<tr> 
						<td>Starting time of school/college</td>
						<td> <input type="number" name="startstimehrs" placeholder="hours" autofocus ></td>
						<td> <input type="number" name="startstimemin" placeholder="minutes" ></td>
						<td> <select name="amorpms">
                                    <option value="Am" >Am</option>
                                    <option value="Pm">Pm</option>
                             </select></td>
					</tr> 
					<tr> 
						<td>ending time of school/college</td>
						<td> <input type="number" name="endstimehrs" placeholder="hours" ></td>
						<td> <input type="number" name="endstimemin" placeholder="minutes" ></td>
						<td> <select name="amorpms1">
                                    <option value="Am" >Am</option>
                                    <option value="Pm" >Pm</option>
                             </select></td>
					</tr> 
					<tr> 
						<td>how many recess will there on each day ?</td>
						<td><input type="radio" id="1" name="one" value="1" checked> 1</td> 
                        <td><input type="radio" id="2" name="one" value="0"> 2</td> 
						<td> </td>						
					</tr> 
					<tr> 
						<td>recess start time of school/college</td>
						<td> <input type="number" name="recessstartstimehrs1" placeholder="hours" ></td>
						<td> <input type="number" name="recessstartsmins1" placeholder="minutes" ></td>
						<td> <select name="amorpms2">
                                    <option value="Am" >Am</option>
                                    <option value="Pm" >Pm</option>
                             </select></td>
					</tr> 
					<tr> 
						<td>recess end time of school/college </td>
						<td> <input type="number" name="recessendstimehrs1" placeholder="hours"></td>
						<td> <input type="number" name="recessendsmins1" placeholder="minutes"></td>
						<td> <select name="amorpms3">
                                    <option value="Am" >Am</option>
                                    <option value="Pm">Pm</option>
                             </select></td>
					</tr> 
					<tr class="hides recess2"> 
						<td>recess2 start time of school/college</td>
						<td> <input type="number" name="recessstartstimehrs2" placeholder="hours" ></td>
						<td> <input type="number" name="recessstartsmins2" placeholder="minutes" ></td>
						<td> <select name="amorpms4">
                                    <option value="Am" >Am</option>
                                    <option value="Pm" >Pm</option>
                             </select></td>
					</tr> 
					<tr class="hides recess2"> 
						<td>recess2 end time of school/college </td>
						<td> <input type="number" name="recessendstimehrs2" placeholder="hours" ></td>
						<td> <input type="number" name="recessendsmins2" placeholder="minutes" ></td>
						<td> <select name="amorpms5">
                                    <option value="Am">Am</option>
                                    <option value="Pm">Pm</option>
                             </select></td>
					</tr> 
					<tr> 
						<td>how many period will there on per day ?</td>
						<td colspan="1"> <input type="number" name="dailysperiod" min="1" max="10" ></td>
						<td> </td>
						<td> </td>
					</tr> 
					<tr> 
						<td>Whether Saturday School/College will remain close ?</td>
						<td><input type="radio" id="3" name="two" value="1" checked> Yes</td> 
                        <td><input type="radio" id="4" name="two" value="0"> No</td> 
						<td> </td>
					</tr> 
					<tr class="hides halfday"> 
						<td>Whether Saturday School/College  having halfday?</td>
						<td><input type="radio" id="5" name="three" value="1" checked> Yes</td> 
                        <td><input type="radio" id="6" name="three" value="0" > No</td> 
						<td> </td>
					</tr> 
					<tr class="hides period">  
						<td>how many period will there on Saturday?</td>
						<td colspan="1"> <input type="number" name="periods" min="1" max="10" ></td>
						<td> </td>
						<td> </td>
				</table> 
				<?php
					echo $button;
					?>
			</form> 
		</fieldset>
		</fieldset>
 </div>
 
 </section>
		<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
                     <ol>
					 <li>1.please add time details as per 24 hours for example 1pm = 13pm , 2pm = 14pm and so on</li>
					 <li>2.please enter lecture and time details properply</li>
					 <li>3.please count lecture as per hour excluded recess hour for example total lecture hour=2 hours then time will be 7:00am to 10:30(this time include recess of half hour) </li>
					 <li>4.please enter time of timetable with recess time</li>
					 <ol>
                  </div>
               </aside>
            </div>
         </div>
      </div>
	  <?php
include ("footer.php");
?>
<script type="text/javascript">

							  $(document).ready(function(){
    $('#1').click(function(){ 
         $('.recess2').addClass('hides');
    });
    $('#2').click(function(){
         $('.recess2').removeClass('hides');
    });
    $('#3').click(function(){
        $('.halfday').addClass('hides');
        $('.period').addClass('hides');
    });
    $('#4').click(function(){
        $('.halfday').removeClass('hides');
       $('.period').removeClass('hides');		
    });
    $('#5').click(function(){
        $('.period').removeClass('hides');       
    });
    $('#6').click(function(){
        $('.period').addClass('hides');       
    });
	$('#7').click(function(){
        $('.prticals').removeClass('hides');       
    });
	$('#8').click(function(){
        $('.prticals').addClass('hides');       
    });
});

</script>
</html>