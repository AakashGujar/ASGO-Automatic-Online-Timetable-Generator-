<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection to database
include('user_connection.php');

//inserting data in timetable table of class,teacher,lecture,etc
if(isset($_POST['insert_class_name']))
{
    $class_table_name          = htmlspecialchars($_POST['insert_class_name']);
    
    $sql_query1="SELECT * FROM ".$class_table_name."_time_detail";
	$result1=$conn->query($sql_query1);/* execution of query */
    /* extractinng class_time_detail table in database */
    $data1 = $result1->fetch_array();

    if(isset($data1)) 
	{
		if($data1['col_holiday'] != 0)
		{
			$closed_day = $data1['col_closed_day'];
		}
        else
        {
            $closed_day = 6;
	    }
    }
    
    /* Finding teacher/class timetable table in database */
	$sql_query2="SELECT * FROM ".$class_table_name."_subject_detail"; 
	$result2=$conn->query($sql_query2);/* execution of query */
	if(!empty($result2))
	{
        //$sql_query2="TRUNCATE ".$class_table_name."_subject_detail"; 
        //$result2=$conn->query($sql_query2);/* execution of query */
    }
    else
    {
        while()
        {
            
        }
    }
        if(isset($_POST['post_lecture_area']))
		{
            unset($lecture_place,$lecture_place_alternative);
			$lecture_area = htmlspecialchars($_POST['post_lecture_area']);  
			$teacher_name = htmlspecialchars($_POST['post_teacher_name']);  
			$lecture_name = htmlspecialchars($_POST['post_lecture_name']);  
			$lecture_type = htmlspecialchars($_POST['post_lecture_type']);  
            $lecture_count = htmlspecialchars($_POST['post_lecture_count']);  
			
            if(isset($_POST['post_lecture_place_name']))
			{
				$lecture_place = htmlspecialchars($_POST['post_lecture_place_name']);  
			}
            
            if(isset($_POST['post_day']))
            {
                $day=htmlspecialchars($_POST['post_day']);
            }
            else
            {
                $day=6;
            }
            
            
        if($lecture_area == "first_lecture")
        {
            /* class exter where condn.. */
			 $class_where_clause=" WHERE col_day_wise_id IN ('1', '2') AND col_day='".$day."'";
        }
        else if($lecture_area == "fullday_lecture" )
        {
            /* class exter where condn.. */
			 $class_where_clause="WHERE  col_day_wise_id NOT IN ('1', '2') AND col_day='".$day."' ";
        }
        else if($day < 6)
        {
            /* Finding teacher table in database */
	       $class_where_clause=" WHERE col_day='".$day."' AND col_lecture_area='".$lecture_area."' ";
        }
        else
        {
            /* class exter where condn.. */
			 $class_where_clause="WHERE col_lecture_area='".$lecture_area."'";
        }
            
         /* Extractin  freesolt information from free_solt_detail table in database */
			 $sql_query13="SELECT  *  FROM ".$class_table_name."_timetable $class_where_clause";
			$result13=$conn->query($sql_query13);/* execution of query */
            /* extractinng from free_solt_detail table in database */
		   while($data13 = $result13->fetch_array())
           {
               $class_timming_id[]=$data13['col_lecture_area'];
               $class_timming[]=$data13['col_timming'];
               $class_available[]=$data13['col_available'];
               $class_day[]=$data13['col_day'];
               $day_wise_id[]=$data13['col_day_wise_id'];
           }
            
            echo "<br> ctc ".$class_timming_count=count($class_timming);
        
        if($lecture_area == "first_lecture")
        {
            for($j=1;$j<=$lecture_count;$j++)
            {
                if($j == 2)
                {
                    $lecture_count=3;
                }
            
                $available=0;
                $sql_statement2=$conn->prepare("
				    UPDATE ".$class_table_name."_timetable SET 
					col_available = ?,
					col_teacher_name = ?,
					col_lecture_name= ?,
					col_lecture_type= ?,
					col_lecture_place=?,
					col_class_name=?,
					col_row_span =? 
				     WHERE col_day=? AND col_timming = ?");
                
                $sql_statement2->bind_param("isssssiis",
				$available,
				$teacher_name,
				$lecture_name,
				$lecture_type,
				$lecture_place,
				$class_table_name,
				$lecture_count,
				$day,
                $class_timming[$j-1]                            
				);
                $sql_statement2->execute();/* execution of query */
  
                $sql_statement3=$conn->prepare("
				    UPDATE  ".$teacher_name."_timetable SET 
					col_available = ?,
					col_teacher_name = ?,
					col_lecture_name= ?,
					col_lecture_type= ?,
					col_lecture_place=?,
					col_class_name=?,
					col_row_span =? 
				     WHERE col_day=? AND col_timming = ?");
                
                $sql_statement3->bind_param("isssssiis",
				$available,
				$teacher_name,
				$lecture_name,
				$lecture_type,
				$lecture_place,
				$class_table_name,
				$lecture_count,
				$day,
                $class_timming[$j-1] 
				);
                $sql_statement3->execute();/* execution of query */
                
                if(!empty($lecture_place))
			     {
				    $sql_statement4=$conn->prepare("
				    UPDATE  ".$lecture_place."_timetable SET 
					col_available = ?,
					col_teacher_name = ?,
					col_lecture_name= ?,
					col_lecture_type= ?,
					col_lecture_place=?,
					col_class_name=?,
					col_row_span =? 
				     WHERE col_day=? AND col_timming = ?");
                    
                    $sql_statement4->bind_param("isssssiis",
				    $available,
				    $teacher_name,
				    $lecture_name,
				    $lecture_type,
				    $lecture_place,
				    $class_table_name,
				    $lecture_count,
				    $day,
                    $class_timming[$j-1] 
				    );
                    $sql_statement4->execute();/* execution of query */
			     }
                if($j == 2)
                {
                    $lecture_count=2;
                }
            
            }
            
        }
        else
        {
            if($lecture_area != "fullday_lecture")
            {
                $lecture_not_asign_loop=0;
                $lecture_count_loop_even=0;
                $lecture_count_loop_odd=$lecture_count;
               /* if($lecture_count%2 == 0)
                {
                    $lecture_count_loop_even=$lecture_count/2;
                    $lecture_count_loop_odd=0;
                }
                else
                {
                    if($lecture_count-1 != 0)
                    {
                        $lecture_count=$lecture_count-1;
                        $lecture_count_loop_even=$lecture_count/2;
                        $lecture_count_loop_odd=1;
                    }
                    else
                    {
                        $lecture_count_loop_odd=$lecture_count;
                    }
                      
                }*/
           
            
                if($lecture_count_loop_even != 0)
                {
                    $subject_cheker = 0;
                     for($lecture_count_index=1;$lecture_count_index<=$lecture_count_loop_even;$lecture_count_index++) 
                { 
                    $class_timming_index_1=-1; 
                    $class_timming_index_2=0; 
                    for($per_day_lecture_count_index=$day_wise_id[0];$per_day_lecture_count_index <= $day_wise_id[$class_timming_count-1]+1;$per_day_lecture_count_index++) 
                    { 
                        //$subject_cheker = 1;
                        //setting of col day wise id 
                        //$lecture_id=$per_day_lecture_count_index; //$alternative_lecture_id=$per_day_lecture_count_index+1; 
                        
                        //setting class postion[index] for time 
                        echo "<br><br> ci1 : ".$class_timming_index_1=$class_timming_index_1+1; echo "<br> ci2 : ".$class_timming_index_2=$class_timming_index_2+1; 
                        echo "<br>";
                        //setting all remaing data for odd loop 
                        if($per_day_lecture_count_index > $day_wise_id[$class_timming_count-1])
                        {
                            echo "<br> ol co : ".$lecture_count_loop_odd=$lecture_count_loop_odd+2;
                            echo "<br>";
                            break;
                        }

                        //break if lecture is arrange
                        if(isset($insert_set))
                        {
                            $subject_cheker = 0;
                            unset($insert_set);
                            break;
                        }
                        
                        $day_array=array('0','1','2','3','4','5');
                        shuffle($day_array);

                for($day_index=0;$day_index<6;$day_index++) {
                    
                    //break if lecture is arrange
                            if(isset($insert_set))
                            {
                                $subject_cheker = 0;
                                break;
                            }
                            //
                            if($day < 6)
                            {
                                $day_for_cheking=$day;
                            }
                            else
                            {
                                $day_for_cheking=$day_array[$day_index];
                            }
                            
                            if($closed_day != $day_array[$day_index]) {
                            if($subject_cheker == 0)
                            {
                                /* Extractin  freesolt information from free_solt_detail table in database */
                                echo "<br> q1 : ".$sql_query14="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day_for_cheking."' AND col_lecture_name='".$lecture_name."' AND col_lecture_type='".$lecture_type."' ";
                                $result14=$conn->query($sql_query14);/* execution of query */
                                /* extractinng from free_solt_detail table in database */
                                $data14 = $result14->fetch_array();
                                
                                if(!isset($data14['col_timming']))
                                {
                                    echo "<br> ns : ".$subject_cheker = 1;
                                }
                                else
                                {
                                    echo "<br> s : ".$subject_cheker = 0;
                                }
                            }
                            if($subject_cheker == 1){
                                
                    /* Extractin freesolt information from free_solt_detail table in database */ 
                    echo "<br> q2 : " .$sql_query15="SELECT  *  FROM " .$teacher_name."_timetable WHERE col_day='".$day_for_cheking."' AND col_available='1' AND col_timming='".$class_timming[$class_timming_index_1]."' ";
                    $result15=$conn->query($sql_query15);/* execution of query */
                    /* extractinng from free_solt_detail table in database */
                    $data15 = $result15->fetch_array();
                            
                    /* Extractin  freesolt information from free_solt_detail table in database */
                    echo " <br> q1 : ".$sql_query16="SELECT * FROM ".$teacher_name."_timetable WHERE col_day='".$day_for_cheking."' AND col_available='1' AND col_timming ='".$class_timming[$class_timming_index_2]."' ";
                    $result16=$conn->query($sql_query16);/* execution of query */
                    /* extractinng from free_solt_detail table in database */
                    $data16 = $result16->fetch_array();
                                
                    /* Extractin freesolt information from free_solt_detail table in database */ 
                    echo "<br> q2 : " .$sql_query17="SELECT  *  FROM " .$class_table_name."_timetable WHERE col_day='".$day_for_cheking."' AND col_available='1' AND col_timming='".$class_timming[$class_timming_index_1]."' ";
                    $result17=$conn->query($sql_query17);/* execution of query */
                    /* extractinng from free_solt_detail table in database */
                    $data17 = $result17->fetch_array();
                            
                    /* Extractin  freesolt information from free_solt_detail table in database */
                    echo " <br> q1 : ".$sql_query18="SELECT * FROM ".$class_table_name."_timetable WHERE col_day='".$day_for_cheking."' AND col_available='1' AND col_timming ='".$class_timming[$class_timming_index_2]."' ";
                    $result18=$conn->query($sql_query18);/* execution of query */
                    /* extractinng from free_solt_detail table in database */
                    $data18 = $result18->fetch_array();

                    if(isset($data15['col_timming']) && isset($data16['col_timming']) && isset($data17['col_timming']) && isset($data18['col_timming']))
                    {
                        $insert_set=1;
                        $class_timming_value=$data15['col_timming'];
                        $row_span=2;
                        for($j=1;$j<=$row_span;$j++) { 
                            
                            echo "<br> j : " .$j; 
                            if($j==2) 
                            { 
                                $row_span=3; 
                                $class_timming_value=$data16['col_timming']; 
                            } 
                            $available=0;
                            
                            $sql_statement2=$conn->prepare("
                                UPDATE ".$class_table_name."_timetable SET
                                col_available = ?,
                                col_teacher_name = ?,
                                col_lecture_name= ?,
                                col_lecture_type= ?,
                                col_lecture_place=?,
                                col_class_name=?,
                                col_row_span =?
                                WHERE col_day=? AND col_timming = ?");

                            $sql_statement2->bind_param("isssssiis",
                                $available,
                                $teacher_name,
                                $lecture_name,
                                $lecture_type,
                                $lecture_place,
                                $class_table_name,
                                $row_span,
                                $day_for_cheking,
                                $class_timming_value );
                            $sql_statement2->execute();/* execution of query */

                            $sql_statement3=$conn->prepare("
                                UPDATE ".$teacher_name."_timetable SET
                                col_available = ?,
                                col_teacher_name = ?,
                                col_lecture_name= ?,
                                col_lecture_type= ?,
                                col_lecture_place=?,
                                col_class_name=?,
                                col_row_span =?
                                WHERE col_day=? AND col_timming = ?");

                            $sql_statement3->bind_param("isssssiis",
                                $available,
                                $teacher_name,
                                $lecture_name,
                                $lecture_type,
                                $lecture_place,
                                $class_table_name,
                                $row_span,
                                $day_for_cheking,
                                $class_timming_value );
                            $sql_statement3->execute();/* execution of query */

                            if(!empty($lecture_place))
                            {
                                $sql_statement4=$conn->prepare("
                                    UPDATE ".$lecture_place."_timetable SET
                                    col_available = ?,
                                    col_teacher_name = ?,
                                    col_lecture_name= ?,
                                    col_lecture_type= ?,
                                    col_lecture_place=?,
                                    col_class_name=?,
                                    col_row_span =?
                                    WHERE col_day=? AND col_timming = ?");
                                
                                $sql_statement4->bind_param("isssssiis",
                                    $available,
                                    $teacher_name,
                                    $lecture_name,
                                    $lecture_type,
                                    $lecture_place,
                                    $class_table_name,
                                    $row_span,
                                    $day_for_cheking,
                                    $class_timming_value);  
                                $sql_statement4->execute();/* execution of query */
                            }
                            
                            if($j == 2)
                            {
                                $row_span=2;
                            }
                        }
                        break;
                    }
                    else
                    {
                         echo "<br> sc in teach ns : ".$subject_cheker = 0;
                    }   }
                //for loop day index                     
                }
                    
                   //for loop $per_day_lecture_count_index     
                    }      
                }           
            }
            }
                
                if($lecture_count_loop_odd != 0)
                {
                    if(!isset($perment_subject_cheker_set))
                    {
                        $subject_cheker = 0;
                    }
                for($lecture_count_index=1;$lecture_count_index<=$lecture_count_loop_odd;$lecture_count_index++)
                {
                     $class_timming_index_1=-1;
                     //$class_timming_index_2=0;
                     
                    for($per_day_lecture_count_index=$day_wise_id[0];$per_day_lecture_count_index <= $day_wise_id[$class_timming_count-1]+1;$per_day_lecture_count_index++)
                    {
                        //$subject_cheker = 1;
                        //$day_wise_id=$day_wise_id[$per_day_lecture_count_index];
                        //setting of col day wise id
                        //$lecture_id=$per_day_lecture_count_index;
                        //$alternative_lecture_id=$per_day_lecture_count_index+1;
                        
                        //setting class postion[index] for time
                        echo "<br><br> ci1 odd : ".$class_timming_index_1=$class_timming_index_1+1;
                        echo "<br>";
                        //$class_timming_index_2=$class_timming_index_2+1;
                        
                        //break if lecture is arrange
                        if(isset($insert_set))
                        {
                            if(!isset($perment_subject_cheker_set))
                            {
                                $subject_cheker = 0;
                            }
                            unset($insert_set);
                            break;
                        }
                        
                        
                        /*setting all remaing data for odd loop 
                        if($per_day_lecture_count_index > $day_wise_id[$class_timming_count-1])
                        {
                            echo "<br> ol co : ".$lecture_not_asign_loop=$lecture_not_asign_loop+1;
                            echo "<br>";
                            break;
                        }*/
                        
                        $day_array=array('0','1','2','3','4','5');
                        shuffle($day_array);
                        
                        for($day_index=0;$day_index<6;$day_index++)
                        {
                            //break if lecture is arrange
                            if(isset($insert_set))
                            {
                                if(!isset($perment_subject_cheker_set))
                                {
                                    $subject_cheker = 0;
                                }
                                break;
                            }
                            //
                            if($day < 6)
                            {
                                $day_for_cheking=$day;
                            }
                            else
                            {
                                $day_for_cheking=$day_array[$day_index];
                            }
                            
                            if($closed_day != $day_array[$day_index]) {
                            if($subject_cheker == 0)
                            {
                                /* Extractin  freesolt information from free_solt_detail table in database */
                                echo "<br> q1 odd : ".$sql_query14="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day_for_cheking."' AND col_lecture_name='".$lecture_name."' AND col_lecture_type='".$lecture_type."' ";
                                $result14=$conn->query($sql_query14);/* execution of query */
                                /* extractinng from free_solt_detail table in database */
                                $data14 = $result14->fetch_array();
                                
                                if(!isset($data14['col_timming']))
                                {
                                    echo "<br> ns : ".$subject_cheker = 1;
                                }
                                else
                                {
                                    echo "<br> s : ".$subject_cheker = 0;
                                }
                            }
                            if($subject_cheker == 1){
                                
                            /* Extractin  freesolt information from free_solt_detail table in database */
                            echo "<br> q2 : ".$sql_query15="SELECT  *  FROM ".$teacher_name."_timetable WHERE col_day='".$day_for_cheking."' AND col_available='1' AND col_timming ='".$class_timming[$class_timming_index_1]."' ";
                            $result15=$conn->query($sql_query15);/* execution of query */
                            /* extractinng from free_solt_detail table in database */
                            $data15 = $result15->fetch_array();
                                
                            /* Extractin  freesolt information from free_solt_detail table in database */
                            echo "<br> q2 : ".$sql_query16="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day_for_cheking."' AND col_available='1' AND col_timming ='".$class_timming[$class_timming_index_1]."' ";
                            $result16=$conn->query($sql_query16);/* execution of query */
                            /* extractinng from free_solt_detail table in database */
                            $data16 = $result16->fetch_array();
                            
                   
                            if(isset($data15['col_timming']) && isset($data16['col_timming']))
                            {
                                echo "<br> is : ".$insert_set=1;
                                $class_timming_value=$data15['col_timming'];
                                $row_span=1;
                                /* for($j=1;$j<=$row_span;$j++) { echo "<br> j : " .$j; if($j==2) { $row_span=3; $class_timming_value=$data16['col_timming']; }*/ $available=0; $sql_statement2=$conn->prepare("
                                    UPDATE ".$class_table_name."_timetable SET
                                    col_available = ?,
                                    col_teacher_name = ?,
                                    col_lecture_name= ?,
                                    col_lecture_type= ?,
                                    col_lecture_place=?,
                                    col_class_name=?,
                                    col_row_span =?
                                    WHERE col_day=? AND col_timming = ?");

                                $sql_statement2->bind_param("isssssiis",
                                    $available,
                                    $teacher_name,
                                    $lecture_name,
                                    $lecture_type,
                                    $lecture_place,
                                    $class_table_name,
                                    $row_span,
                                    $day_for_cheking,
                                    $class_timming_value
                                    );
                                $sql_statement2->execute();/* execution of query */

                                $sql_statement3=$conn->prepare("
                                    UPDATE ".$teacher_name."_timetable SET
                                    col_available = ?,
                                    col_teacher_name = ?,
                                    col_lecture_name= ?,
                                    col_lecture_type= ?,
                                    col_lecture_place=?,
                                    col_class_name=?,
                                    col_row_span =?
                                    WHERE col_day=? AND col_timming = ?");

                                $sql_statement3->bind_param("isssssiis",
                                    $available,
                                    $teacher_name,
                                    $lecture_name,
                                    $lecture_type,
                                    $lecture_place,
                                    $class_table_name,
                                    $row_span,
                                    $day_for_cheking,
                                    $class_timming_value
                                    );
                                $sql_statement3->execute();/* execution of query */

                                if(!empty($lecture_place))
                                {
                                    $sql_statement4=$conn->prepare("
                                    UPDATE ".$lecture_place."_timetable SET
                                    col_available = ?,
                                    col_teacher_name = ?,
                                    col_lecture_name= ?,
                                    col_lecture_type= ?,
                                    col_lecture_place=?,
                                    col_class_name=?,
                                    col_row_span =?
                                    WHERE col_day=? AND col_timming = ?");

                                    $sql_statement4->bind_param("isssssiis",
                                    $available,
                                    $teacher_name,
                                    $lecture_name,
                                    $lecture_type,
                                    $lecture_place,
                                    $class_table_name,
                                    $row_span,
                                    $day_for_cheking,
                                    $class_timming_value
                                    );
                                    $sql_statement4->execute();/* execution of query */
                                }
                            }
                            else
                            {
                                if(!isset($perment_subject_cheker_set))
                                {
                                    echo "<br> sc in teach ns odd : ".$subject_cheker = 0;
                                }
                                 
                            }}
                            }
                        }
                        
                        if($per_day_lecture_count_index == $day_wise_id[$class_timming_count-1] && !isset($perment_subject_cheker_set))
                        {
                            $per_day_lecture_count_index=$day_wise_id[0];
                            $perment_subject_cheker_set="1";
                            $subject_cheker = 1;
                            $class_timming_index_1=-1; 
                        }
                 }
                 }
                 }
            }
            
            if($lecture_area == "fullday_lecture")
            {
                for($j=0;$j<$class_timming_count;$j++)
                {
                    /* Extractin  freesolt information from free_solt_detail table in database */
                    echo "<br> q2 : ".$sql_query15="SELECT  *  FROM ".$teacher_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$class_timming[$j]."' ";
                    $result15=$conn->query($sql_query15);/* execution of query */
                    /* extractinng from free_solt_detail table in database */
                    $data15 = $result15->fetch_array();
                                
                    /* Extractin  freesolt information from free_solt_detail table in database */
                    echo "<br> q2 : ".$sql_query16="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$class_timming[$j]."' ";
                    $result16=$conn->query($sql_query16);/* execution of query */
                    /* extractinng from free_solt_detail table in database */
                    $data16 = $result16->fetch_array();
                            
                   
                    if(isset($data15['col_timming']) && isset($data16['col_timming']))
                    {
                                echo "<br> is : ".$insert_set=1;
                                $class_timming_value=$data15['col_timming'];
                                $row_span=1;
                                /* for($j=1;$j<=$row_span;$j++) { echo "<br> j : " .$j; if($j==2) { $row_span=3; $class_timming_value=$data16['col_timming']; }*/ $available=0; $sql_statement2=$conn->prepare("
                                    UPDATE ".$class_table_name."_timetable SET
                                    col_available = ?,
                                    col_teacher_name = ?,
                                    col_lecture_name= ?,
                                    col_lecture_type= ?,
                                    col_lecture_place=?,
                                    col_class_name=?,
                                    col_row_span =?
                                    WHERE col_day=? AND col_timming = ?");

                                $sql_statement2->bind_param("isssssiis",
                                    $available,
                                    $teacher_name,
                                    $lecture_name,
                                    $lecture_type,
                                    $lecture_place,
                                    $class_table_name,
                                    $row_span,
                                    $day,
                                    $class_timming_value
                                    );
                                $sql_statement2->execute();/* execution of query */

                                $sql_statement3=$conn->prepare("
                                    UPDATE ".$teacher_name."_timetable SET
                                    col_available = ?,
                                    col_teacher_name = ?,
                                    col_lecture_name= ?,
                                    col_lecture_type= ?,
                                    col_lecture_place=?,
                                    col_class_name=?,
                                    col_row_span =?
                                    WHERE col_day=? AND col_timming = ?");

                                $sql_statement3->bind_param("isssssiis",
                                    $available,
                                    $teacher_name,
                                    $lecture_name,
                                    $lecture_type,
                                    $lecture_place,
                                    $class_table_name,
                                    $row_span,
                                    $day,
                                    $class_timming_value
                                    );
                                $sql_statement3->execute();/* execution of query */

                                if(!empty($lecture_place))
                                {
                                    $sql_statement4=$conn->prepare("
                                    UPDATE ".$lecture_place."_timetable SET
                                    col_available = ?,
                                    col_teacher_name = ?,
                                    col_lecture_name= ?,
                                    col_lecture_type= ?,
                                    col_lecture_place=?,
                                    col_class_name=?,
                                    col_row_span =?
                                    WHERE col_day=? AND col_timming = ?");

                                    $sql_statement4->bind_param("isssssiis",
                                    $available,
                                    $teacher_name,
                                    $lecture_name,
                                    $lecture_type,
                                    $lecture_place,
                                    $class_table_name,
                                    $row_span,
                                    $day,
                                    $class_timming_value
                                    );
                                    $sql_statement4->execute();/* execution of query */
                                }
                            }
                        }
                }
        }    
        
    }
}

//diplaying timetable
if(isset($_POST['display_class_name']))
{
    $class_table_name=htmlspecialchars($_POST['display_class_name']);
    
    /* Finding class_time_detail table in database */
	$sql_query1="SELECT * FROM ".$class_table_name."_time_detail";
	$result1=$conn->query($sql_query1);/* execution of query */
    /* extractinng class_time_detail table in database */
    $data1 = $result1->fetch_array();
        
    if($data1['col_holiday'] != 0)
    {
        $closed_day = $data1['col_closed_day'];
    }
    else
    {
        $closed_day = 6;
    } 
    
    $day_array=array('Monday','Tuesday','Wensday','Thursday','Friday','Saturday');
                        
    ?>
 <table border="2px" width="100%">
        <tr>
            <th>Time</th>
            <?php
                $day_col_count=0;
                $day=" ";
                for($a = 0; $a < 6; $a++)
                {
                    if($closed_day != $a)
                    {
                        //total day count for class timetable 
                        $day_col_count=$day_col_count+1;
                        //variable for removing time of per day from class time table 
                        if($day == " ")
                        {
                            $day=$a;
                        }
                        
                        //echo subject name as per user defined
                        echo '<th>'.$day_array[$a].'</th>';
                    }
                }
            ?>
     </tr>
    <?php
    //removing time details from class timetable
    $sql_query2="SELECT * FROM ".$class_table_name."_timetable WHERE col_day=".$day."";
    $result2=$conn->query($sql_query2);/* execution of query */
    /* extractinng class_time_detail table in database */
    while($data2 = $result2->fetch_array())
    {
        $timming[]=$data2['col_timming'];
    }
    
   $timming_count=count($timming);
    $recess_set=0;
    $lecture_type_array=array('(TH)','(PR)','(EA)');
    
    $first_arry_index=htmlspecialchars($_POST["first_arry_index"]);
    $avilable_solt=$_SESSION["avilable_solt"][$first_arry_index]; 
    $avilable_solt_count=count($_SESSION["avilable_solt"][$first_arry_index]); 
    
     for($b = 0; $b < $timming_count; $b++)
    {
         unset($srno,$day_wise_id,$class_available,$timming_id,$teacher_name,$lecture_name,$lecture_type,$lecture_place,$row_span);
            
         //removing data of every day as per time solt
            $sql_query3="SELECT * FROM ".$class_table_name."_timetable WHERE col_timming='".$timming[$b]."' ";
	        $result3=$conn->query($sql_query3);/* execution of query */
    
            /* extractinng class_time_detail table in database */
            while($data3 = $result3->fetch_array())
            {
                $srno[]           = $data3['srno'];
                $day_wise_id[]    = $data3['col_day_wise_id'];
                $class_available[]    = $data3['col_available'];
                $timming_id[]     = $data3['col_timming_id'];
                $teacher_name[]   = $data3['col_teacher_name'];
                $lecture_name[]   = $data3['col_lecture_name'];
                $lecture_type[]   = $data3['col_lecture_type'];
                $lecture_place[]  = $data3['col_lecture_place'];
                $row_span[]       = $data3['col_row_span'];
                
            }
            
                echo '<tr>
                            <td>'.$timming[$b].'</td>';
                    for($c=0;$c<$day_col_count;$c++)
                    {
                        if(isset($day_wise_id[$c]))
                        {
                            unset($avilable_solt_set,$teacher_name_set);
                            if($day_wise_id[$c] != 0)
                            {
                                if(isset($teacher_name[$c]))
                                {
                                    if($class_available[$c] != 1)
                                    {
                                /*  if($row_span[$c] == 2)
                                    {
                                        echo "<td rowspan='2'>id : ".$srno[$c]." & ".$srno[$c]+1;
                                        echo "<br>teacher name : ".$teacher_name[$c];
                                        echo "<br>lecture name : ".$lecture_name[$c]." ".$lecture_type_array[$lecture_type[$c]];
                                    
                                        if(isset($lecture_place[$c]))
                                        {
                                            echo "<br>lecture place : ".$lecture_place[$c]."</td>";
                                        }
                                        else
                                        {
                                            echo "</td>";
                                        }
                                
                                    }
                                    if($row_span[$c] == 1)
                                    {
                                        echo "<td>id : ".$srno[$c];
                                        echo "<br>teacher name : ".$teacher_name[$c];
                                        echo "<br>lecture name : ".$lecture_name[$c]." ".$lecture_type_array[$lecture_type[$c]];
                                        if(isset($lecture_place[$c]))
                                        {
                                            echo "<br>lecture place : ".$lecture_place[$c]."</td>";
                                        }
                                        else
                                        {
                                            echo "</td>";
                                        }   
                                    }*/
                                        for($d=0;$d<$avilable_solt_count;$d++)
                                        {
                                            if($timming_id[$c] == $avilable_solt[$d])
                                            {
                                                $avilable_solt_set=1;
                                                echo "<td style='color:white;background-color:Blue;' >";
                                                break;
                                            }
                                        }
                                
                                        if(!isset($avilable_solt_set))
                                        {
                                            echo "<td>";
                                        }
                                
                                        echo "id : ".$srno[$c];
                                        echo "<br>teacher name : ".$teacher_name[$c];
                                        echo "<br>lecture name : ".$lecture_name[$c]." ".$lecture_type_array[$lecture_type[$c]];
                                    
                                        if(isset($lecture_place[$c]))
                                        {
                                            echo "<br>lecture place : ".$lecture_place[$c]."</td>";
                                        }
                                        else
                                        {
                                            echo "</td>";
                                        }
                                    }
                                    else
                                    {
                                        $teacher_name_set=1;
                                    }
                                }
                                
                                if(!isset($teacher_name[$c]) || isset($teacher_name_set))
                                {
                                    for($d=0;$d<$avilable_solt_count;$d++)
                                    {
                                        if($timming_id[$c] == $avilable_solt[$d])
                                        {
                                            $avilable_solt_set=1;
                                            echo "<td style='color:white;background-color:Blue;' >";
                                        }
                                    }
                                
                                    if(!isset($avilable_solt_set))
                                    {
                                        echo "<td style='color:red;'>";
                                    }
                                    
                                    echo "id : ".$srno[$c];
                                    echo "<br>teacher name : -----";
                                    echo "<br>lecture name : ----- ";
                                    echo "<br>lecture place : ----- </td>";
                                }
                            }
                            else
                            {
                          
                                if($recess_set == 0)
                                {
                                    $recess_set=1;
                                    echo "<td colspan='".$day_col_count."'>Recess</td>";
                                }
                            }
                        }
                    }
                echo '
                    </tr>
                ';
    } 
    echo '
     </table>
           ';
  $_SESSION["avilable_solt"][0]=array(1);
}

if(isset($_POST['back']))
{
    header("Location:index.php");
}
?>