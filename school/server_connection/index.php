<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection to database
include('user_connection.php');

?>

<!DOCTYPE html PUBLIC>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type='text/css' rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="javascript/jQuery 3.5.1.js"></script>
<title>Homepage</title>
</head>
<body>

<h1>School Scheduler v 0.4(beta) </h1>

<!--<div class="" id="">
<label>Try File</label><br>
<form method="post" target="_self" action="try.php" >
	
	<button type="submit" name="try" id="try" >Try</button>

</form>
</div>

<div class="" id="">
<label>Log File</label><br>
<form method="post" target="_self" action="log.php" >
	
	<button type="submit" name="log" id="log" >Log</button>

</form>
</div>-->

<div class="" id="">
<label>Insert, Update and Remove Time Detail</label><br>
<form method="post" target="_self" action="time_detail.php" >
	
	<button type="submit" name="institute_time_detail" id="institute_time_detail" >Institute</button><br><br>
	
	<button type="submit" name="teacher_time_detail" id="teacher_time_detail" >Teacher</button><br><br>

	<button type="submit" name="class_time_detail" id="class_time_detail" >Class</button>
	
</form>
</div>

<div class="" id="">
<label>Insert, Update and Remove Information</label><br>
<form method="post" target="_self" action="insert_information.php" >

	<button type="submit" name="lecture_detail" id="lecture_detail" >Lecture</button><br><br>
	
	<button type="submit" name="lecture_place_detail" id="lecture_place_detail" >Lecture Place Name</button><br><br>
	
	<button type="submit" name="teacher_detail" id="teacher_detail" >Teacher</button><br><br>
	
	<button type="submit" name="student_detail" id="student_detail" disabled  >Student</button>

</form>
</div>

<div class="" id="">
<label>Detail For Schedule</label><br>
<form method="post" target="_self" action="class_lecture_detail.php" >
	
	<button type="submit" name="class_lecture_detail" id="class_lecture_detail" >Lectures For Class</button>
    
</form>
    
<form method="post" target="_self" action="time_detail.php" >	
	
    <button type="submit" name="class_time_detail" id="class_time_detail" >Class Time Detail</button>

</form>
</div>

<div class="" id="" >
<label>Schedule Generator From</label><br>

<form method="post" target="_self" action="class_lecture_detail.php" >

	<button type="submit" name="class_time_detail" id="new_detail" disabled >New Details</button><br><br>

</form>	
	
	<button type="submit" name="" id="old_detail" disabled >Old Details(Pre-Filled Information)</button>

</div>

</body>
</html>