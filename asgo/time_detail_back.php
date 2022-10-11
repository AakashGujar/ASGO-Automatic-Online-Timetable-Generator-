<?php
include('session.php');
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection to database
include('connection.php');

//inilized variable
$student_count    = "";
$batch_count      = "";
$teacher_name     = "";
$class_name     = "";

if(isset($_POST['post_institute_strat_hour'])){
	//storing data into global variable
  $institute_start_hour			= htmlspecialchars($_POST['post_institute_strat_hour']);
  $institute_start_minute		= htmlspecialchars($_POST['post_institute_strat_minute']);
  $institute_end_hour			= htmlspecialchars($_POST['post_institute_end_hour']);
  $institute_end_minute			= htmlspecialchars($_POST['post_institute_end_minute']);
  $recess_count					= htmlspecialchars($_POST['post_recess_count']);
  $first_recess_start_hour		= htmlspecialchars($_POST['post_first_recess_strat_hour']);
  $first_recess_start_minute	= htmlspecialchars($_POST['post_first_recess_strat_minute']);
  $first_recess_end_hour		= htmlspecialchars($_POST['post_first_recess_end_hour']);
  $first_recess_end_minute		= htmlspecialchars($_POST['post_first_recess_end_minute']);
  $second_recess_start_hour		= htmlspecialchars($_POST['post_second_recess_strat_hour']);
  $second_recess_start_minute	= htmlspecialchars($_POST['post_second_recess_strat_minute']);
  $second_recess_end_hour		= htmlspecialchars($_POST['post_second_recess_end_hour']);
  $second_recess_end_minute		= htmlspecialchars($_POST['post_first_recess_end_minute']);
  $lecture_gap_time				= htmlspecialchars($_POST['post_lecture_gap_time']);
  
   } 

//lecturecount funtion
if(isset($_POST['post_lecture_count']))
{
	//inlizing varable for function
	$time_table_name="";
	$holiday="";
	$closed_day="";
	$halfday="";
	$opened_day="";
	$halfday_lecture_count="";
	$total_lecture_count="";
	
	 insert_timming_data(
	$conn,
	$teacher_name,
	$class_name,
	$time_table_name,
	$institute_start_hour,
	$institute_start_minute,
	$institute_end_hour,
	$institute_end_minute,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
    );
}

if(isset($_POST['post_institute_start_amorpm'])){
//storing data into global variable
  $institute_start_amorpm		= htmlspecialchars($_POST['post_institute_start_amorpm']);
  $institute_end_amorpm			= htmlspecialchars($_POST['post_institute_end_amorpm']);
  $first_recess_start_amorpm	= htmlspecialchars($_POST['post_first_recess_start_amorpms']);
  $first_recess_end_amorpm		= htmlspecialchars($_POST['post_first_recess_end_amorpms']);
  $second_recess_start_amorpm	= htmlspecialchars($_POST['post_second_recess_start_amorpms']);
  $second_recess_end_amorpm		= htmlspecialchars($_POST['post_second_recess_end_amorpms']);
  $daily_lecture_count			= htmlspecialchars($_POST['post_daily_lecture_count']);
  $holiday						= htmlspecialchars($_POST['post_holiday']);
  $closed_day					= htmlspecialchars($_POST['post_closed_day']);
  $halfday						= htmlspecialchars($_POST['post_halfday']);
  $opened_day					= htmlspecialchars($_POST['post_opened_day']);
  $halfday_lecture_count		= htmlspecialchars($_POST['post_halfday_lecture_count']);
  $srno=1;

 //calculating total number of lecture
 $five_days_lecture_count            =  (int)$daily_lecture_count * 5;
 $six_days_lecture_count             =  (int)$daily_lecture_count * 6;
 $fiveday_plus_halfday_lecture_count =  (int)$five_days_lecture_count +  (int)$halfday_lecture_count ;
 
 //allocating total number of lecture
 if(($holiday == 1)&($halfday == 1)){
	$total_lecture_count = $five_days_lecture_count;
 }
 else if(($holiday == 0)&($halfday == 1)){
	$total_lecture_count = $fiveday_plus_halfday_lecture_count;
 }
 else if(($holiday == 0)&($halfday == 0)){
	$total_lecture_count = $six_days_lecture_count;
 }
}

//inserting data in table  
function insert_data(
	$conn,
	$table_name,
	$srno,
	$institute_start_hour,
	$institute_start_minute,
	$institute_start_amorpm,
	$institute_end_hour,
	$institute_end_minute,
	$institute_end_amorpm,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_start_amorpm,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$first_recess_end_amorpm,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_start_amorpm,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$second_recess_end_amorpm,
	$student_count,
	$batch_count,
	$daily_lecture_count,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
)
{

  /* inserting data in user institute_time_detail  ,teacher_time_detail and class_time_detail table */
  $sql_statement1=$conn->prepare("
  INSERT INTO ".$table_name."
 (
	srno,
	col_institute_start_hour,
	col_institute_start_minute,
	col_institute_start_amorpm,
	col_institute_end_hour,
	col_institute_end_minute,
	col_institute_end_amorpm,
	col_recess_count,
	col_first_recess_start_hour,
	col_first_recess_start_minute,
	col_first_recess_start_amorpm,
	col_first_recess_end_hour,
	col_first_recess_end_minute,
	col_first_recess_end_amorpm,
	col_second_recess_start_hour,
	col_second_recess_start_minute,
	col_second_recess_start_amorpm,
	col_second_recess_end_hour,
	col_second_recess_end_minute,
	col_second_recess_end_amorpm,
	col_daily_lecture_count,
	col_holiday,
	col_closed_day,
	col_halfday,
	col_opened_day,
	col_halfday_lecture_count,
	col_total_lecture_count
 )VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
  
  $sql_statement1->bind_param("iiisiisiiisiisiisiisiiiiiii",
    $srno,
	$institute_start_hour,
	$institute_start_minute,
	$institute_start_amorpm,
	$institute_end_hour,
	$institute_end_minute,
	$institute_end_amorpm,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_start_amorpm,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$first_recess_end_amorpm,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_start_amorpm,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$second_recess_end_amorpm,
	$daily_lecture_count,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
  );
  $sql_statement1->execute();/* execution of query */
  
  if($lecture_gap_time!= "")
  {
  /* update data in user class_time_detail table for addional data */
  $sql_statement2=$conn->prepare("
  UPDATE ".$table_name." SET
	col_lecture_gap_time =	?
	WHERE srno           =  ?
 ");
  
  $sql_statement2->bind_param("ii",
	$lecture_gap_time,
	$srno
  );
  $sql_statement2->execute();/* execution of query */
 }
  
  if($student_count!= "")
  {
  /* update data in user class_time_detail table for addional data */
  $sql_statement2=$conn->prepare("
  UPDATE ".$table_name." SET
	col_student_count	=	?,
	col_batch_count		=	?
	WHERE srno          =   ?
 ");
  
  $sql_statement2->bind_param("iii",
	$student_count,
	$batch_count,
	$srno
  );
  $sql_statement2->execute();/* execution of query */
 }
 
}

//updateing data in table  
function update_data(
	$conn,
	$table_name,
	$srno,
	$institute_start_hour,
	$institute_start_minute,
	$institute_start_amorpm,
	$institute_end_hour,
	$institute_end_minute,
	$institute_end_amorpm,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_start_amorpm,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$first_recess_end_amorpm,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_start_amorpm,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$second_recess_end_amorpm,
	$student_count,
	$batch_count,
	$daily_lecture_count,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
)
{
	/* update data in user institute_time_detail  ,teacher_time_detail and class_time_detail table */
  $sql_statement3=$conn->prepare("
  UPDATE ".$table_name." SET
	col_institute_start_hour			=	?,
	col_institute_start_minute			=	?,
	col_institute_start_amorpm			=	?,
	col_institute_end_hour				=	?,
	col_institute_end_minute			=	?,
	col_institute_end_amorpm			=	?,
	col_recess_count					=	?,
	col_first_recess_start_hour			=	?,
	col_first_recess_start_minute		=	?,
	col_first_recess_start_amorpm		=	?,
	col_first_recess_end_hour			=	?,
	col_first_recess_end_minute			=	?,
	col_first_recess_end_amorpm			=	?,
	col_second_recess_start_hour		=	?,
	col_second_recess_start_minute		=	?,
	col_second_recess_start_amorpm		=	?,
	col_second_recess_end_hour			=	?,
	col_second_recess_end_minute		=	?,
	col_second_recess_end_amorpm		=	?,
	col_daily_lecture_count				=	?,
	col_holiday							=	?,
	col_closed_day						=	?,
	col_halfday							=	?,
	col_opened_day						=	?,
	col_halfday_lecture_count			=	?,
	col_total_lecture_count				=	?
	WHERE srno                          =   ?
 ");
  
  $sql_statement3->bind_param("iisiisiiisiisiisiisiiiiiiii",
	$institute_start_hour,
	$institute_start_minute,
	$institute_start_amorpm,
	$institute_end_hour,
	$institute_end_minute,
	$institute_end_amorpm,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_start_amorpm,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$first_recess_end_amorpm,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_start_amorpm,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$second_recess_end_amorpm,
	$daily_lecture_count,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count,
	$srno
  );
  $sql_statement3->execute();/* execution of query */
  
  if($lecture_gap_time!= "")
  {
  /* update data in user class_time_detail table for addional data */
  $sql_statement2=$conn->prepare("
  UPDATE ".$table_name." SET
	col_lecture_gap_time =	?
	WHERE srno           =  ?
 ");
  
  $sql_statement2->bind_param("ii",
	$lecture_gap_time,
	$srno
  );
  $sql_statement2->execute();/* execution of query */
 }
 
  if($student_count!= "")
  {
   /* update data in user class_time_detail table for additonal data */
  $sql_statement4=$conn->prepare("
  UPDATE ".$table_name." SET
	col_student_count	=	?,
	col_batch_count		=	?
	WHERE srno          =   ?
 ");
  
  $sql_statement4->bind_param("iii",
	$student_count,
	$batch_count,
	$srno
  );
  $sql_statement4->execute();/* execution of query */
 }
}

//inserting time data in table  
function insert_timming_data(
	$conn,
	$teacher_name,
	$class_name,
	$time_table_name,
	$institute_start_hour,
	$institute_start_minute,
	$institute_end_hour,
	$institute_end_minute,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
)
{
    include('session.php');
    $table_name_1=$login_session."_free_solt_detail";
	if($time_table_name != ""){
	/* Finding teacher/class timetable table in database */
	$sql_query2="SELECT * FROM ".$time_table_name." "; 
	$result2=$conn->query($sql_query2);/* execution of query */
	if($result2->num_rows > 0)
	{
        /* Finding teacher/class timetable table in database */
	    $sql_query2="SELECT col_teacher_name,col_lecture_place,col_class_name FROM ".$time_table_name." "; 
	    $result2=$conn->query($sql_query2);/* execution of query */
        
        while($data2 = $result2->fetch_array())
        {
            if(isset($data2['col_teacher_name']))
            {
                 //updating odd placde teacher timetable
                $sql_query11="UPDATE ".$data2['col_teacher_name']."_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_class_name='".$data2['col_class_name']."'";
                $conn->query($sql_query11);/* execution of query */
            }
            if(isset($data2['col_lecture_place']))
            {
                //updating odd placde teacher timetable
                $sql_query11="UPDATE ".$data2['col_lecture_place']."_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_class_name='".$data2['col_class_name']."'";
                $conn->query($sql_query11);/* execution of query */
            }
        }
        $sql_query2="TRUNCATE ".$time_table_name." "; 
        $result2=$conn->query($sql_query2);/* execution of query */
    }
	 if($teacher_name != "")
	 {
		 $col_name="col_teacher_name";
		 $col_value=$teacher_name;
	 }
	
	if($class_name != "")
	{
		 $col_name="col_class_name";
		 $col_value=$class_name;
        $sql_query2="TRUNCATE ".$class_name."_subject_detail"; 
        $result2=$conn->query($sql_query2);/* execution of query */
	}
	  /* Finding teacher free solt table in database */
	$sql_query2="SELECT * FROM ".$table_name_1." WHERE $col_name='".$col_value."'"; 
	$result2=$conn->query($sql_query2);/* execution of query */
	if($result2->num_rows > 0)
	{
        $sql_query2="DELETE FROM ".$table_name_1." WHERE $col_name='".$col_value."'"; 
        $result2=$conn->query($sql_query2);/* execution of query */
    }
	
	$sql_statement1=$conn->prepare(" INSERT INTO ".$table_name_1." ( $col_name )VALUES(?)");
    $sql_statement1->bind_param("s",$col_value);
    $sql_statement1->execute();/* execution of query */ 
	}
   
   //timmming setting
    $institute_start_hour		= $institute_start_hour.".0";
    $institute_start_minute	    = "0.".$institute_start_minute;
    $institute_end_hour		    = $institute_end_hour.".0";
    $institute_end_minute		= "0.".$institute_end_minute;
    $first_recess_start_hour 	= $first_recess_start_hour.".0";
    $first_recess_start_minute  = "0.".$first_recess_start_minute;
    $first_recess_end_hour		= $first_recess_end_hour.".0";
    $first_recess_end_minute	= "0.".$first_recess_end_minute;
    $lecture_gap_time			= "0.".$lecture_gap_time;
	if($holiday != 0)
	{
		$closed_day         		= $closed_day;
	}
	else
	{
		$closed_day         		= 6;
	}
    $lecture_time_count=1;
    $before_recess2_lecture_count=0;
	$institute_time_recored=array();
    //time=hour:min
    $institute_start_time	 = $institute_start_hour 	+ $institute_start_minute;
    $institute_end_time		 = $institute_end_hour	 	+ $institute_end_minute;
    $first_recess_start_time = $first_recess_start_hour + $first_recess_start_minute;
    $first_recess_end_time	 = $first_recess_end_hour	+ $first_recess_end_minute;

    //before recess
	$minute=$institute_start_minute;
	for($i=$institute_start_time;$i <= $first_recess_start_time;)
	{
		$institute_time_recored[]=number_format((float)$i, 2);
        
		$lecture_time_count=$lecture_time_count+1;
        
		$minute=$minute+$lecture_gap_time;
		
		if($minute >= "0.60" )
		{
			$minus="0.60";
			$minute=$minute - $minus;
			$i=floor($i)+1.0;
			
		}
		$i=floor($i)+$minute;  
	}
	
    if($recess_count == 1)
    {
		//second recare time set to 0 when only one recess is there
		$second_recess_start_time=0;
        //after recess
	   $minute=$first_recess_end_minute;
	   for($i=$first_recess_end_time;$i <= $institute_end_time;)
	   {
		  $institute_time_recored[]=number_format((float)$i, 2);
		  
         // $lecture_time_count=$lecture_time_count+1; 
           
          $minute=$minute+$lecture_gap_time;
          if($minute >= "0.60" )
		  {
			$minus="0.60";
			$minute=$minute - $minus;
			$i=floor($i)+1.0;
          }
		$i=floor($i)+$minute;  
	   }
	   
    }
    else
    {
	   $second_recess_start_hour 	= $second_recess_start_hour.".0";
       $second_recess_start_minute  = "0.".$second_recess_start_minute;
	   $second_recess_end_hour		= $second_recess_end_hour.".0";
       $second_recess_end_minute	= "0.".$second_recess_end_minute;
	
        //time=hour:min
	   $second_recess_start_time	 = $second_recess_start_hour 	+ $second_recess_start_minute;
       $second_recess_end_time		 = $second_recess_end_hour	 	+ $second_recess_end_minute;
	
	   //after recess and before 2 recess
	   $minute=$first_recess_end_minute;
	   for($i=$first_recess_end_time;$i <= $second_recess_start_time;)
	   {
		  $institute_time_recored[]=number_format((float)$i, 2);
		  
          $lecture_time_count=$lecture_time_count+1; 
		
		  $minute=$minute+$lecture_gap_time;
		  if($minute >= "0.60" )
		  {
			$minus="0.60";
			$minute=$minute - $minus;
			$i=floor($i)+1.0;
          }
		$i=floor($i)+$minute;  
	   }
	
	   //after 2 recess 
	   $minute=$second_recess_end_minute;
	   for($i=$second_recess_end_time;$i <= $institute_end_time;)
	   {
		  $institute_time_recored[]=number_format((float)$i, 2);
		  
          $lecture_time_count=$lecture_time_count+1; 
		
		  $minute=$minute+$lecture_gap_time;
		  if($minute >= "0.60" )
		  {
			$minus="0.60";
			$minute=$minute - $minus;
			$i=floor($i)+1.0;
          }
		$i=floor($i)+$minute;  
	   }
    }
	
	 if($recess_count == 1)
	 {
		 $total_lecture_array_count=count($institute_time_recored) - 2;
	 }
	 else
	 {
		 $total_lecture_array_count=count($institute_time_recored) - 3;
	 }
	 
	echo  ' <input type="number" name="post_daily_lecture_count" id="post_daily_lecture" placeholder="Daily Lecture Count" min="1" max="10" value="'.$total_lecture_array_count.'" readonly >';
	
    if($time_table_name != ""){
    $day_wise_recess_id=0;
	$set=0;
    for($j=0;$j<6;$j++)
    {
	   if($j != $closed_day)
	   {
		  $first_lecture_count[$j]=2;
		  $day_wise_id=0;
		  $day_wise_id_count=0;
		  $total_lecture_array_count=count($institute_time_recored) - 1;
		  $lecture_area="before_recess_lecture";
		 
		 //checking halfday lecture
		 if($halfday == 1 && $j == $opened_day && $holiday == 0)
		 {
			 $total_lecture_array_count=$halfday_lecture_count+1;
             if($halfday_lecture_count >= $before_recess2_lecture_count && $recess_count == 2)
             {
                $total_lecture_array_count=$total_lecture_array_count+1; 
             }
		 }
		   
		  for($i=0;$i<$total_lecture_array_count;$i++)
		  {
			 $day_wise_id=$day_wise_id+1;
			 $day_wise_id_count=$day_wise_id_count+1;
			
			 if($set == 0)
			 {
				if($i == 0)
				{
					if($institute_time_recored[0] < 10)
					{
						echo $institute_time_recored[0]="0".$institute_time_recored[0];
					}
				}
		
		        if($institute_time_recored[$i+1] < 10)
		        {
                    $institute_time_recored[$i+1]="0".$institute_time_recored[$i+1];
		        }
	       }
			
			if($i == $total_lecture_array_count-1)
			{
				 $set=1;
			}
			
			$time_for_stored=$institute_time_recored[$i]." - ".$institute_time_recored[$i+1];
			$time_for_id="col_".$institute_time_recored[$i]."_".$institute_time_recored[$i+1]."_".$j;
			$time_for_id=str_replace( "." , "_" ,$time_for_id);

			 //create a col for timmming
				$sql_statement1=$conn->prepare("ALTER TABLE  ".$table_name_1."  ADD $time_for_id int ;");
                $sql_statement1->execute();/* execution of query */
				
				//statement/query for insert data in time col 
				 $sql_statement2=$conn->prepare(" UPDATE ".$table_name_1." SET $time_for_id = ? WHERE $col_name= ?;");
				 
	       if($institute_time_recored[$i] == $first_recess_start_time)
	       {
		      $day_wise_recess_id="recess";
			  $day_wise_id_count=$day_wise_id_count-1;
              $available=0;
			  $lecture_area="after_recess_lecture";
			  if($recess_count == 2)
			  {
				  $lecture_area="before_recess2_lecture";
			  }
			  
			  //excution of insert in time col query
			   $sql_statement2->bind_param("is", $available,$col_value);
                $sql_statement2->execute();/* execution of query */
				
				$sql_statement1=$conn->prepare("
                INSERT INTO ".$time_table_name."
                (
                    col_timming_id,
                    col_lecture_area,
                    col_timming,
                    col_day,
                    col_day_wise_id,
                    col_available
	           )VALUES(?,?,?,?,?,?)");
  
                $sql_statement1->bind_param("sssiii",
                $time_for_id,
                $day_wise_recess_id,
                $time_for_stored,
                $j,
                $day_wise_recess_id,
                $available
                );
                $sql_statement1->execute();/* execution of query */
               
               $day_wise_id_before_1[$j]=$day_wise_id-3;
		       $day_wise_id=0;
			 
	        }
            else if($institute_time_recored[$i] == $second_recess_start_time)
			{   
				$day_wise_recess_id="recess";
				$day_wise_id_count=$day_wise_id_count-1;
				$available=0;
				$lecture_area="after_recess_lecture";
				 //excution of insert in time col query
			   $sql_statement2->bind_param("is", $available,$col_value);
                $sql_statement2->execute();/* execution of query */
				
				$sql_statement1=$conn->prepare("
                INSERT INTO ".$time_table_name."
                (
                    col_timming_id,
                    col_lecture_area,
                    col_timming,
                    col_day,
                    col_day_wise_id,
                    col_available
	           )VALUES(?,?,?,?,?,?)");
  
                $sql_statement1->bind_param("sssiii",
                $time_for_id,
                $day_wise_recess_id,
                $time_for_stored,
                $j,
                $day_wise_recess_id,
                $available
                );
                $sql_statement1->execute();/* execution of query */
		
				$day_wise_id_before_2[$j]=$day_wise_id-1;
				$day_wise_id=0;
			}		
            else
            {
				$available=1;
				
				 //excution of insert in time col query
			   $sql_statement2->bind_param("is", $available,$col_value);
                $sql_statement2->execute();/*execution of query */
				
				$sql_statement1=$conn->prepare("
                INSERT INTO ".$time_table_name."
                (
                    col_timming_id,
                    col_lecture_area,
                    col_timming,
                    col_day,
                    col_day_wise_id,
                    col_available
	           )VALUES(?,?,?,?,?,?)");
  
                $sql_statement1->bind_param("sssiii",
                $time_for_id,
                $lecture_area,
                $time_for_stored,
                $j,
                $day_wise_id_count,
                $available
                );
                $sql_statement1->execute();/* execution of query */
               if($institute_time_recored[$i+1] == $institute_end_time)
				{
					$day_wise_id_after[$j]=$day_wise_id;
				}
            }
          }
       }
    }
	
	//counting total number of lecture of each part(i.e before recess,after recess,....)
    $recess1_before_total_lecture_count=0;
    $recess_after_total_lecture_count=0;
    $recess2_before_total_lecture_count=0;
    for($i=0;$i<6;$i++)
    {
        if(isset($day_wise_id_before_1[$i]))
        {
            $recess1_before_total_lecture_count=$recess1_before_total_lecture_count+$day_wise_id_before_1[$i]+2;
        }
        else
        {
            $day_wise_id_before_1[$i]=0;
        }
    
        if(isset($day_wise_id_after[$i]))
        {
            $recess_after_total_lecture_count=$recess_after_total_lecture_count+$day_wise_id_after[$i];
        }
        else
        {
            $day_wise_id_after[$i]=0;
        }
        
        if(!isset($first_lecture_count[$i]))
        {
            $first_lecture_count[$i]=0;
        }
        
        if($recess_count == 1)
	    {
		    $day_wise_id_before_2[$i]=0;
        }
	    else
        {
			if(isset($day_wise_id_before_2[$i]))
			{
				 $recess2_before_total_lecture_count=$recess2_before_total_lecture_count+$day_wise_id_before_2[$i];
			}
			else
			{
				$day_wise_id_before_2[$i]=0;
			}
           
        }
    }
	 
    $sql_statement1=$conn->prepare("
   UPDATE ".$table_name_1." SET
		col_recess1_before_total_lecture_count	=	?,
		col_recess2_before_total_lecture_count	=	?,
		col_recess_after_total_lecture_count		=	?,
		col_total_lecture_count 								=	?
    WHERE $col_name= ?");
  
    $sql_statement1->bind_param("iiiis",                         
	$recess1_before_total_lecture_count,
	$recess2_before_total_lecture_count,
	$recess_after_total_lecture_count,
	$total_lecture_count,
	$col_value
    );
    $sql_statement1->execute();/* execution of query */
	 
	}
}

//insert institute time detail function
if(isset($_POST['insert_institute_time_detail']))
{   
    echo $table_name=$login_session."_institute_time_detail";
	 /* create user institute_time_detail table  */
  $sql_query1="CREATE TABLE IF NOT EXISTS ".$login_session."_institute_time_detail
   ( /* Column name       Column data type */
		srno           	 				 	int NOT NULL, 
		col_institute_start_hour         	int(2) UNSIGNED ZEROFILL,
		col_institute_start_minute       	int(2) UNSIGNED ZEROFILL,
		col_institute_start_amorpm       	text,
		col_institute_end_hour        	 	int(2) UNSIGNED ZEROFILL,
		col_institute_end_minute       	 	int(2) UNSIGNED ZEROFILL,
		col_institute_end_amorpm       		text,
		col_recess_count       			 	int,
		col_first_recess_start_hour         int(2) UNSIGNED ZEROFILL,
		col_first_recess_start_minute       int(2) UNSIGNED ZEROFILL,
		col_first_recess_start_amorpm       text,
		col_first_recess_end_hour        	int(2) UNSIGNED ZEROFILL,
		col_first_recess_end_minute       	int(2) UNSIGNED ZEROFILL,
		col_first_recess_end_amorpm       	text,		
		col_second_recess_start_hour        int(2) UNSIGNED ZEROFILL,
		col_second_recess_start_minute      int(2) UNSIGNED ZEROFILL,
		col_second_recess_start_amorpm      text,
		col_second_recess_end_hour        	int(2) UNSIGNED ZEROFILL,
		col_second_recess_end_minute       	int(2) UNSIGNED ZEROFILL,
		col_second_recess_end_amorpm       	text,		
		col_daily_lecture_count       		int,
		col_lecture_gap_time       			int,
		col_holiday			        		int,				
		col_closed_day			       		int,	
		col_halfday       			       	int,		
		col_opened_day				  		int,	
        col_halfday_lecture_count       	int,
        col_total_lecture_count       		int,
		PRIMARY KEY (`srno`)
	);";
  $conn->query($sql_query1);/* execution of query */

    $table_name_1=$login_session."_free_solt_detail";
 /* create user free_solt_detail table  */
  $sql_query1="CREATE TABLE IF NOT EXISTS ".$table_name_1."
   ( /* Column name      			 			 					Column data type */
		srno       	 							 							int AUTO_INCREMENT,
		col_teacher_name    					 				text,
		col_class_name	    					 				text,
		col_lecture_place_name    				 			text,
		col_recess1_before_total_lecture_count	int,
		col_recess2_before_total_lecture_count	int,
        col_recess_after_total_lecture_count		int,
		col_total_lecture_count					 			int,
		PRIMARY KEY (`srno`)
	);";
  $conn->query($sql_query1);/* execution of query */
  
  
  insert_data(
	$conn,
	$table_name,
	$srno,
	$institute_start_hour,
	$institute_start_minute,
	$institute_start_amorpm,
	$institute_end_hour,
	$institute_end_minute,
	$institute_end_amorpm,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_start_amorpm,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$first_recess_end_amorpm,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_start_amorpm,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$second_recess_end_amorpm,
	$student_count,
	$batch_count,
	$daily_lecture_count,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
);
}

//insert teacher time detail function
if(isset($_POST['insert_teacher_time_detail']))
{
	//storing data into local variable
	$teacher_name     = $login_session."_".htmlspecialchars($_POST['post_teacher_name']);

/* create user teacher_time_detail table  */
  $sql_query2="CREATE TABLE IF NOT EXISTS ".$teacher_name."_time_detail
   ( /* Column name       Column data type */
		srno           	 				 	int NOT NULL, 
		col_institute_start_hour         	int(2) UNSIGNED ZEROFILL,
		col_institute_start_minute       	int(2) UNSIGNED ZEROFILL,
		col_institute_start_amorpm       	text,
		col_institute_end_hour        	 	int(2) UNSIGNED ZEROFILL,
		col_institute_end_minute       	 	int(2) UNSIGNED ZEROFILL,
		col_institute_end_amorpm       		text,
		col_recess_count       			 	int,
		col_first_recess_start_hour         int(2) UNSIGNED ZEROFILL,
		col_first_recess_start_minute       int(2) UNSIGNED ZEROFILL,
		col_first_recess_start_amorpm       text,
		col_first_recess_end_hour        	int(2) UNSIGNED ZEROFILL,
		col_first_recess_end_minute       	int(2) UNSIGNED ZEROFILL,
		col_first_recess_end_amorpm       	text,		
		col_second_recess_start_hour        int(2) UNSIGNED ZEROFILL,
		col_second_recess_start_minute      int(2) UNSIGNED ZEROFILL,
		col_second_recess_start_amorpm      text,
		col_second_recess_end_hour        	int(2) UNSIGNED ZEROFILL,
		col_second_recess_end_minute       	int(2) UNSIGNED ZEROFILL,
		col_second_recess_end_amorpm       	text,		
		col_daily_lecture_count       		int,
		col_lecture_gap_time       			int,
		col_holiday			        		int,				
		col_closed_day			       		int,	
		col_halfday       			       	int,		
		col_opened_day				  		int,	
        col_halfday_lecture_count       	int,
        col_total_lecture_count       		int,
		PRIMARY KEY (`srno`)
	);";
  $conn->query($sql_query2);/* execution of query */
  
    $time_table_name=$teacher_name."_timetable";
  /* create user teacher timetable table  */
  $sql_query1="CREATE TABLE IF NOT EXISTS ".$time_table_name."
   ( /* Column name    		Column data type */
		srno       	 		int AUTO_INCREMENT,
		col_timming_id			text,
		col_lecture_area			text,
		col_timming			text,
		col_day				int, 
		col_day_wise_id    	int,
		col_available  		int,
		col_teacher_name   	text,
		col_lecture_name   	text,
		col_lecture_type	text,
		col_lecture_place	text,
		col_batch     		text,
		col_batch_day      	int,
		col_batch_student 	text,
		col_class_name     	text,
		col_row_span       	int,
		PRIMARY KEY (`srno`)
	);";
  $conn->query($sql_query1);/* execution of query */
  
  $table_name=$teacher_name."_time_detail";
  
  insert_data(
	$conn,
	$table_name,
	$srno,
	$institute_start_hour,
	$institute_start_minute,
	$institute_start_amorpm,
	$institute_end_hour,
	$institute_end_minute,
	$institute_end_amorpm,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_start_amorpm,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$first_recess_end_amorpm,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_start_amorpm,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$second_recess_end_amorpm,
	$student_count,
	$batch_count,
	$daily_lecture_count,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count, 
	$total_lecture_count 
	);
     
    insert_timming_data(
	$conn,
	$teacher_name,
	$class_name,
	$time_table_name,
	$institute_start_hour,
	$institute_start_minute,
	$institute_end_hour,
	$institute_end_minute,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
    );
}

//insert class time detail function
if(isset($_POST['insert_class_time_detail']))
{
	//storing data into local variable
	$student_count		= htmlspecialchars($_POST['post_student_count']);
	$batch_count		= htmlspecialchars($_POST['post_batch_count']);
    $class_name   		= $login_session."_".htmlspecialchars($_POST['post_class_name']);

  /* create user class_time_detail table  */
  $sql_query3="CREATE TABLE IF NOT EXISTS ".$class_name."_time_detail
   ( /* Column name       Column data type */
		srno           	 				 	int NOT NULL,
		col_institute_start_hour         	int(2) UNSIGNED ZEROFILL,
		col_institute_start_minute       	int(2) UNSIGNED ZEROFILL,
		col_institute_start_amorpm       	text,
		col_institute_end_hour        	 	int(2) UNSIGNED ZEROFILL,
		col_institute_end_minute       	 	int(2) UNSIGNED ZEROFILL,
		col_institute_end_amorpm       		text,
		col_recess_count       			 	int,
		col_first_recess_start_hour         int(2) UNSIGNED ZEROFILL,
		col_first_recess_start_minute       int(2) UNSIGNED ZEROFILL,
		col_first_recess_start_amorpm       text,
		col_first_recess_end_hour        	int(2) UNSIGNED ZEROFILL,
		col_first_recess_end_minute       	int(2) UNSIGNED ZEROFILL,
		col_first_recess_end_amorpm       	text,		
		col_second_recess_start_hour        int(2) UNSIGNED ZEROFILL,
		col_second_recess_start_minute      int(2) UNSIGNED ZEROFILL,
		col_second_recess_start_amorpm      text,
		col_second_recess_end_hour        	int(2) UNSIGNED ZEROFILL,
		col_second_recess_end_minute       	int(2) UNSIGNED ZEROFILL,
		col_second_recess_end_amorpm       	text,
		col_student_count                	int,
		col_batch_count                  	int,
        col_daily_lecture_count       		int,
        col_lecture_gap_time	       		int,
		col_holiday			        		int,				
		col_closed_day			       		int,				
		col_halfday       			       	int,
		col_opened_day				  		int,
        col_halfday_lecture_count       	int,
        col_total_lecture_count		       	int,
		PRIMARY KEY (`srno`)
	);";
  $conn->query($sql_query3);/* execution of query */
  
    $time_table_name=$class_name."_timetable";
    
  /* create user class timetable table  */
  $sql_query1="CREATE TABLE IF NOT EXISTS ".$time_table_name."
   ( /* Column name    		Column data type */
		srno       	 		int AUTO_INCREMENT,
		col_timming_id			text,
		col_lecture_area			text,
		col_timming			text,
		col_day				int, 
		col_day_wise_id    	int,
		col_available		int,
		col_teacher_name   	text,
		col_lecture_name   	text,
		col_lecture_type	text,
		col_lecture_place	text,
		col_batch     		text,
		col_batch_day      	int,
		col_batch_student 	text,
		col_class_name     	text,
		col_row_span       	int,
		PRIMARY KEY (`srno`)
	);";
  $conn->query($sql_query1);/* execution of query */
  
  $table_name=$class_name."_time_detail";
  
  insert_data(
	$conn,
	$table_name,
	$srno,
	$institute_start_hour,
	$institute_start_minute,
	$institute_start_amorpm,
	$institute_end_hour,
	$institute_end_minute,
	$institute_end_amorpm,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_start_amorpm,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$first_recess_end_amorpm,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_start_amorpm,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$second_recess_end_amorpm,
	$student_count,
	$batch_count,
	$daily_lecture_count,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count, 
	$total_lecture_count 
	);
    
    insert_timming_data(
	$conn,
	$teacher_name,
	$class_name,
	$time_table_name,
	$institute_start_hour,
	$institute_start_minute,
	$institute_end_hour,
	$institute_end_minute,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
    );
}  

//update institute time detail function
if(isset($_POST['update_institute_time_detail']))
{
	$table_name=$login_session."_institute_time_detail";
	
    
  update_data(
	$conn,
	$table_name,
	$srno,
	$institute_start_hour,
	$institute_start_minute,
	$institute_start_amorpm,
	$institute_end_hour,
	$institute_end_minute,
	$institute_end_amorpm,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_start_amorpm,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$first_recess_end_amorpm,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_start_amorpm,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$second_recess_end_amorpm,
	$student_count,
	$batch_count,
	$daily_lecture_count,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
);
}  

//update teacher detail function
if(isset($_POST['update_teacher_time_detail']))
{
	//storing data into local variable
	$teacher_name     = $login_session."_".htmlspecialchars($_POST['post_teacher_name']);
	
	$table_name=$teacher_name."_time_detail";
	
  update_data(
	$conn,
	$table_name,
	$srno,
	$institute_start_hour,
	$institute_start_minute,
	$institute_start_amorpm,
	$institute_end_hour,
	$institute_end_minute,
	$institute_end_amorpm,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_start_amorpm,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$first_recess_end_amorpm,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_start_amorpm,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$second_recess_end_amorpm,
	$student_count,
	$batch_count,
	$daily_lecture_count,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count, 
	$total_lecture_count 
	);
	
	$time_table_name=$teacher_name."_timetable";
	
    insert_timming_data(
	$conn,
	$teacher_name,
	$class_name,
	$time_table_name,
	$institute_start_hour,
	$institute_start_minute,
	$institute_end_hour,
	$institute_end_minute,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
    );
}
 
//update class time detail function
if(isset($_POST['update_class_time_detail']))
{
	//storing data into local variable
	$student_count		= htmlspecialchars($_POST['post_student_count']);
	$batch_count		= htmlspecialchars($_POST['post_batch_count']);
    $class_name   = $login_session."_".htmlspecialchars($_POST['post_class_name']);
    
	$table_name=$class_name."_time_detail";
  update_data(
	$conn,
	$table_name,
	$srno,
	$institute_start_hour,
	$institute_start_minute,
	$institute_start_amorpm,
	$institute_end_hour,
	$institute_end_minute,
	$institute_end_amorpm,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_start_amorpm,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$first_recess_end_amorpm,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_start_amorpm,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$second_recess_end_amorpm,
	$student_count,
	$batch_count,
	$daily_lecture_count,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count, 
	$total_lecture_count 
	);
	
	$time_table_name=$class_name."_timetable";
	
    insert_timming_data(
	$conn,
	$teacher_name,
	$class_name,
	$time_table_name,
	$institute_start_hour,
	$institute_start_minute,
	$institute_end_hour,
	$institute_end_minute,
	$recess_count,
	$first_recess_start_hour,
	$first_recess_start_minute,
	$first_recess_end_hour,
	$first_recess_end_minute,
	$second_recess_start_hour,
	$second_recess_start_minute,
	$second_recess_end_hour,
	$second_recess_end_minute,
	$lecture_gap_time,
	$holiday,
	$closed_day,
	$halfday,
	$opened_day,
	$halfday_lecture_count,
	$total_lecture_count
    );
}  

if(isset($_POST['post_institute_start_amorpm'])  ||  isset($_POST['back']))
{
	header("Location:adminhome.php");
}

?>
