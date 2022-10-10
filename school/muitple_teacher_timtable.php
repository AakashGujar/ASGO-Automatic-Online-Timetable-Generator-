<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["avilable_solt"][0]=array(1);
//connection to database
include('user_connection.php');

 /* Finding class_time_detail table in database */
	$sql_query0="SELECT col_teacher_name FROM free_solt_detail";
	$result0=$conn->query($sql_query0);/* execution of query */
    /* extractinng class_time_detail table in database */
    $data0 = $result0->fetch_array();
    while($data0 = $result0->fetch_array())
    {
        $class_name[]=$data0['col_teacher_name'];
    }
    //print_r($class_name);
    $class_name_index_count=count($class_name)-1;
for($class_name_index=41;$class_name_index<$class_name_index_count;$class_name_index++)
{
             
    $class_table_name=$class_name[$class_name_index];
    
    echo "<h1 style='background-color:red;color:white;'>".$class_table_name."<h1>";
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
    unset($timming);
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
    
    $first_arry_index=0;
    $avilable_solt=$_SESSION["avilable_solt"][$first_arry_index]; 
    $avilable_solt_count=count($_SESSION["avilable_solt"][$first_arry_index]); 
    
     for($b = 0; $b < $timming_count; $b++)
    {
         unset($srno,$day_wise_id,$class_available,$timming_id,$teacher_name,$lecture_name,$lecture_type,$lecture_place,$row_span,$batch,$col_class_name);
            
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
                $batch[]       = $data3['col_batch'];
                $col_class_name[]       = $data3['col_class_name'];
                
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
                                             $color = $batch[$c];
                                            echo "<td  style='border:4px solid ".$batch[$c].";' >";
                                        }
                                
                                        echo "id : ".$srno[$c];
                                        echo "<br>teacher name : ".$teacher_name[$c];
                                        echo "<br>lecture name : ".$lecture_name[$c]." ".$lecture_type_array[$lecture_type[$c]];
                                        $class_color=array('5a','5b','6a','6b','7a','7b','8a','8b','9a','9b','10a','10b');
                                        $color_with_class=array('teal','Gold','blue','Turquoise','red','green','brown','pink','yellow','navy','silver','grey');
                                        for($class_color_index=0;$class_color_index<12;$class_color_index++)
                                        { 
                                            if($class_color[$class_color_index] == $col_class_name[$c])
                                            {
                                               $style_color="style=';background-color:".$color_with_class[$class_color_index].";color:white;'";
                                            }
                                        }
                                        echo "<br><h4 ".$style_color.">  class name : ".$col_class_name[$c]." -- count: ".$c."--</h4>";
                                    
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
?>