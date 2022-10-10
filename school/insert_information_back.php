<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//inlized global variableS
$lecture_information_count="";
$lecture_place_detail_count="";
$teacher_detail_count="";
$student_detail_count="";
    
//inserting time data in table  
function insert_timming_data(
	$conn,
	$lecture_place_name,
	$time_table_name
)
{
	/* Finding teacher/class timetable table in database */
	$sql_query2="SELECT * FROM ".$time_table_name." "; 
	$result2=$conn->query($sql_query2);/* execution of query */
	if($result2->num_rows > 0)
	{
        $sql_query2="TRUNCATE ".$time_table_name." "; 
        $result2=$conn->query($sql_query2);/* execution of query */
    }
	
	 if($lecture_place_name != "")
	 {
	  /* Finding teacher free solt table in database */
	$sql_query2="SELECT * FROM free_solt_detail WHERE col_lecture_place_name='".$lecture_place_name."'"; 
	$result2=$conn->query($sql_query2);/* execution of query */
	if($result2->num_rows > 0)
	{
        $sql_query2="DELETE FROM free_solt_detail WHERE col_lecture_place_name='".$lecture_place_name."'"; 
        $result2=$conn->query($sql_query2);/* execution of query */
    }
	
    $sql_statement1=$conn->prepare(" INSERT INTO free_solt_detail (col_lecture_place_name)VALUES(?)");
    $sql_statement1->bind_param("s",$lecture_place_name);
    $sql_statement1->execute();/* execution of query */ 
	}
	
    /* Finding teacher/class timetable table in database */
	$sql_query2="SELECT * FROM institute_time_detail "; 
	$result2=$conn->query($sql_query2);/* execution of query */
    $data1=$result2->fetch_array();
    //timmming setting
    $institute_start_hour		= $data1['col_institute_start_hour'].".0";
    $institute_start_minute	    = "0.".$data1['col_institute_start_minute'];
    $institute_end_hour		    = $data1['col_institute_end_hour'].".0";
    $institute_end_minute		= "0.".$data1['col_institute_end_minute'];
    $recess_count			    = $data1['col_recess_count'];
    $first_recess_start_hour 	= $data1['col_first_recess_start_hour'].".0";
    $first_recess_start_minute  = "0.".$data1['col_first_recess_start_minute'];
    $first_recess_end_hour		= $data1['col_first_recess_end_hour'].".0";
    $first_recess_end_minute	= "0.".$data1['col_first_recess_end_minute'];
    $lecture_gap_time			= "0.".$data1['col_lecture_gap_time'];
    $holiday         		= $data1['col_holiday'];
	if($holiday != 0)
	{
		$closed_day         		= $data1['col_closed_day'];
	}
	else
	{
		$closed_day         		= 6;
	}
    $halfday		= $data1['col_halfday'];
    $opened_day		= $data1['col_opened_day'];
    $halfday_lecture_count		= $data1['col_halfday_lecture_count'];
    $total_lecture_count		= $data1['col_total_lecture_count'];
    $lecture_time_count=1;
	$before_recess2_lecture_count=0;
    
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
        
		$before_recess_lecture_count=$lecture_time_count+1;
        
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
        //after recess
	   $minute=$first_recess_end_minute;
	   for($i=$first_recess_end_time;$i <= $institute_end_time;)
	   {
		//second recare time set to 0 when only one recess is there
		$second_recess_start_time=0;
		
		  $institute_time_recored[]=number_format((float)$i, 2);
		  
          $after_recess_lecture_count=$lecture_time_count+1; 
           
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
	   $second_recess_start_hour 	= $data1['col_second_recess_start_hour'].".0";
       $second_recess_start_minute  = "0.".$data1['col_second_recess_start_minute'];
	   $second_recess_end_hour		= $data1['col_second_recess_end_hour'].".0";
       $second_recess_end_minute	= "0.".$data1['col_second_recess_end_minute'];
	
        //time=hour:min
	   $second_recess_start_time	 = $second_recess_start_hour 	+ $second_recess_start_minute;
       $second_recess_end_time		 = $second_recess_end_hour	 	+ $second_recess_end_minute;
	
	   //after recess and before 2 recess
	   $minute=$first_recess_end_minute;
	   for($i=$first_recess_end_time;$i <= $second_recess_start_time;)
	   {
		  $institute_time_recored[]=number_format((float)$i, 2);
		  
          $before_recess2_lecture_count=$lecture_time_count+1; 
		
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
		  
          $after_recess2_lecture_count=$lecture_time_count+1; 
		
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
   
    $day_wise_recess_id=0;
	
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
	
			 if($j == 0)
			 {
				if($i == 0)
				{
					if($institute_time_recored[0] < 10)
					{
						$institute_time_recored[0]="0".$institute_time_recored[0];
					}
				}
		
		        if($institute_time_recored[$i+1] < 10)
		        {
                    $institute_time_recored[$i+1]="0".$institute_time_recored[$i+1];
		        }
	       }
			
			$time_for_stored=$institute_time_recored[$i]." - ".$institute_time_recored[$i+1];
			$time_for_id="col_".$institute_time_recored[$i]."_".$institute_time_recored[$i+1]."_".$j;
			$time_for_id=str_replace( "." , "_" ,$time_for_id);

			 //create a col for timmming
				$sql_statement1=$conn->prepare("ALTER TABLE  free_solt_detail  ADD $time_for_id int;");
                $sql_statement1->execute();/* execution of query */
				
				//statement/query for insert data in time col 
				 $sql_statement2=$conn->prepare(" UPDATE free_solt_detail SET $time_for_id = ? WHERE col_lecture_place_name= ?;");
				 
	       if($institute_time_recored[$i] == $first_recess_start_time)
	       {
		      $day_wise_recess_id="recess";
			  $day_wise_id_count=$day_wise_id_count-1;
              $available=0;
              $available_1=2;
			  $lecture_area="after_recess_lecture";
			  if($recess_count == 2)
			  {
				  $lecture_area="before_recess2_lecture";
			  }
			  
			  //excution of insert in time col query
			   $sql_statement2->bind_param("is", $available_1,$lecture_place_name);
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
                $available_1=2;
				$lecture_area="after_recess_lecture";
				 //excution of insert in time col query
			   $sql_statement2->bind_param("is", $available_1,$lecture_place_name);
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
			   $sql_statement2->bind_param("is", $available,$lecture_place_name);
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
   UPDATE free_solt_detail SET
		col_recess1_before_total_lecture_count	=	?,
		col_recess2_before_total_lecture_count	=	?,
		col_recess_after_total_lecture_count		=	?,
		col_total_lecture_count 								=	?
    WHERE col_lecture_place_name= ?");
  
    $sql_statement1->bind_param("iiiis",                         
	$recess1_before_total_lecture_count,
	$recess2_before_total_lecture_count,
	$recess_after_total_lecture_count,
	$total_lecture_count,
	$lecture_place_name
    );
    $sql_statement1->execute();/* execution of query */ 
}

//connection to database
include('user_connection.php');

//exctration of data from table lecture information
if(isset($_POST['display_lecture_information']))
{
    /* Finding lecture information table in database */
	$sql_query1="SELECT * FROM lecture_information";
	$result1=$conn->query($sql_query1);/* execution of query */
    if($result1 == "")
	{
        echo '
            <tr>
                <td colspan="6">No Lecture Found</td>
            </tr>
            ';
    }
    else
    {
        /* counting no of row from lecture information table */
        $lecture_information_count=$result1->num_rows;
		
		if($result1->num_rows > 0)
		{
			while($data1=$result1->fetch_array())
			{
                /* storing data from lecture information table to array variable*/
				$srno[]					= $data1['srno'];
				$lecture_full_name[]	= $data1['col_lecture_full_name'];
				$lecture_short_name[]	= $data1['col_lecture_short_name'];
				$lecture_type[]			= $data1['col_lecture_type'];
				$lecture_place[]		= $data1['col_lecture_place'];
			}
		}
		
        if( $lecture_information_count == 0 )
        {
            echo '
            <tr>
                <td colspan="6">No Lecture Found</td>
            </tr>
            ';
        }
        else
        {
            //displaying data of lecture information table in loop
            for($i=0;$i<$lecture_information_count;$i++)
            {
               echo '
                <tr>
					<td>
						<input type="text" name="post_lecture_full_name'.$srno[$i].'" id="post_lecture_full_name'.$srno[$i].'" placeholder="Name" value="'.$lecture_full_name[$i].'">
					</td>
					<td>
						<input type="text" name="post_lecture_short_name'.$srno[$i].'" id="post_lecture_short_name'.$srno[$i].'" placeholder="Short Name" maxlength="5" value="'.$lecture_short_name[$i].'">
					</td>
                    <td>
                        <select name="post_lecture_type'.$srno[$i].'" id="post_lecture_type'.$srno[$i].'">';
						  $first_option=$lecture_type[$i];
					       $lecture_type_array=array('Theory(TH)','Pratical(PR)','Extracurricular Activities(EA)');
						
						  echo '
							<option value="'.$first_option.'">'.$lecture_type_array[$first_option].'</option>
						  ';
						
						  for($j=0;$j < 3;$j++)
						  {
							if($lecture_type[$i] != $j)
							{
								echo '<option value="'.$j.'">'.$lecture_type_array[$j].'</option>';
							}
						  }
						
                echo '	</select>
					</td>
                    <td>
                        <select name="post_lecture_place'.$srno[$i].'" id="post_lecture_place'.$srno[$i].'">';
						  $first_option=$lecture_place[$i];
					       $lecture_place_array=array('Classroom','Lab','Auditorium','Ground');
						
						  echo '
							<option value="'.$first_option.'">'.$lecture_place_array[$first_option].'</option>
						  ';
						
						  for($j=0;$j < 4;$j++)
						  {
							if($lecture_place[$i] != $j)
							{
								echo '<option value="'.$j.'">'.$lecture_place_array[$j].'</option>';
							}
						  }
						
                echo '	</select>
					</td>
                    <td><button type="submit" name="update_lecture_information" id="'.$srno[$i].'" onclick="update_lecture_information(this.id)">Update</button></td>
                    <td><button type="submit" name="remove_lecture_information" id="'.$srno[$i].'" onclick="remove_lecture_information(this.id)">Remove</button></td>
                </tr>
               '; 
            }
        }
        
    }
}

//insert lecture information table
if(isset($_POST['insert_lecture_information']))
{
    /* creating user lecture information table  */
    $sql_query2="CREATE TABLE IF NOT EXISTS lecture_information
    ( /* Column name                        Column data type */
        srno            	    int NOT NULL AUTO_INCREMENT,
        col_lecture_full_name   text,
        col_lecture_short_name  text,
        col_lecture_type        text,
        col_lecture_place       text,
        PRIMARY KEY (`srno`)
	);";
    $conn->query($sql_query2);/* execution of query */
    
    //storing data into variable
     $lecture_full_name		= htmlspecialchars(ucfirst($_POST['post_lecture_full_name']));
     $lecture_short_name	= htmlspecialchars(strtoupper($_POST['post_lecture_short_name']));
     $lecture_type			= htmlspecialchars($_POST['post_lecture_type']);
     $lecture_place			= htmlspecialchars($_POST['post_lecture_place']);
    
    /* inserting data in user lecture information table */
  $sql_statement1=$conn->prepare("
  INSERT INTO lecture_information
 (
	col_lecture_full_name,
	col_lecture_short_name,
	col_lecture_type,
	col_lecture_place
 )VALUES(?,?,?,?)");
  
  $sql_statement1->bind_param("ssss",
	$lecture_full_name,
	$lecture_short_name,
	$lecture_type,
	$lecture_place
  );
  $sql_statement1->execute();/* execution of query */
}

//update lecture information table
if(isset($_POST['update_lecture_information']))
{
    //storing data into variable
     $srno		            = htmlspecialchars($_POST['post_srno']);
	 $lecture_full_name		= htmlspecialchars(ucfirst($_POST['post_lecture_full_name']));
     $lecture_short_name	= htmlspecialchars(strtoupper($_POST['post_lecture_short_name']));
     $lecture_type			= htmlspecialchars($_POST['post_lecture_type']);
     $lecture_place			= htmlspecialchars($_POST['post_lecture_place']);
    
  /* updating data in user lecture information table */
  $sql_statement2=$conn->prepare("
  UPDATE lecture_information SET
	col_lecture_full_name	=	?,
	col_lecture_short_name  =	?,
    col_lecture_type	    =	?,
	col_lecture_place	    =	?
	WHERE srno              =   ?
 ");
  
  $sql_statement2->bind_param("ssssi",                         
	$lecture_full_name,
	$lecture_short_name,
	$lecture_type,
	$lecture_place,
    $srno 
  );
  $sql_statement2->execute();/* execution of query */
}

//remove data from lecture information table
if(isset($_POST['remove_lecture_information']))
{
    
}

//exctration of data from table lecture information
if(isset($_POST['display_lecture_place_detail']))
{
    /* Finding lecture place detail table in database */
	$sql_query3="SELECT * FROM lecture_place_detail";
	$result3=$conn->query($sql_query3);/* execution of query */
    if($result3 == "")
	{
        echo '
            <tr>
                <td colspan="4">No place detail Found</td>
            </tr>
            ';
    }
    else
    {
        /* counting no of row from lecture place detail table */
        $lecture_place_detail_count=$result3->num_rows;
		
		if($result3->num_rows > 0)
		{
			while($data3=$result3->fetch_array())
			{
                /* storing data from lecture place detail table to array variable*/
				$srno[]					= $data3['srno'];
				$lecture_place_name[]	= $data3['col_lecture_place_name'];
				$lecture_place[]	    = $data3['col_lecture_place'];
			}
		}
		
        if( $lecture_place_detail_count == 0 )
        {
            echo '
            <tr>
                <td colspan="4">No place detail Found</td>
            </tr>
            ';
        }
        else
        {
            //displaying data of lecture information table in loop
            for($i=0;$i<$lecture_place_detail_count;$i++)
            {
               echo '
                <tr>
					<td>
						<input type="text" name="post_lecture_place_name'.$srno[$i].'" id="post_lecture_place_name'.$srno[$i].'" placeholder="Name" value="'.$lecture_place_name[$i].'">
					</td>
                    <td>
                        <select name="post_lecture_place'.$srno[$i].'" id="post_lecture_place'.$srno[$i].'">';
						  $first_option=$lecture_place[$i];
					       $lecture_place_array=array('Classroom','Lab','Auditorium','Ground');
						
						  echo '
							<option value="'.$first_option.'">'.$lecture_place_array[$first_option].'</option>
						  ';
						
						  for($j=1;$j < 4;$j++)
						  {
							if($lecture_place[$i] != $j)
							{
								echo '<option value="'.$j.'">'.$lecture_place_array[$j].'</option>';
							}
						  }
                echo '	</select>
					</td>
                    <td><button type="submit" name="update_lecture_place_detail" id="'.$srno[$i].'" onclick="update_lecture_place_detail(this.id)">Update</button></td>
                    <td><button type="submit" name="remove_lecture_information" id="'.$srno[$i].'" onclick="remove_lecture_information(this.id)">Remove</button></td>
                </tr>
               '; 
            }
        }
        
    }
}

//insert lecture place detail table
if(isset($_POST['insert_lecture_place_detail']))
{
    /* creating user lecture information table  */
    $sql_query4="CREATE TABLE IF NOT EXISTS lecture_place_detail
    ( /* Column name                        Column data type */
        srno            	    int NOT NULL AUTO_INCREMENT,
        col_lecture_place_name     text,
        col_lecture_place          text,
        PRIMARY KEY (`srno`)
	);";
    $conn->query($sql_query4);/* execution of query */
    
    //storing data into variable
     $lecture_place_name	= htmlspecialchars($_POST['post_lecture_place_name']);
     $lecture_place			= htmlspecialchars($_POST['post_lecture_place']);
   
    /* inserting data in user lecture information table */
  $sql_statement4=$conn->prepare("
  INSERT INTO lecture_place_detail
 (
	col_lecture_place_name,
	col_lecture_place
 )VALUES(?,?)");
  
  $sql_statement4->bind_param("ss",
	$lecture_place_name,
	$lecture_place
  );
  $sql_statement4->execute();/* execution of query */
    
   echo $time_table_name=$lecture_place_name."_timetable";
    
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
      
  insert_timming_data(
	$conn,
	$lecture_place_name,
	$time_table_name
  );       
}

//update lecture place detail table
if(isset($_POST['update_lecture_place_detail']))
{
    //storing data into variable
     $srno		            = htmlspecialchars($_POST['post_srno']);
     $lecture_place_name	= htmlspecialchars($_POST['post_lecture_place_name']);
     $lecture_place			= htmlspecialchars($_POST['post_lecture_place']);
    
  /* updating data in user lecture place detail table */
  $sql_statement5=$conn->prepare("
  UPDATE lecture_place_detail SET
	col_lecture_place_name	=	?,
	col_lecture_place	    =	?
	WHERE srno              =   ?
 ");
  
  $sql_statement5->bind_param("ssi",                         
	$lecture_place_name,
	$lecture_place,
    $srno 
  );
  $sql_statement5->execute();/* execution of query */
    
  $time_table_name=$lecture_place_name."_timetable";
    
  insert_timming_data(
	$conn,
	$lecture_place_name,
	$time_table_name
  );    
}

//remove data from lecture place detail table
if(isset($_POST['remove_lecture_place_detail']))
{
    
}

//exctration of data from table teacher detail
if(isset($_POST['display_teacher_detail']))
{
    /* Finding teacher detail table in database */
	$sql_query5="SELECT * FROM teacher_detail";
	$result5=$conn->query($sql_query5);/* execution of query */
    if($result5 == "")
	{
        echo '
            <tr>
                <td colspan="8">No Lecture Found</td>
            </tr>
            ';
    }
    else
    {
        /* counting no of row from teacher detail table */
        $teacher_detail_count=$result5->num_rows;
		
		if($result5->num_rows > 0)
		{
			while($data5=$result5->fetch_array())
			{
                /* storing data from teacher detail table to array variable*/
				$srno[]							= $data5['srno'];
				$teacher_first_name[]			= $data5['col_teacher_first_name'];
				$teacher_middle_name[]			= $data5['col_teacher_middle_name'];
				$teacher_last_name[]			= $data5['col_teacher_last_name'];
				$teacher_short_name[]			= $data5['col_teacher_short_name'];
				$teacher_id[]	        		= $data5['col_teacher_id'];
				$teacher_default_password[]		= $data5['col_teacher_default_password'];
			}
		}
		
        if( $teacher_detail_count == 0 )
        {
            echo '
            <tr>
                <td colspan="8">No Lecture Found</td>
            </tr>
            ';
        }
        else
        {
            //displaying data of teacher detail table in loop
            for($i=0;$i<$teacher_detail_count;$i++)
            {
               echo '
                <tr>
					<td>
						<input type="text" name="post_teacher_first_name'.$srno[$i].'" id="post_teacher_first_name'.$srno[$i].'" placeholder="First Name" value="'.$teacher_first_name[$i].'">
					</td>
					<td>
						<input type="text" name="post_teacher_middle_name'.$srno[$i].'" id="post_teacher_middle_name'.$srno[$i].'" placeholder="Middle Name" value="'.$teacher_middle_name[$i].'">
					</td>
					<td>
						<input type="text" name="post_teacher_last_name'.$srno[$i].'" id="post_teacher_last_name'.$srno[$i].'" placeholder="Last Name" value="'.$teacher_last_name[$i].'">
					</td>
					<td>
						<input type="text" name="post_teacher_short_name'.$srno[$i].'" id="post_teacher_short_name'.$srno[$i].'" placeholder="Short Name" value="'.$teacher_short_name[$i].'" maxlength="5" >
					</td>
					<td>
						'.$teacher_id[$i].'
					</td><td>
						'.$teacher_default_password[$i].'
					</td>
                    <td><button type="submit" name="update_teacher_detail" id="'.$srno[$i].'" onclick="update_teacher_detail(this.id)">Update</button></td>
                    <td><button type="submit" name="remove_teacher_detail" id="'.$srno[$i].'" onclick="remove_teacher_detail(this.id)">Remove</button></td>
                </tr>
               '; 
            }
        }
        
    }
}

//insert lecture information table
if(isset($_POST['insert_teacher_detail']))
{
    /* creating user teacher detail table  */
    $sql_query6="CREATE TABLE IF NOT EXISTS teacher_detail
    ( /* Column name                        Column data type */
        srno            	    		int NOT NULL AUTO_INCREMENT,
        col_teacher_first_name      	text,
        col_teacher_middle_name     	text,
        col_teacher_last_name       	text,
        col_teacher_short_name      	text,
        col_teacher_id              	text,
        col_teacher_default_password    text,
        col_teacher_password            text,
        PRIMARY KEY (`srno`)
	);";
    $conn->query($sql_query6);/* execution of query */
    
    //storing data into variable
     $teacher_first_name		= htmlspecialchars(ucfirst($_POST['post_teacher_first_name']));
     $teacher_middle_name	    = htmlspecialchars(ucfirst($_POST['post_teacher_middle_name']));
     $teacher_last_name			= htmlspecialchars(ucfirst($_POST['post_teacher_last_name']));
     $teacher_short_name		= htmlspecialchars(strtoupper($_POST['post_teacher_short_name']));
    
    //creating id
    $teacher_id=$institute_dbname."_".strtolower($teacher_short_name)."@aotg.com";
    
    //creating random password 
	
	//creating array of special char
	$specialchar_array = array("`", "~", "!", "@", "$","#", "%", "^", "&", "*", "-", "_", "=", "+", ".", "/" , "|", "?");
	//taking out two radom index of above array i.e specialchar_array
	$specialchar_random_array_index = array_rand($specialchar_array, 2);
	//storing in variable
	$specialchar=$specialchar_array[$specialchar_random_array_index[0]];
	
	//creating array of alphabet 
	$alphabet_array = array("a", "b", "c", "d", "e","f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p" , "q", "r", "s", "t", "u", "v", "w","x", "y", "z","A", "B", "C", "D", "E","F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P" , "Q", "R", "S", "T", "U", "V", "W","X", "Y", "Z" );
	//taking out four radom index of above array i.e alphabet_array
	$alphabet_random_array_index = array_rand($alphabet_array, 4);
	//storing 2 alphabet in variable
	$alphabet1 = $alphabet_array[$alphabet_random_array_index['0']].$alphabet_array[$alphabet_random_array_index['1']];
	//storing another 2 alphabet in variable
	$alphabet2 =$alphabet_array[$alphabet_random_array_index['2']].$alphabet_array[$alphabet_random_array_index['3']];
	
	//creating array of number
	$numerical_array = array("1", "2", "3", "4", "5","6", "7", "8", "9");
	//taking out four radom index of above array i.e numerical_array
	$numerical_random_array_index = array_rand($numerical_array, 4);
	//storing 2 number in variable
	$numerical1 = $numerical_array[$numerical_random_array_index['0']].$numerical_array[$numerical_random_array_index['1']];
	//storing another 2 number in variable
	$numerical2=$numerical_array[$numerical_random_array_index['2']].$numerical_array[$numerical_random_array_index['3']];
	
	//margerging all variable and making password
	$teacher_default_password=$alphabet1.$numerical1.$specialchar.$alphabet2.$numerical2;
    
    
    /* inserting data in user teacher detail table */
  $sql_statement7=$conn->prepare("
  INSERT INTO teacher_detail
 (
	col_teacher_first_name,
	col_teacher_middle_name,
	col_teacher_last_name,
	col_teacher_short_name,
	col_teacher_id,
	col_teacher_default_password
 )VALUES(?,?,?,?,?,?)");
  
  $sql_statement7->bind_param("ssssss",
	$teacher_first_name,
	$teacher_middle_name,
	$teacher_last_name,
	$teacher_short_name,
	$teacher_id,
	$teacher_default_password
  );
  $sql_statement7->execute();/* execution of query */
}

//update teacher detail table
if(isset($_POST['update_teacher_detail']))
{
    //storing data into variable
     $srno		                = htmlspecialchars($_POST['post_srno']);
     $teacher_first_name		= htmlspecialchars(ucfirst($_POST['post_teacher_first_name']));
     $teacher_middle_name	    = htmlspecialchars(ucfirst($_POST['post_teacher_middle_name']));
     $teacher_last_name			= htmlspecialchars(ucfirst($_POST['post_teacher_last_name']));
     $teacher_short_name		= htmlspecialchars(strtoupper($_POST['post_teacher_short_name']));
    
    //creating id
    $teacher_id=$institute_dbname."_".strtolower($teacher_short_name)."@aotg.com";
    
  /* updating data in user teacher detail table */
  $sql_statement8=$conn->prepare("
  UPDATE teacher_detail SET
	col_teacher_first_name	    =	?,
	col_teacher_middle_name     =	?,
    col_teacher_last_name	    =	?,
    col_teacher_short_name	    =	?,
	col_teacher_id	            =	?
	WHERE srno                  =   ?
 ");
  
  $sql_statement8->bind_param("sssssi",
	$teacher_first_name,
	$teacher_middle_name,
	$teacher_last_name,
	$teacher_short_name,
	$teacher_id,
    $srno 
  );
    
  $sql_statement8->execute();/* execution of query */
}

//remove data from teacher detail table
if(isset($_POST['remove_teacher_detail']))
{
    
}

?>