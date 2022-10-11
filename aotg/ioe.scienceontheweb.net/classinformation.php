<!DOCTYPE html>
<?php
	include('session.php');
	include('userheader.php');
?>
<style>

	input[type=submit]
	{	
		display: inline-block;
		padding: 0.9% 1.5%;
		font-size: 100%;
		cursor: pointer;
		text-align: center;
		text-decoration: none;
		outline: none;
		border: none;
		border-radius: 15px;
		box-shadow: 0 4px #999;
		background-color:#152732;
		color:white;
		position:relative;
		margin:01% 28% 0% 1%;
	}

	input[type=submit]:hover
	{
		background-color: #2b4c6;
	}

	input[type=submit]:active
	{
		background-color: #2b4c61;
		box-shadow: 0 2px #666;
		transform: translateY(2px);
	}
	form
	{
		width:100%;
		margin:01% 0% 20.2% 0%;
	}
</style>
<?php
	echo "";
	$buttons='<input type=submit name="back" value="back" formaction="adminhome.php" ></input>';
	
	if(isset($_POST['previewtimetable']))
	{
		echo '<div class="line">
					<div class="box  margin-bottom">
						<div class="margin2x">
							<section>
								<div style="margin: 0% 04% 0% 01%;">
									<form method="POST" action="previewtimetable.php">
										<table>
											<tr>
												<td>class name</td>
												<td><input id="text" type="text" name="classname" placeholder="class name" value=""  autofocus ></td>
											</tr>
											<tr>
												<td>class div</td>
												<td><input id="text" type="text" name="classdiv" placeholder="class div" value="" ></td>
											</tr>
										</table>
										
										'.$buttons.'<input id="button" type="submit" name="previewtimetable" value="next">
									</form>
								</div>
							</section>
						</div>
					</div>
				</div>';
	}else if(isset($_POST['previewtimetableall']))
	{ 
		echo '<div class="line">
				<div class="box  margin-bottom">
					<div class="margin2x">
						<section>
		<div style="margin: 0% 04% 0% 01%;">
	<form method="POST" action="previewtimetable.php">
	<table>
	<tr>
	<td>class name</td>
	<td><input id="text" type="text" name="classname" placeholder="class name" value="" autofocus ></td>
	</tr>
	<tr>
	<td>class div</td>
	<td><input id="text" type="text" name="classdiv" placeholder="class div" value="" ></td>
	</tr>
	</table>
	'.$buttons.'<input id="button" type="submit" name="previewtimetableall" value="next">
	</form>
	</div>
	</section>
     </div>
         </div>
      </div>';
}else if(isset($_POST['printtimetable']))
{
	
	echo '
	<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section><div style="margin: 0% 04% 0% 01%;">
	<form method="POST" action="previewtimetable.php">
	<table>
	<tr>
	<td>class name</td>
	<td><input id="text" type="text" name="classname" placeholder="class name" value="" autofocus ></td>
	</tr>
	<tr>
	<td>class div</td>
	<td><input id="text" type="text" name="classdiv" placeholder="class div" value="" ></td>
	</tr>
	</table>
	'.$buttons.'<input id="button" type="submit" name="printtimetable" value="next">
	</form>
	</div>
	</section>
     </div>
         </div>
      </div>';
}else if(isset($_POST['oldtimetable']))
{
	
	echo '
	<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section><div style="margin: 0% 04% 0% 01%;">
	<form method="POST" action="timetablegenerater.php">
	<table >
	<tr>
	<td>class name</td>
	<td><input id="text" type="text" name="classname" placeholder="class name" value="" autofocus ></td>
	</tr>
	<tr>
	<td>class div</td>
	<td><input id="text" type="text" name="classdiv" placeholder="class div" value="" ></td>
	</tr>
	</table>
	'.$buttons.'<input id="button" type="submit" name="next" value="next" > 
	</form>
	</div>
	</section>
     </div>
         </div>
      </div>';
}else if(isset($_POST['newtimetable']))
{
	echo '
	<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section><div style="margin: 0% 04% 0% 01%;">
	<form method="POST" action="details.php">
	<table>
	<tr>
	<td>class name</td>
	<td><input id="text" type="text" name="classname" placeholder="class name" value="" autofocus ></td>
	</tr>
	<tr>
	<td>class div</td>
	<td><input id="text" type="text" name="classdiv" placeholder="class div" value="" ></td>
	</tr>
	</table>
	'.$buttons.'<input id="button" type="submit" name="newtimetable" value="next" >
	</form>
	</div>
	</section>
     </div>
         </div>
      </div>';
}else if(isset($_POST['updatedetails']))
{
	echo '
	<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section><div style="margin: 0% 04% 0% 01%;">
	<form method="POST" action="details.php">
	<table>
	<tr>
	<td>class name</td>
	<td><input id="text" type="text" name="classname" placeholder="class name" value="" autofocus ></td>
	</tr>
	<tr>
	<td>class div</td>
	<td><input id="text" type="text" name="classdiv" placeholder="class div" value="" ></td>
	</tr>
	</table>
	'.$buttons.'<input id="button" type="submit" name="updatedetails" value="next">
	</form>
	</div>
	</section>
     </div>
         </div>
      </div>';
}else if(isset($_POST['adddetails']))
{
	echo '
	<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section><div style="margin: 0% 04% 0% 01%;">
	<form method="POST" action="details.php">
	<table>
	<tr>
	<td>class name</td>
	<td><input id="text" type="text" name="classname" placeholder="class name" value="" autofocus ></td>
	</tr>
	<tr>
	<td>class div</td>
	<td><input id="text" type="text" name="classdiv" placeholder="class div" value="" ></td>
	</tr>
	</table>
	'.$buttons.'<input id="button" type="submit" name="adddetails" value="next">
	</form>
	</div>
	</section>
     </div>
         </div>
      </div>';
}else if(isset($_POST['updatesubject']))
{
	echo '
	<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section>
		<div style="margin: 0% 04% 0% 01%;">
	<form method="POST" action="subject.php">
	<table>
	<tr>
	<td>class name</td>
	<td><input id="text" type="text" name="classname" placeholder="class name" value="" autofocus ></td>
	</tr>
	<tr>
	<td>class div</td>
	<td><input id="text" type="text" name="classdiv" placeholder="class div" value="" ></td>
	</tr>
	</table>
	'.$buttons.'<input id="button" type="submit" name="updatesubject" value="next">
	</form>
	</div>
	</section>
	
     </div>
         </div>
      </div>';
}else if(isset($_POST['addsubject']))
{
	echo '
	<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section><div style="margin: 0% 04% 0% 01%;">
	<form method="POST" action="subject.php">
	<table>
	<tr>
	<td>class name</td>
	<td><input id="text" type="text" name="classname" placeholder="class name" value="" autofocus ></td>
	</tr>
	<tr>
	<td>class div</td>
	<td><input id="text" type="text" name="classdiv" placeholder="class div" value="" ></td>
	</tr>
	</table>
	'.$buttons.'<input id="button" type="submit" name="addsubject" value="next">
	</form>
	</div>
	
	</section>
     </div>
         </div>
      </div>';
}else{
	header('Location:adminhome.php');
}
?>

<?php
include ("footer.php");
?>