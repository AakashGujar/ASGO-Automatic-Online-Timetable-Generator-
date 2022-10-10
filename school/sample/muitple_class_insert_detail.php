<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection to database
include('user_connection.php');

//function for inserting data
function insert_data($teacher_name,$lecture_name,$lecture_type,$lecture_place,$class_table_name,$row_span,$day,$timming,$conn,$subject_color)
{
    $available=0;
    $sql_statement2=$conn->prepare("
				    UPDATE ".$class_table_name."_timetable SET 
					col_available = ?,
					col_teacher_name = ?,
					col_lecture_name= ?,
					col_lecture_type= ?,
					col_lecture_place=?,
					col_class_name=?,
					col_row_span =? ,
					col_batch =? 
				     WHERE col_day=? AND col_timming = ?");
                
    $sql_statement2->bind_param("isssssisis",
				$available,
				$teacher_name,
				$lecture_name,
				$lecture_type,
				$lecture_place,
				$class_table_name,
				$row_span,
                $subject_color,
				$day,
                $timming                            
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
					col_row_span =? ,
					col_batch =? 
				     WHERE col_day=? AND col_timming = ?");
                
    $sql_statement3->bind_param("isssssisis",
				$available,
				$teacher_name,
				$lecture_name,
				$lecture_type,
				$lecture_place,
				$class_table_name,
				$row_span,
				$subject_color,
				$day,
                $timming
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
					col_row_span =? ,
					col_batch =? 
				     WHERE col_day=? AND col_timming = ?");
                    
        $sql_statement4->bind_param("isssssisis",
				    $available,
				    $teacher_name,
				    $lecture_name,
				    $lecture_type,
				    $lecture_place,
				    $class_table_name,
				    $row_span,
				    $subject_color,
				    $day,
                    $timming 
				    );
        $sql_statement4->execute();/* execution of query */
    }
    return $insert_set = 1;
}

//funcing for checking lecture on empty slot day
function check_free_solt($conn,$check_srno,$class_table_name,$lecture_name,$free_day)
{
    /* Finding free solt in  timetable table in database */
    echo $sql_query70="SELECT * FROM ".$class_table_name."_timetable WHERE col_lecture_name='".$lecture_name."' AND srno='".$check_srno."' AND col_day='".$free_day."'";
    $result70=$conn->query($sql_query70);/* execution of query */
    $data70 = $result70->fetch_array();
    if(isset($data70))
    {
        echo "new free solt no :".$data70['srno'];
            
            return $reject=0;
    }
    else
    {
        return $reject=1; 
    }
}

//inserting data in timetable table of all class,teacher,lecture,etc 
if(isset($_POST['insert_all_class_time_detail']))
{
    $class_name=array('5a','5b','6a','6b','7a','7b','8a','8b','9a','9b','10a','10b');
    //$class_name=array('5a','5b','6a','6b','7a','7b');
    $subject_detail_table="subject_detail_1";
    //$class_name=array('8a','8b','9a','9b','10a','10b');
    //$subject_detail_table="subject_detail_2";
    
    /* Finding  subject detail table in database */
	$sql_query1="SELECT * FROM ".$subject_detail_table.""; 
	$result1=$conn->query($sql_query1);/* execution of query */
	if(empty($result1))
	{
        echo "not declare";
    }
    else
    {  
        $subject_detail_count=$result1->num_rows;
        /* extractinng from free_solt_detail table in database */
        while($subject_detail_data = $result1->fetch_array())
        {
            $subject_lecture_area[] =$subject_detail_data['col_lecture_area'];
            $subject_teacher_name[] = $subject_detail_data['col_teacher_name'];
            $subject_lecture_name[] = $subject_detail_data['col_lecture_name'];
            $subject_lecture_type[] = $subject_detail_data['col_lecture_type'];
            $subject_table_lecture_count[] = $subject_detail_data['col_lecture_count'];
            $subject_table_color[] = $subject_detail_data['col_lecture_set'];
            if(isset($subject_detail_data['col_lecture_place']))
            {
                $subject_lecture_place[] = $subject_detail_data['col_lecture_place'];  
            }
            else
            {
                $subject_lecture_place[]=null;
            }
        }
        //truncate class,teacher,lecture place table
        for($class_name_index=0;$class_name_index<1;$class_name_index++)
        {
            $class_table_name=$class_name[$class_name_index];
            /* Finding teacher/class timetable table in database */
            $sql_query2="SELECT col_teacher_name,col_lecture_place,col_class_name FROM ".$class_table_name."_timetable "; 
            $result2=$conn->query($sql_query2);/* execution of query */
	    
            if(!empty($result2))
	       {
                while($data2 = $result2->fetch_array())
                {
                    if(isset($data2['col_teacher_name']))
                    {
                        //updating odd placde teacher timetable
                        $sql_query3="UPDATE ".$data2['col_teacher_name']."_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_class_name='".$data2['col_class_name']."'";
                        $conn->query($sql_query3);/* execution of query */
                    }
                
                    if(isset($data2['col_lecture_place']))
                    {
                        //updating odd placde teacher timetable
                        $sql_query4="UPDATE ".$data2['col_lecture_place']."_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_class_name='".$data2['col_class_name']."'";
                        $conn->query($sql_query4);/* execution of query */
                    }
                
                    //updating odd placde teacher timetable
                    $sql_query5="UPDATE ".$data2['col_class_name']."_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_class_name='".$data2['col_class_name']."'";
                    $conn->query($sql_query5);/* execution of query */
                }
            }
        }
        
        for($class_name_index=0;$class_name_index<1;$class_name_index++)
        {
             unset($first_lecture, $first_lecture_set, $daily_lecture_array, $daily_lecture_array1, $daily_lecture_array_even, $daily_lecture_array_even_set);
             $first_lecture_set="";
             $class_table_name=$class_name[$class_name_index];
 
            /* Finding teacher/class timetable table in database */
            $sql_query6="SELECT * FROM ".$class_table_name."_timetable"; 
            $result6=$conn->query($sql_query6);/* execution of query */ 
            /* extractinng from free_solt_detail table in database */
            while($data6 = $result6->fetch_array())
            {
                $class_lecture_area[]=$data6['col_lecture_area'];
                $class_timming[]=$data6['col_timming'];
                $class_available[]=$data6['col_available'];
                $class_day[]=$data6['col_day'];
                $day_wise_id[]=$data6['col_day_wise_id'];
            }
            
            $class_timming_count=$result6->num_rows;
            
            echo "<br>".$class_table_name;
            $sql_query7="SELECT * FROM ".$class_table_name."_time_detail";
	        $result7=$conn->query($sql_query7);/* execution of query */
            /* extractinng class_time_detail table in database */
            $time_detail_data = $result7->fetch_array();

            if(isset($time_detail_data)) 
            {
                if($time_detail_data['col_holiday'] != 0)
                {
                    $closed_day = $time_detail_data['col_closed_day'];
                }
                else
                {
                    $closed_day = 6;
                }
            }
            for($subject_detail_index = 0; $subject_detail_index < $subject_detail_count; $subject_detail_index++)
            {
                unset($perment_subject_cheker_set,$subject_lecture_index,$row_span_set,$insert_set);
                $lecture_area = $subject_lecture_area[$subject_detail_index];
                $teacher_name = $subject_teacher_name[$subject_detail_index];
                $lecture_name = $subject_lecture_name[$subject_detail_index];
                $lecture_type = $subject_lecture_type[$subject_detail_index]; 
                $lecture_place = $subject_lecture_place[$subject_detail_index]; 
                $subject_color = $subject_table_color[$subject_detail_index]; 
                $subject_lecture_count = $subject_table_lecture_count[$subject_detail_index];
                
                if(!isset($first_solt_set) && $lecture_type == 0)
                {
                    $first_solt_lecture_area[]=$lecture_area;
                    $first_solt_teacher_name[]=$teacher_name;
                    $first_solt_teacher_lecture_name[]=$lecture_name;
                    $first_solt_teacher_lecture_type[]=$lecture_type;
                    $first_solt_teacher_lecture_place[]=$lecture_place;
                    $first_solt_teacher_lecture_color[]=$subject_color;
                    $first_solt_teacher_lecture_count[]=$subject_lecture_count;
                    
                    if($subject_detail_index == ($subject_detail_count-1))
                    {
                        $first_solt_set=1;
                    }
                }
                 
                $daily_lecture_array = range("0",$time_detail_data['col_daily_lecture_count']); 
                $daily_lecture_count=count($daily_lecture_array);
                $daily_lecture_array1 = range("1",$time_detail_data['col_daily_lecture_count']); 
                        
                for($daily_lecture_array_index = 0; $daily_lecture_array_index < $daily_lecture_count; $daily_lecture_array_index++)
                {
                    if($daily_lecture_array_index == ($daily_lecture_count-1))
                    {
                        $daily_lecture_array_even_set=1;
                        break;
                    }
                    if(isset($daily_lecture_array_even_set))
                    {  
                        break;
                    }
                    $daily_lecture_array_even[] = array($daily_lecture_array[$daily_lecture_array_index],$daily_lecture_array1[$daily_lecture_array_index]);
                    
                    $daily_set_lecture_array[] = array($daily_lecture_array[$daily_lecture_array_index],$daily_lecture_array1[$daily_lecture_array_index]);
                    
                    $daily_set_lecture_array[] = array($daily_lecture_array1[$daily_lecture_array_index],$daily_lecture_array[$daily_lecture_array_index]);
                    
                    
                    $daily_lecture_count_even=count($daily_lecture_array_even);
                    
                    $daily_set_lecture_count=count($daily_set_lecture_array);
                }
                
               
                if(!isset($first_lecture) && $lecture_type == 0)
                {
                    $temp_lecture_area = $lecture_area;
                    $temp_teacher_name = $teacher_name;
                    $temp_lecture_name = $lecture_name;
                    $temp_lecture_type = $lecture_type;
                    $temp_lecture_place = $lecture_place;
                    $temp_subject_lecture_count = $subject_lecture_count;
                    $temp_subject_color = $subject_color;

                    $first_lecture=1;
                    $lecture_area = array_shift($first_solt_lecture_area);
                    $teacher_name = array_shift($first_solt_teacher_name);
                    $lecture_name = array_shift($first_solt_teacher_lecture_name);
                    $lecture_type = array_shift($first_solt_teacher_lecture_type);
                    $lecture_place = array_shift($first_solt_teacher_lecture_place);
                    $subject_lecture_count = array_shift($first_solt_teacher_lecture_count);
                    $subject_color = array_shift($first_solt_teacher_lecture_color);
                    $first_lecture_set=$teacher_name;
                
                    for($subject_lecture_index = 0; $subject_lecture_index < $subject_lecture_count; $subject_lecture_index++) 
                    {
                        //shuffle($daily_lecture_array);
                        for($daily_lecture_index = 0; $daily_lecture_index < 2; $daily_lecture_index++)
                        {
                           $timming = $class_timming[$daily_lecture_array[$daily_lecture_index]];
                            $day_array=array('0','1','2','3','4','5');
                            //shuffle($day_array);
                            if($daily_lecture_index == 1)
                            {
                                $row_span = 2;
                            }
                            else
                            {
                                $row_span = 1;
                            }
                            
                            if(isset($insert_set))
                            {
                                unset($insert_set);
                                break;
                            }
                            
                            $day_array=array('0','1','2','3','4','5');
                            shuffle($day_array);
                   
                            for($day_index=0;$day_index<6;$day_index++) 
                            {
                                
                                $day=$day_array[$day_index];
                                
                                /* Extractin  freesolt information from free_solt_detail table in database */
                                $sql_query9="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming."' ";
                                $result9=$conn->query($sql_query9);/* execution of query */
                                /* extractinng from free_solt_detail table in database */
                                $data9 = $result9->fetch_array();
                                
                                /* Extractin  freesolt information from free_solt_detail table in database */
                                $sql_query10="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming."' ";
                                $result10=$conn->query($sql_query10);/* execution of query */
                                /* extractinng from free_solt_detail table in database */
                                $data10 = $result10->fetch_array();
                                
                                if(isset($data9['col_timming']) && isset($data10['col_timming']))
                                {
                                    if(!empty($lecture_place))
                                    {
                                        /* Extractin  freesolt information from free_solt_detail table in database */
                                        $sql_query17="SELECT  *  FROM ".$lecture_place."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming."' ";
                                        $result17=$conn->query($sql_query17);/* execution of query */
                                        /* extractinng from free_solt_detail table in database */
                                        $data17 = $result17->fetch_array();
                                        $data17_count=$result17->num_rows;        
                                    }
                                    else
                                    {
                                        $place_not_set=1;
                                    }
                                    
                                    if(isset($data17['col_timming']) || isset($place_not_set)) 
                                    {
                                        $insert_set =   insert_data($teacher_name,$lecture_name,$lecture_type,$lecture_place,$class_table_name,$row_span,$day,$timming,$conn,$subject_color);
                                    
                                        break;
                                    }////if of place data present check
                                
                                }//if of data present check
                            }//for loop day
                        }//for loop daily lecture count
                        
                        if($subject_lecture_index == ($subject_lecture_count-1))
                        {
                            /* Extractin  freesolt information from free_solt_detail table in database */
                            $sql_query8="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_available='1' AND col_timming ='".$class_timming[$daily_lecture_array[0]]."' ";
                            $result8=$conn->query($sql_query8);/* execution of query */
                            /* extractinng from free_solt_detail table in database */
                            $data8 = $result8->fetch_array();
                            $remmaning_solt=$result8->num_rows;
                            
                            if(isset($data8['col_timming']) && $remmaning_solt > 0 && isset($first_solt_teacher_name[0]) && $lecture_type == 0)
                            {
                                $lecture_area=$first_solt_lecture_area[0];
                                $teacher_name=$first_solt_teacher_name[0];
                                $lecture_name=$first_solt_teacher_lecture_name[0];
                                $lecture_type=$first_solt_teacher_lecture_type[0];
                                $lecture_place=$first_solt_teacher_lecture_place[0];
                                $subject_color=$first_solt_teacher_lecture_color[0];
                                $subject_lecture_count =$remmaning_solt;
                                $first_solt_teacher_lecture_count[0] = $first_solt_teacher_lecture_count[0]-$remmaning_solt;
                                $subject_lecture_index=-1;
                            }
                        }//if of remmaning lecture checker on slot 1;
                        
                    }//for loop lecture
                    
                    $lecture_area = $temp_lecture_area;
                    $teacher_name = $temp_teacher_name;
                    $lecture_name = $temp_lecture_name;
                    $lecture_type = $temp_lecture_type;
                    $lecture_place = $temp_lecture_place;
                    $subject_lecture_count = $temp_subject_lecture_count;
                    $subject_color = $temp_subject_color;
                }//first lecture area (class teacher)
                
                if($lecture_area == "fullday_lecture")
                {
                    for($day_index=0;$day_index<6;$day_index++) 
                    {
                        $day=$day_index;
                        /* Extractin  freesolt information from free_solt_detail table in database */
                        echo "<br> q1 : ".$sql_query15="SELECT  *  FROM ".$teacher_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_day_wise_id NOT IN('0','1')";
                        $result15=$conn->query($sql_query15);/* execution of query */
                        /* extractinng from free_solt_detail table in database */
                        $data15 = $result15->fetch_array();
                         echo "<br> count q1 : ".$data15_count=$result15->num_rows;        
                        /* Extractin  freesolt information from free_solt_detail table in database */
                        echo "<br> q2 : ".$sql_query16="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_day_wise_id NOT IN('0','1')";
                        $result16=$conn->query($sql_query16);/* execution of query */
                        /* extractinng from free_solt_detail table in database */
                        $data16 = $result16->fetch_array();
                         echo "<br> count q2 : ".$data16_count=$result16->num_rows;    
                   
                        if(isset($data15['col_timming']) && isset($data16['col_timming']))
                        {
                            echo "<br>verfied teach and class";
                            if($data15_count >= $subject_lecture_count && $data16_count >= $subject_lecture_count)
                            {
                                echo "<br>verfied teach and class count";
                                if(!empty($lecture_place))
                                {
                                    /* Extractin  freesolt information from free_solt_detail table in database */
                                    echo "<br> q3 : ".$sql_query17="SELECT  *  FROM ".$lecture_place."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_day_wise_id NOT IN('0','1')";
                                    $result17=$conn->query($sql_query17);/* execution of query */
                                    /* extractinng from free_solt_detail table in database */
                                    $data17 = $result17->fetch_array();
                                     echo "<br> count q3 : ".$data17_count=$result17->num_rows; 
                                }
                                else
                                {
                                    $place_not_set=1;
                                    $data17_count=0;
                                }
                                
                                if(isset($data17['col_timming']) || isset($place_not_set)) 
                                {
                                    echo "<br>verfied lab";
                                    if(isset($data17['col_timming']))
                                    {
                                        while($data17 = $result17->fetch_array())
                                        {
                                            $timming_array_temp[]=$data17['col_timming'];
                                        }  
                                    }
                                    else
                                    {
                                       while($data15 = $result15->fetch_array())
                                        {
                                            $timming_array_temp[]=$data15['col_timming'];
                                        }   
                                    }
                                    print_r($timming_array_temp);
                                    if($data17_count >= $subject_lecture_count || isset($place_not_set))
                                    {
                                        echo "<br>verfied lab count";
                                        for($subject_lecture_index = 0; $subject_lecture_index < $subject_lecture_count; $subject_lecture_index++) 
                                        {
                                            $timming = $timming_array_temp[$subject_lecture_index];
                                            $row_span=$subject_lecture_count;
                                            if(isset($row_span_set))
                                            {
                                                $row_span=2;
                                            }
                                           $insert_set = insert_data($teacher_name, $lecture_name, $lecture_type, $lecture_place, $class_table_name, $row_span, $day, $timming, $conn, $subject_color);
                                        }//for loop lecture
                                        if(isset($insert_set))
                                        {
                                            break;
                                        }
                                    }//if for subject count vervied
                                }//if of place teacher free
                            }//if for subject count vervied
                        }//if of virfied teacher free
                    }//for loop day
                }//if of fullday lecture
                
                if($lecture_area != "fullday_lecture" && $lecture_area != "set_lecture" && $first_lecture_set != $teacher_name)
                {
                    unset($perment_subject_cheker_set,$subject_lecture_index,$row_span_set,$insert_set);
                    
                    $exchange_loop=0;
                    $lecture_count_loop_even=0;
                    $lecture_count_loop_odd=0;
                    if($lecture_type == 0)
                    {
                        $lecture_count_loop_odd=$subject_lecture_count;
                    }
                    else
                    {
                        array_reverse($daily_lecture_array_even);
                    }
                    
                    if($subject_lecture_count%2 == 0 && ($lecture_type != 0 || $subject_lecture_count == 2))
                    {
                        $lecture_count_loop_even=$subject_lecture_count/2;
                        $lecture_count_loop_odd=0;   
                    }
                    else if($lecture_type != 0)
                    {
                        if($subject_lecture_count-1 != 0)
                        {
                            $subject_lecture_count=$subject_lecture_count-1;
                            $lecture_count_loop_even=$subject_lecture_count/2;
                            $lecture_count_loop_odd=1;
                        }
                        else
                        {
                            $lecture_count_loop_odd=1;
                        }
                    }
                    
                    if($lecture_count_loop_even != 0)
                    {
                        $subject_cheker = 0;
                        
                        for($subject_lecture_index = 0; $subject_lecture_index < $lecture_count_loop_even; $subject_lecture_index++) 
                        {
                            //shuffle($daily_lecture_array_even);
                            for($daily_lecture_index = 0; $daily_lecture_index <= $daily_lecture_count_even; $daily_lecture_index++)
                            {
                               
                                //break if lecture is arrange
                                if(isset($insert_set))
                                {
                                    $subject_cheker = 0;
                                    unset($insert_set);
                                    break;
                                }
                                
                                 //setting all remaing data for odd loop 
                                if($daily_lecture_index == $daily_lecture_count_even)
                                {
                                    $lecture_count_loop_odd=$lecture_count_loop_odd+2;
                                    break;
                                }   
                                if($class_timming[$daily_lecture_array_even[$daily_lecture_index][0]] == $class_timming[0])
                                {
                                    $daily_lecture_index=$daily_lecture_index+1;
                                }
                                
                                $timming_1 = $class_timming[$daily_lecture_array_even[$daily_lecture_index][0]];
                                
                                $timming_2 = $class_timming[$daily_lecture_array_even[$daily_lecture_index][1]];
                                
                                $lecture_area_1 = $class_lecture_area[$daily_lecture_array_even[$daily_lecture_index][0]];
                                
                                 $lecture_area_2 = $class_lecture_area[$daily_lecture_array_even[$daily_lecture_index][1]];
                                
                                if($lecture_area != "all_area_lecture")
                                {
                                   if($lecture_area != $lecture_area_1 || $lecture_area != $lecture_area_2)
                                   {
                                        continue;
                                   }
                                }
                                $day_array=array('0','1','2','3','4','5');
                                shuffle($day_array);
                   
                                for($day_index=0;$day_index<6;$day_index++) 
                                {
                                    //break if lecture is arrange
                                    if(isset($insert_set))
                                    {
                                        $subject_cheker = 0;
                                        break;
                                    }
                                    
                                    $day=$day_array[$day_index];
                                    
                                    if($closed_day != $day_array[$day_index])
                                    {
                                        if($subject_cheker == 0)
                                        {
                                            /* Extractin  freesolt information from free_solt_detail table in database */
                                            $sql_query14="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_lecture_name='".$lecture_name."' AND col_lecture_type='".$lecture_type."' ";
                                            $result14=$conn->query($sql_query14);/* execution of query */
                                            /* extractinng from free_solt_detail table in database */
                                            $data14 = $result14->fetch_array();
                                                
                                            if(!isset($data14['col_timming']))
                                            {
                                                /* Extractin  freesolt information from free_solt_detail table in database */
                                                $sql_query15="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_lecture_type='".$lecture_type."' ";
                                                $result15=$conn->query($sql_query15);/* execution of query */
                                                /* extractinng from free_solt_detail table in database */
                                                $data15 = $result15->fetch_array();
                                                if(!isset($data15['col_timming']) || $lecture_type == 0)
                                                {
                                                    $subject_cheker = 1;
                                                }
                                                else
                                                {
                                                    $subject_cheker = 0;
                                                }
                                            }
                                            else
                                            {
                                                $subject_cheker = 0; 
                                            }
                                         }//subject checker 0 if
                                        
                                        if($subject_cheker == 1)
                                        {
                                
                                            /* Extractin freesolt information from free_solt_detail table in database */ 
                                            $sql_query15="SELECT  *  FROM " .$teacher_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming='".$timming_1."' ";
                                            $result15=$conn->query($sql_query15);/* execution of query */
                                            /* extractinng from free_solt_detail table in database */
                                            $data15 = $result15->fetch_array();
                            
                                            /* Extractin  freesolt information from free_solt_detail table in database */
                                            $sql_query16="SELECT * FROM ".$teacher_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming_2."' ";
                                            $result16=$conn->query($sql_query16);/* execution of query */
                                            /* extractinng from free_solt_detail table in database */
                                            $data16 = $result16->fetch_array();
                                
                                            /* Extractin freesolt information from free_solt_detail table in database */ 
                                             $sql_query17="SELECT  *  FROM " .$class_table_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming='".$timming_1."' ";
                                             $result17=$conn->query($sql_query17);/* execution of query */
                                             /* extractinng from free_solt_detail table in database */
                                             $data17 = $result17->fetch_array();
                            
                                             /* Extractin  freesolt information from free_solt_detail table in database */
                                             $sql_query18="SELECT * FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming_2."' ";
                                             $result18=$conn->query($sql_query18);/* execution of query */
                                             /* extractinng from free_solt_detail table in database */
                                             $data18 = $result18->fetch_array();

                                             if(isset($data15['col_timming']) && isset($data16['col_timming']) && isset($data17['col_timming']) && isset($data18['col_timming']))
                                             {
                                                 if(!empty($lecture_place))
                                                 {
                                                     /* Extractin  freesolt information from free_solt_detail table in database */
                                                     $sql_query17="SELECT  *  FROM ".$lecture_place."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming_1."' ";
                                                     $result17=$conn->query($sql_query17);/* execution of query */
                                                     /* extractinng from free_solt_detail table in database */
                                                     $data17 = $result17->fetch_array();
                                                     
                                                     /* Extractin  freesolt information from free_solt_detail table in database */
                                                     $sql_query19="SELECT  *  FROM ".$lecture_place."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming_2."' ";
                                                     $result19=$conn->query($sql_query19);/* execution of query */
                                                     /* extractinng from free_solt_detail table in database */
                                                     $data19 = $result19->fetch_array();
                                                 }
                                                 else
                                                 {
                                                     $place_not_set=1;
                                                 }
                                                if((isset($data17['col_timming']) && isset($data19['col_timming'])) || isset($place_not_set))    
                                                {
                                                    unset($place_not_set);
                                                    $insert_set=1;
                                                    for($i = 0; $i < 2; $i++)
                                                    {
                                                        if($i == 1)
                                                        {
                                                            $row_span = 3;
                                                            $timming =$timming_2;
                                                            $insert_set = insert_data($teacher_name,$lecture_name,$lecture_type,$lecture_place,$class_table_name,$row_span,$day,$timming,$conn,$subject_color);
                                                        }
                                                        else
                                                        {
                                                            $row_span = 2;
                                                            $timming = $timming_1;
                                                            $insert_set = insert_data($teacher_name,$lecture_name,$lecture_type,$lecture_place,$class_table_name,$row_span,$day,$timming,$conn,$subject_color);
                                                        } 
                                                    }//for loop of insert subject 
                                                }//if of place virfied free
                                                else
                                                {
                                                    $subject_cheker = 0;
                                                } 
                                             }//if of virfied teacher free
                                             else
                                             {
                                                 $subject_cheker = 0;
                                             } 
                                        }//if of subject checker 1
                                    }//if of close day
                                }//for loop day
                            }//for loop daily lecture count
                        }//for loop lecture
                    }//even subject if
                    
                    if($lecture_count_loop_odd != 0)
                    {
                        $subject_cheker = 0;
                    
                        for($subject_lecture_index = 0; $subject_lecture_index < $lecture_count_loop_odd; $subject_lecture_index++) 
                        {
                            shuffle($daily_lecture_array);
                            
                            for($daily_lecture_index = 0; $daily_lecture_index <= $daily_lecture_count; $daily_lecture_index++)
                            {
                                
                                //setting all remaing data for exchange loop 
                                if($daily_lecture_index == $daily_lecture_count)
                                {
                                   $exchange_loop=$exchange_loop+1;
                                    break;
                                }  
                                if($class_timming[$daily_lecture_array[$daily_lecture_index]] == $class_timming[0])
                                {
                                    $daily_lecture_index=$daily_lecture_index+1;
                                    if($daily_lecture_index == $daily_lecture_count)
                                    {
                                        break;
                                    }
                                }
                                $timming = $class_timming[$daily_lecture_array[$daily_lecture_index]];
                               
                                $lecture_area_1 = $class_lecture_area[$daily_lecture_array[$daily_lecture_index]];
                                
                                if($lecture_area != "all_area_lecture")
                                {
                                    if($lecture_area != $lecture_area_1)
                                    {
                                        continue;
                                    }
                                }
                                
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
                                    
                                    $day=$day_array[$day_index];
                                    
                                    //echo "<br> day : ".$day." and subject name : ".$lecture_name." and timming : ".$timming ;
                                    if($closed_day != $day_array[$day_index])
                                    {
                                        if($subject_cheker == 0)
                                        {
                                            /* Extractin  freesolt information from free_solt_detail table in database */
                                            $sql_query14="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_lecture_name='".$lecture_name."' AND col_lecture_type='".$lecture_type."' ";
                                            $result14=$conn->query($sql_query14);/* execution of query */
                                            /* extractinng from free_solt_detail table in database */
                                            $data14 = $result14->fetch_array();
                                                
                                            if(!isset($data14['col_timming']))
                                            {
                                                /* Extractin  freesolt information from free_solt_detail table in database */
                                                $sql_query15="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_lecture_type='".$lecture_type."' ";
                                                $result15=$conn->query($sql_query15);/* execution of query */
                                                /* extractinng from free_solt_detail table in database */
                                                $data15 = $result15->fetch_array();
                                                if(!isset($data15['col_timming']) || $lecture_type == 0)
                                                {
                                                    $subject_cheker = 1;
                                                }
                                                else
                                                {
                                                    if(!isset($perment_subject_cheker_set))
                                                    {
                                                        $subject_cheker = 0;
                                                    }
                                                }
                                            }
                                            else
                                            {
                                                if(!isset($perment_subject_cheker_set))
                                                {
                                                    $subject_cheker = 0;
                                                }
                                            }
                                         }//subject checker 0 if
                                        
                                        if($subject_cheker == 1)
                                        {
                                            /* Extractin  freesolt information from free_solt_detail table in database */
                                            $sql_query15="SELECT  *  FROM ".$teacher_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming."' ";
                                            $result15=$conn->query($sql_query15);/* execution of query */
                                            /* extractinng from free_solt_detail table in database */
                                            $data15 = $result15->fetch_array();
                                
                                            /* Extractin  freesolt information from free_solt_detail table in database */
                                            $sql_query16="SELECT  *  FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming."' ";
                                            $result16=$conn->query($sql_query16);/* execution of query */
                                            /* extractinng from free_solt_detail table in database */
                                            $data16 = $result16->fetch_array();
                            
                                            if(isset($data15['col_timming']) && isset($data16['col_timming']))
                                            {
                                                if(!empty($lecture_place))
                                                {
                                                    /* Extractin  freesolt information from free_solt_detail table in database */
                                                    $sql_query17="SELECT  *  FROM ".$lecture_place."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming."' ";
                                                    $result17=$conn->query($sql_query17);/* execution of query */
                                                    /* extractinng from free_solt_detail table in database */
                                                    $data17 = $result17->fetch_array();
                                                }
                                                else
                                                {
                                                    $place_not_set=1;
                                                }
                                                
                                                if(isset($data17['col_timming']) || isset($place_not_set))    
                                                {
                                                    unset($place_not_set);
                                                    $insert_set=1;
                                                    $row_span=1;
                                                    $insert_set = insert_data($teacher_name,$lecture_name,$lecture_type,$lecture_place,$class_table_name,$row_span,$day,$timming,$conn,$subject_color);
                                                }//if of place virfied free
                                                else
                                                {
                                                    if(!isset($perment_subject_cheker_set))
                                                    {
                                                        $subject_cheker = 0;
                                                    }
                                                } 
                                             }//if of virfied teacher free
                                             else
                                             {
                                                if(!isset($perment_subject_cheker_set))
                                                {
                                                    $subject_cheker = 0;
                                                }
                                             } 
                                        }//if of subject checker 1
                                    }//if of close day
                            
                                    /*if($daily_lecture_index == ($daily_lecture_count-1) && !isset($perment_subject_cheker_set) && !isset($insert_set))
                                    {
                                         echo "per day lecture count reach";
                                        $daily_lecture_index=-1;
                                        $perment_subject_cheker_set="1";
                                        $subject_cheker = 1;
                                        
                                    }*/
                                }//for loop day
                            }//for loop daily lecture count
                        }//for loop lecture 
                    }//odd subject if
                    
                    if($exchange_loop != 0)
                    {
                       for($subject_lecture_index = 0; $subject_lecture_index < $exchange_loop; $subject_lecture_index++) 
                        { 
                           
                            /* Finding free solt in  timetable table in database */
                            $sql_query60="SELECT * FROM ".$class_table_name."_timetable WHERE   col_available=1"; 
                            $result60=$conn->query($sql_query60);/* execution of query */ 
                            /* extractinng free_solt from table in database */
                            while($data60 = $result60->fetch_array())
                            {
                                unset($check_srno,$plus_reject,$sub_reject);
                                echo "<br> free day".$day=$free_day=$data60['col_day'];
                                echo "<br> free srno".$free_srno=$data60['srno'];
                                echo "<br> free srno".$timming=$data60['col_timming_id'];
                                
                                $check_srno=$free_srno+1;
                                $plus_reject=check_free_solt($conn,$check_srno,$class_table_name,$lecture_name,$free_day);
                                if($plus_reject == 1)
                                {
                                    $check_srno=$free_srno-1;
                                    $sub_reject=check_free_solt($conn,$check_srno,$class_table_name,$lecture_name,$free_day);
                                    
                                    if($sub_reject == 1)
                                    {
                                        /* Finding free solt in  timetable table in database */
                                        $sql_query80="SELECT * FROM ".$class_table_name."_timetable WHERE   col_lecture_name='".$lecture_name."' AND col_day='".$free_day."'"; 
                                        $result80=$conn->query($sql_query80);/* execution of query */ 
                                        /* extractinng free_solt from table in database */
                                        $data80 = $result80->fetch_array();
                                        if(isset($data80))
                                        {
                                           echo "<br> lecture srno".$lec_srno=$data80['srno'];
                                           echo "<br> lecture name".$lec_name=$data80['col_lecture_name'];
                                        }
                                    }
                                    else
                                    {
                                        insert_data($teacher_name,$lecture_name,$lecture_type,$lecture_place,$class_table_name,$row_span,$day,$timming,$conn,$subject_color);
                                    }
                                }
                                else
                                {
                                    insert_data($teacher_name,$lecture_name,$lecture_type,$lecture_place,$class_table_name,$row_span,$day,$timming,$conn,$subject_color);
                                }
                            }//while loop of empty solt
                        }//for loop lecture 
                            
                    }//exchage if
              
                }//if of ! fullday
                
                if($lecture_area == "set_lecture")
                {
                    $subject_detail_index=$subject_detail_index+1;
                    $lecture_area_2 = $subject_lecture_area[$subject_detail_index];
                    $teacher_name_2 = $subject_teacher_name[$subject_detail_index];
                    $lecture_name_2 = $subject_lecture_name[$subject_detail_index];
                    $lecture_type_2 = $subject_lecture_type[$subject_detail_index]; 
                    $lecture_place_2 = $subject_lecture_place[$subject_detail_index]; 
                    $subject_color_2 = $subject_table_color[$subject_detail_index]; 
                    $subject_lecture_count_2 = $subject_table_lecture_count[$subject_detail_index];
                    
                    for($subject_lecture_index = 0; $subject_lecture_index < $subject_lecture_count; $subject_lecture_index++) 
                    {
                        //shuffle($daily_set_lecture_count);
                        for($daily_lecture_index = 0; $daily_lecture_index < $daily_set_lecture_count; $daily_lecture_index++)
                        {

                            //break if lecture is arrange
                            if(isset($insert_set))
                            {
                                    $subject_cheker = 0;
                                unset($insert_set);
                                break;
                            }
                   
                            $timming_1 = $class_timming[$daily_lecture_array_even[$daily_lecture_index][0]];
                                
                            $timming_2 = $class_timming[$daily_lecture_array_even[$daily_lecture_index][1]];
                                
                            $day_array=array('0','1','2','3','4','5');
                            shuffle($day_array);
                   
                            for($day_index=0;$day_index<6;$day_index++) 
                            {
                                //break if lecture is arrange
                                if(isset($insert_set))
                                {
                                    $subject_cheker = 0;
                                    break;
                                }
                                
                                $day=$day_array[$day_index];
                                
                                if($closed_day != $day_array[$day_index])
                                {
                                    
                                    /* Extractin freesolt information from free_solt_detail table in database */ 
                                    $sql_query15="SELECT  *  FROM " .$teacher_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming='".$timming_1."' ";
                                    $result15=$conn->query($sql_query15);/* execution of query */
                                    /* extractinng from free_solt_detail table in database */
                                    $data15 = $result15->fetch_array();
                        
                                    /* Extractin  freesolt information from free_solt_detail table in database */
                                    $sql_query16="SELECT * FROM ".$teacher_name_2."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming_2."' ";
                                    $result16=$conn->query($sql_query16);/* execution of query */
                                    /* extractinng from free_solt_detail table in database */
                                    $data16 = $result16->fetch_array();
                            
                                    /* Extractin freesolt information from free_solt_detail table in database */ 
                                    $sql_query17="SELECT  *  FROM " .$class_table_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming='".$timming_1."' ";
                                    $result17=$conn->query($sql_query17);/* execution of query */
                                    /* extractinng from free_solt_detail table in database */
                                    $data17 = $result17->fetch_array();
                        
                                    /* Extractin  freesolt information from free_solt_detail table in database */
                                    $sql_query18="SELECT * FROM ".$class_table_name."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming_2."' ";
                                    $result18=$conn->query($sql_query18);/* execution of query */
                                    /* extractinng from free_solt_detail table in database */
                                    $data18 = $result18->fetch_array();

                                    if(isset($data15['col_timming']) && isset($data16['col_timming']) && isset($data17['col_timming']) && isset($data18['col_timming']))
                                    {
                                        if(!empty($lecture_place))
                                        {
                                            /* Extractin  freesolt information from free_solt_detail table in database */
                                            $sql_query17="SELECT  *  FROM ".$lecture_place."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming_1."' ";
                                            $result17=$conn->query($sql_query17);/* execution of query */
                                            /* extractinng from free_solt_detail table in database */
                                            $data17 = $result17->fetch_array();
                                            
                                            /* Extractin  freesolt information from free_solt_detail table in database */
                                            $sql_query19="SELECT  *  FROM ".$lecture_place_2."_timetable WHERE col_day='".$day."' AND col_available='1' AND col_timming ='".$timming_2."' ";
                                            $result19=$conn->query($sql_query19);/* execution of query */
                                            /* extractinng from free_solt_detail table in database */
                                            $data19 = $result19->fetch_array();
                                        }
                                        else
                                        {
                                            $place_not_set=1;
                                        }
                                       if((isset($data17['col_timming']) && isset($data19['col_timming'])) || isset($place_not_set))    
                                       {
                                           unset($place_not_set);
                                           $insert_set=1;
                                           for($i = 0; $i < 2; $i++)
                                           {
                                               if($i == 1)
                                               {
                                                   $lecture_area  = $lecture_area_2;
                                                   $teacher_name  = $teacher_name_2;
                                                   $lecture_name  = $lecture_name_2;
                                                   $lecture_type  = $lecture_type_2; 
                                                   $lecture_place = $lecture_place_2; 
                                                   $subject_color = $subject_color_2;
                                                   $row_span = 2;
                                                   $timming =$timming_2;
                                                   $insert_set = insert_data($teacher_name,$lecture_name,$lecture_type,$lecture_place,$class_table_name,$row_span,$day,$timming,$conn,$subject_color);
                                               }
                                               else
                                               {
                                                   $row_span = 1;
                                                   $timming = $timming_1;
                                                   $insert_set = insert_data($teacher_name,$lecture_name,$lecture_type,$lecture_place,$class_table_name,$row_span,$day,$timming,$conn,$subject_color);
                                               } 
                                           }//for loop of insert subject 
                                       }//if of place virfied free
                                    }//if of virfied teacher free
                                }//if of close day
                            }//for loop day
                        }//for loop daily lecture count
                    }//for loop lecture
                }//if of lectere type set lecture
            }//for loop subject detail
        }//for loop of class 
    }//else of subject detail
}//main if 
?>
<form method="post" action="">
<button type="submit" name="insert_all_class_time_detail">enter</button>
</form>