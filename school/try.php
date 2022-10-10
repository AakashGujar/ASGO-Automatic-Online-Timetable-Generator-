

<?php 
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection to database
include('user_connection.php');
 
 /* create user class timetable table  */
        $sql_query1="CREATE TABLE tabel_1
        ( /* Column name    		          Column data type */
		  student_id       	    			 int   AUTO_INCREMENT,
		  student_name	         	 text,
		  PRIMARY KEY (`student_id`)
        );";
        $conn->query($sql_query1);/* execution of query */
		 $sql_query2="CREATE TABLE tabel_2
        ( /* Column name    		          Column data type */
		  srno       	    			 int   AUTO_INCREMENT,
		  student_id	         	 int,
		  subject_name	         	 text,
		  PRIMARY KEY (`srno`),
		FOREIGN KEY (student_id) REFERENCES  tabel_1(student_id)
        );";
        $conn->query($sql_query2);/* execution of query */
 
 $sql_query3="SELECT tabel_2.srno, tabel_2.student_id, tabel_2.subject_name, tabel_1.student_name  FROM tabel_2,tabel_1";
	$result3=$conn->query($sql_query3);/* execution of query */
    /* extractinng class_time_detail table in database */
    $data3 = $result3->fetch_array();
	echo "<br>".$data3['srno'];
	echo "<br>".$data3['student_id'];
	echo "<br>".$data3['student_name'];
	echo "<br>".$data3['subject_name'];
?>
<!--
<script>
Notification.requestPermission();

var data ={
	msg : "hello",
	wep : "ak 47"
}

var e=new Notification("Thanks For Subscribe",{
	body : "Now Click On me",
	icon : "https://www.w3schools.com/w3images/forestbridge.jpg",
	tag : "d"
});
e.onclick = function() {
	location.href="https://rewarded.ml/comingsoon.html";
	}
</script>
<style>
.td_1 {
  background: linear-gradient(to right, tomato 50%, white 51%);
}
.td_2 {
  background: linear-gradient(to right, white 50%, lightgray 51%);
}
</style>
<table>
  <tr>
    <td class="td_1">
      Two Color Background
    </td>
	<td class="td_2">
      Two Color Background
    </td>
	<td class="td_1 td_2">
      Two Color Background
    </td>
  </tr>
</table>
-->
<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection to database
include('user_connection.php');

//storing data into global variable
  $institute_start_hour			= 7;
  $institute_start_minute		= 00;
  $institute_start_amorpm		= "am";
  $institute_end_hour			= 12;
  $institute_end_minute			= 30;
  $institute_end_amorpm			= "pm";
  $lecture_gap_time				= 30;
  $recess_count					= 1;
  $first_recess_start_hour		= 9;
  $first_recess_start_minute	= 30;
  $first_recess_start_amorpm	= "pm";
  $first_recess_end_hour		= 10;
  $first_recess_end_minute		= 00;
  $first_recess_end_amorpm		= "pm";
  $second_recess_start_hour		= 1;
  $second_recess_start_minute	= 0;
  $second_recess_start_amorpm	= "pm";
  $second_recess_end_hour		= 1;
  $second_recess_end_minute		= 0;
  $second_recess_end_amorpm		= "pm";
  $daily_lecture_count			= 6;
  $holiday						= 1;
  $closed_day					= 3;
  $halfday						= 1;
  $opened_day					= 5;
  $halfday_lecture_count		= 3;
  $srno=1;

 //calculating total number of lecture
$five_days_lecture_count=$daily_lecture_count *5;
$six_days_lecture_count=$daily_lecture_count *6;
$fiveday_plus_halfday_lecture_count=$five_days_lecture_count + $halfday_lecture_count ;
$total_day_count=6;
 //allocating total number of lecture
 if(($holiday == 1)&($halfday == 1)){
	$total_lecture_count=$five_days_lecture_count;
	$total_day_count=5;
 }
 else if(($holiday == 0)&($halfday == 1)){
	$total_lecture_count=$fiveday_plus_halfday_lecture_count;
 }
 else if(($holiday == 0)&($halfday == 0)){
	$total_lecture_count=$six_days_lecture_count;
 }
 //echo $i="time_08_00_08_30";

//create a col for timmming
				//$sql_statement1=$conn->prepare(" ALTER TABLE  free_solt_detail  ADD $i text;");
 
               // $sql_statement1->execute();/* execution of query */
  //$sql_query14="ALTER TABLE free_solt_detail  ADD $i text";
 // $result14=$conn->query($sql_query14);/* execution of query */
                                 
	//		$i="col_timming";
 /* Extractin  freesolt information from free_solt_detail table in database */
 //                                  $sql_query14="SELECT  $i  FROM  het_sheth_timetable ";
//			                         $result14=$conn->query($sql_query14);/* execution of query */
                                    /* extractinng from free_solt_detail table in database */
//		                              $data14= $result14->fetch_array();
									  
 //echo  $data14['col_timming'];
 
 /*if($_POST['submit'])
 {
	 $k=$_POST['name'];
	 echo $k['0'];
	 echo $k['1'];
	 echo "hi";
	 
 }
 
 
	
$fullpath = 'jklm/file.ext/hhshsh';
$folder = substr($fullpath, 0, strpos($fullpath, '/'));
echo $folder;
// Output => folderName*/
?>
<!--<form method="POST" action="try.php">
<script type="text/javascript" src="javascript/jQuery 3.5.1.js"></script>
<input type="radio" name="name[]1" value="het 1" ></input>
<input type="radio" name="name[]1" value="nishi 2" ></input>
<input type="radio" name="name[]2" value="nishi 1" ></input>
<input type="radio" name="name[]2" value="het 2" ></input>
<input type="text" id="name" value="2" onkeyup="h();"></input>

<input type="submit" name="submit" ></input>
</form>-->
<a href="index.php"><input type="button" value="back"></input></a>
<button onClick="window.location.reload();">Refresh Page</button>

<script>
function h()
{
	var k=$('#name').val();
	<?php
	echo k;
	?>
}
</script>