<h4>Under Development</h4>
<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION["avilable_solt"][0]=array(1);

//connection to database
include('user_connection.php');

if(isset($_POST['class_lecture_detail']))
{
	echo  '
	<form method="post" target="_self" action="class_lecture_detail.php" >
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <th scope="col" colspan="2">Insert Class Detail</th>
            </tr>
            <tr> 
                <td >
                    <input type="text" name="class_name" id="class_name" placeholder="Class Name">
                </td>
                <td>
                    <input type="text" name="class_div" id="class_div" placeholder="Class Div">
                </td>
           <td>
					<input type=submit class="check_class_name" id="check_class_name" value="Next">
				</td>
             </tr>
        </table>
	</form>		
            ';
}

if(isset($_POST['class_name']))
{
	$class_table_name=$_POST['class_name'].$_POST['class_div'];	
    
   /* Finding class_time_detail table in database */
	$sql_query1="SELECT * FROM ".$class_table_name."_time_detail";
	$result1=$conn->query($sql_query1);/* execution of query */
    if($result1 == "")
    {
        //not get class_time_detail table in database
		  echo "go home and insert class time detail<a href='index.php'>Home</a>";
        
    }
    else
    {
        //get class_time_detail table in database
        /* extractinng class_time_detail table in database */
		  $data1 = $result1->fetch_array();
        
          /* Extractin  freesolt information from free_solt_detail table in database */
			 $sql_query12="SELECT  *  FROM  free_solt_detail  WHERE  col_class_name='".$class_table_name."' ";
			$result12=$conn->query($sql_query12);/* execution of query */
        /* extractinng from free_solt_detail table in database */
		   $data12 = $result12->fetch_array();
        
        /* Extractin  freesolt information from free_solt_detail table in database */
			 $sql_query13="SELECT  *  FROM ".$class_table_name."_timetable ";
			$result13=$conn->query($sql_query13);/* execution of query */
        /* extractinng from free_solt_detail table in database */
		   while($data13 = $result13->fetch_array())
           {
               $class_timming[]=$data13['col_timming'];
           }
            
       /* Finding class_lecture_detail table in database */
	   $sql_query5="SELECT * FROM".$class_table_name."_lecture_detail" ;
	   $result5=$conn->query($sql_query5);/* execution of query */
        if($result5 == "")
	    {
            //not get class_time_detail table in database
        
            $newdata="1";
        
            
	   }
	   else
	   {
		  //get class_lecture_detail table in database
		  $newdata="0";
		  /* extractinng class_lecture_detail table in database */
		  $data5 = $result5->fetch_array();
		
       }
	 
    }
}

if(isset($_POST['back']))
{
	header('Location:index.php');
}

?>

<!DOCTYPE html PUBLIC>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="javascript/jQuery 3.5.1.js"></script>

    <title>Class Lecture Detail</title>
</head>
<?php 
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
	?>

<body onload="lecture_count();bring_timetable();">
    <div id="all_timetable_data">
        <b>Timetable</b>
        <button type="submit" name="min_display_timetable" id="min_display_timetable"
            onclick="$('#timetable').css('height', '30%');$('#form').removeClass('hide');$('#all_form_data').removeClass('hide');">Min</button>

        <button type="submit" name="max_display_timetable" id="max_display_timetable"
            onclick="$('#timetable').css('height', 'auto');$('#form').addClass('hide');$('#all_form_data').addClass('hide');">Max</button>

        <button type="submit" name="hide_display_timetable" id="hide_display_timetable"
            onclick="$('#timetable').addClass('hide');$('#hide_display_timetable').addClass('hide');$('#unhide_display_timetable').removeClass('hide');">Hide</button>

        <button type="submit" name="unhide_display_timetable" id="unhide_display_timetable"
            onclick="$('#timetable').removeClass('hide');$('#hide_display_timetable').removeClass('hide');$('#unhide_display_timetable').addClass('hide');"
            class="hide">Unhide</button>

        <div id="timetable" class="live_preview_div" style="height:30%;">
            <div id="display_timetable"></div>
            <br>
            <table width="100%" border="1" cellspacing="5" cellpadding="3" id="lecture_table">
                <tr>
                    <th scope="row">First id</th>
                    <th scope="row">First id check avilablity</th>
                    <th scope="row">Select Second id</th>
                    <th scope="row">Exchange</th>
                </tr>
                <tr>
                    <th>
                        <input type="text" id="first_id" name="first_id" value=" ">
                    </th>
                    <th>
                        <button type="submit" id="avilability_checker" name="avilability_checker"
                            onclick="avilability_checker();">check</button>
                    </th>
                    <th id="second_id_th">
                        <select id="second_id" name="second_id" disabled>
                            <option id="ns">Not Selected</option>
                        </select>
                    </th>
                    <th>
                        <button type="clear" name="exchange" id="exchange" onclick="exchange();"
                            disabled>Exchange</button>
                    </th>
                </tr>
                <!--<tr>
                <th colspan="2">
                    
                </th>
                <th colspan="2">
                    <button type="clear" name="save" id="save">Save</button>
                </th>
            </tr>-->
            </table>
            <br>
            <table>

            </table>
        </div>

    </div>


    <div id="all_form_data">
        <b>Subject</b>
        <button type="submit" name="min_display_form" id="min_display_form"
            onclick="$('#form').css('height', '46%');$('#timetable').removeClass('hide');$('#all_timetable_data').removeClass('hide');">Min</button>

        <button type="submit" name="max_display_form" id="max_display_form"
            onclick="$('#form').css('height', 'auto');$('#all_timetable_data').addClass('hide');">Max</button>

        <button type="submit" name="hide_display_form" id="hide_display_form"
            onclick="$('#form').addClass('hide');$('#hide_display_form').addClass('hide');$('#unhide_display_form').removeClass('hide');">Hide</button>

        <button type="submit" name="unhide_display_form" id="unhide_display_form"
            onclick="$('#form').removeClass('hide');$('#hide_display_form').removeClass('hide');$('#unhide_display_form').addClass('hide');"
            class="hide">Unhide</button>
        <div id="form" class="live_preview_div">
            <form method="post" action="class_lecture_detail_back.php">

                <!-- hidden data -->
                <div id="hidden_data">
                    <input type="hidden" name="post_lecture_information" id="post_lecture_information" value="5">
                    <input type="hidden" name="post_class_table_name" id="post_class_table_name"
                        value="<?php echo $class_table_name;?>">
                </div>

                <!-- first lecture -->
                <table width="100%" border="1" cellspacing="0" cellpadding="1">
                    <tr>
                        <th scope="row">All First Lecture Information</th>
                    </tr>
                </table>
                <br>
                <table width="95%" border="1" cellspacing="5" cellpadding="3">
                    <tr>
                        <th scope="row">Day</th>
                        <th scope="row">Name Of Teacher</th>
                        <th scope="row">Name Of Lecture</th>
                        <th scope="row">Name Of Place Where Lecture Will Held</th>
                        <th scope="row">
                            Enter Total Number Of This Lecture In Week
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <th width="50%">Used</th>
                                    <th width="50%">Available</th>
                                </tr>
                            </table>
                        </th>
                        <th scope="row">Modify/Insert</th>
                        <th width="row" class="hide">Delete</th>
                    </tr>
                    <?php 
            $day_array=array('Monday','Tuesday','Wensday','Thursday','Friday','Saturday');
            for($day_index=0;$day_index<6;$day_index++)
            {
                $next_day_index_value="6";
                if($closed_day != $day_index) 
                {
                    for($next_day_index=$day_index+1;$next_day_index<6;$next_day_index++)
                    {
                        if($closed_day != $next_day_index) 
                        {
                            $next_day_index_value=$next_day_index;
                            break;
                        }
                    }
            ?>
                    <tr>
                        <td id="post_day<?php echo $day_index; ?>"><?php echo $day_array[$day_index]; ?></td>
                        <td>
                            <select name="post_teacher_name<?php echo $day_index; ?>"
                                id="post_teacher_name<?php echo $day_index; ?>"
                                onchange="display_lecture_type_option(this.id);"
                                <?php if(isset($teacher_set)){ echo "disabled";} $teacher_set="1"; ?>>
                                <option value="ns">Not Selected</option>
                                <?php 
                        //unset reused array
                         unset(
                             $srno,
                             $teacher_first_name,
                             $teacher_last_name
                         );
                        /* Finding teacher detail table in database */
	                    $sql_query2="SELECT * FROM teacher_detail";
                        $result2=$conn->query($sql_query2);/* execution of query */
                        if($result2 == "")
	                    {
                            echo '
                            <script>
                                alert("No Teacher found")
                            </script>
                            ';
                        }
                        else
                        {
                            /* counting no of row from teacher detail table */
                            $teacher_detail_count=$result2->num_rows;
		
		                   if($result2->num_rows > 0)
		                   {
			                  while($data2=$result2->fetch_array())
			                 {
                                /* storing data from teacher detail table to array variable*/
				                $srno[]							= $data2['srno'];
				                $teacher_first_name[]			= $data2['col_teacher_first_name'];
				                $teacher_last_name[]			= $data2['col_teacher_last_name'];
			                 }
		                  }
		
                          if( $teacher_detail_count == 0 )
                           {
                              echo '
                                <script>
                                    alert("No Teacher found")
                                </script>
                                ';
                            }
                            else
                            {
                                //displaying data of teacher detail table in loop
                                for($i=0;$i<$teacher_detail_count;$i++)
                                {
                                     /* Extractin  freesolt information from free_solt_detail table in database */
                                    $sql_query14="SELECT  *  FROM ".$teacher_first_name[$i]."_".$teacher_last_name[$i]."_timetable WHERE col_day=".$day_index." AND col_timming ='". $class_timming[0]."'";
			                         $result14=$conn->query($sql_query14);/* execution of query */
                                    /* extractinng from free_solt_detail table in database */
                                    $data14 = $result14->fetch_array();
                                    
                                    if($data14['col_timming'] == $class_timming[0] && $data14['col_available'] == 1)
                                    {
                                       echo '
                                       <option id='.$teacher_first_name[$i]."_".$teacher_last_name[$i].' value='.$teacher_first_name[$i]."_".$teacher_last_name[$i].'>'.$teacher_first_name[$i]." ".$teacher_last_name[$i].'</option>
                                       '; 
                                    }
                                }
                            }
                        }
                        
                        ?>
                            </select>
                        </td>
                        <td>
                            <select name="post_lecture_name<?php echo $day_index; ?>"
                                id="post_lecture_name<?php echo $day_index; ?>"
                                onchange="display_lecture_type_option(this.id);" disabled>
                                <option value="ns">Not Selected</option>
                                <?php 
                        //unset reused array
                         unset(
                             $srno,
                             $lecture_full_name,
                             $lecture_short_name,
                             $lecture_type,
                             $lecture_place
                         );
                        /* Finding lecture information table in database */
	                    $sql_query2="SELECT * FROM lecture_information";
                        $result2=$conn->query($sql_query2);/* execution of query */
                        if($result2 == "")
	                    {
                            echo '
                            <script>
                                alert("No Lecture found")
                            </script>
                            ';
                        }
                        else
                        {
                            /* counting no of row from lecture information table */
                            $lecture_information_count=$result2->num_rows;
		                   if($result2->num_rows > 0)
		                   {
			                  while($data3=$result2->fetch_array())
			                 {
                                /* storing data from teacher detail table to array variable*/
				                $srno[]							= $data3['srno'];
				                $lecture_full_name[]			= $data3['col_lecture_full_name'];
				                $lecture_short_name[]			= $data3['col_lecture_short_name'];
				                $lecture_type[]			        = $data3['col_lecture_type'];
				                $lecture_place[]			    = $data3['col_lecture_place'];
			                 }
                                print_r($srno);
		                  }
                           
                          if( $lecture_information_count == 0 )
                           {
                              echo '
                                <script>
                                    alert("No Lecture found")
                                </script>
                                ';
                            }
                            else
                            {
                                $lecture_type_array=array('Theory(TH)','Pratical(PR)','Extracurricular Activities(EA)');
                                //displaying data of teacher detail table in loop
                                for($i=0;$i<$lecture_information_count;$i++)
                                {
                                    echo '
                                    <option id='.$lecture_full_name[$i]."_".$srno[$i].' value='.$lecture_full_name[$i].'>'.$lecture_full_name[$i]." (".$lecture_short_name[$i].') - '.$lecture_type_array[$lecture_type[$i]].'</option>
                                    ';
                                    
                                } 
                                
                                for($i=0;$i<$lecture_information_count;$i++)
                                {
                                    echo '
                                    <input type="hidden" name="post_lecture_type_value'.$srno[$i].'" id="post_lecture_type_value'.$srno[$i].'" value="'.$lecture_type[$i].'">
                                    
                                    <input type="hidden" name="post_lecture_short_name_value'.$srno[$i].'" id="post_lecture_short_name_value'.$srno[$i].'" value="'.$lecture_short_name[$i].'">
                                    
                                    <input type="hidden" name="post_lecture_place_value'.$srno[$i].'" id="post_lecture_place_value'.$srno[$i].'" value="'.$lecture_place[$i].'">
                                    ';
                                }
                            }
                        }
                        
                        ?>
                            </select>
                        </td>
                        <td id="display_lecture_place_option<?php echo $day_index; ?>">
                            <select disabled>
                                <option value="ns">Not Selected</option>
                            </select>
                        </td>
                        <td>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="50%" style="text-align:center;">
                                        <input type="number" id="post_lecture_count<?php echo $day_index; ?>"
                                            name="post_lecture_count<?php echo $day_index; ?>" min='1' max='30'
                                            value='0' onkeyup='lecture_count()' ; onclick='lecture_count();' disabled>
                                    </td>
                                    <td id="display_lecture_available<?php echo $day_index; ?>" width="50%"
                                        style="text-align:center;color:grey;">0</td>
                                </tr>
                            </table>
                            <!--<select id="post_lecture_count<?php echo $day_index; ?>" name="post_lecture_count<?php echo $day_index; ?>" onclick="lecture_count();">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                    </select>-->
                        </td>
                        <td>
                            <button id="modify_<?php echo $day_index; ?>" name="modify_<?php echo $day_index; ?>"
                                value="modify" class="hide"
                                onclick="event.preventDefault();modify_lecture(this.id);">Modify</button>
                            <button id="insert_<?php echo $day_index; ?>" name="insert_<?php echo $day_index; ?>"
                                value="insert"
                                onclick="event.preventDefault();insert_lecture(this.id,<?php echo $next_day_index_value; ?>);"
                                disabled>Insert</button>
                        </td>
                        <td class="hide">
                            <button id="delete_<?php echo $day_index; ?>" name="delete_<?php echo $day_index; ?>"
                                value="delete" onclick="event.preventDefault();">Delete</button>
                        </td>
                    </tr>
                    <input type="hidden" id="post_lecture_area<?php echo $day_index; ?>"
                        name="post_lecture_area<?php echo $day_index; ?>" value="first_lecture">
                    <?php 
                } 
            }
         ?>
                </table>
                <br>

                <!-- before  recess lecture -->
                <table width="100%" border="1" cellspacing="0" cellpadding="1" id="before_recess_lecture_table_1"
                    class="hide">
                    <tr>
                        <th scope="row">All Before Recess Lecture Information(Not Include First Lecture)</th>
                    </tr>
                </table>

                <table width="95%" border="1" cellspacing="5" cellpadding="3" id="before_recess_lecture_table_2"
                    class="hide">
                    <tr>
                        <th scope="row">Day</th>
                        <th scope="row">Name Of Teacher</th>
                        <th scope="row">Name Of Lecture</th>
                        <th scope="row">Name Of Place Where Lecture Will Held</th>
                        <th scope="row">
                            Enter Total Number Of This Lecture In Week
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <th width="50%">Used</th>
                                    <th width="50%">Available</th>
                                </tr>
                            </table>
                        </th>
                        <th scope="row">Modify/Insert</th>
                        <th width="row">Delete</th>
                    </tr>
                    <tr id="default_before_recess_lecture">
                        <th scope="row" colspan="7"> ----------------- click on Add Next Before Recess Lecture to add
                            lecture ----------------- </th>
                    </tr>
                    <tbody id="new_before_recess_lecture">
                    </tbody>

                </table>

                <table width="95%" border="1" cellspacing="5" cellpadding="3" id="before_recess_lecture_table_3"
                    class="hide">
                    <tr>
                        <th scope="row" colspan="2">
                            Lecture <font id="post_used_before_recess_lecture_count"
                                name="post_used_before_recess_lecture_count">0</font>
                            out of
                            <font id="post_before_recess_total_lecture_count"
                                name="post_before_recess_total_lecture_count">
                                <?php
                            if(isset($data12['col_recess1_before_total_lecture_count']))
                            {
                                echo $data12['col_recess1_before_total_lecture_count'];
                            }
                            else
                            {
                                 echo "0";
                            }
                        ?>
                            </font>
                            is Reamaning
                        </th>
                        <td>
                            <button name="next_before_recess_lecture_information_detail"
                                id="next_before_recess_lecture_information_detail"
                                onclick="event.preventDefault();add_new_lecture(this.id);">Add Next Before Recess
                                Lecture</button>
                        </td>
                    </tr>
                </table>

                <!-- before 2 recess lecture -->
                <table width="100%" border="1" cellspacing="0" cellpadding="1" id="before_recess2_lecture_table_1"
                    class="hide">
                    <tr>
                        <th scope="row">All Before Recess 2 Lecture Information</th>
                    </tr>
                </table>

                <table width="95%" border="1" cellspacing="5" cellpadding="3" id="before_recess2_lecture_table_2"
                    class="hide">
                    <tr>
                        <th scope="row">Day</th>
                        <th scope="row">Name Of Teacher</th>
                        <th scope="row">Name Of Lecture</th>
                        <th scope="row">Name Of Place Where Lecture Will Held</th>
                        <th scope="row">
                            Enter Total Number Of This Lecture In Week
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <th width="50%">Used</th>
                                    <th width="50%">Available</th>
                                </tr>
                            </table>
                        </th>
                        <th scope="row">Modify/Insert</th>
                        <th width="row">Delete</th>
                    </tr>
                    <tr id="default_before_recess2_lecture">
                        <th scope="row" colspan="7"> ----------------- click on Add Next Before Recess 2 Lecture to add
                            lecture ----------------- </th>
                    </tr>
                    <tbody id="new_before_recess2_lecture">
                    </tbody>

                </table>

                <table width="95%" border="1" cellspacing="5" cellpadding="3" id="before_recess2_lecture_table_3"
                    class="hide">
                    <tr>
                        <th scope="row" colspan="2">
                            Lecture <font id="post_used_before_recess2_lecture_count"
                                name="post_used_before_recess2_lecture_count">0</font>
                            out of
                            <font id="post_before_recess2_total_lecture_count"
                                name="post_before_recess2_total_lecture_count">
                                <?php
                            if(isset($data12['col_recess2_before_total_lecture_count']))
                            {
                                echo $data12['col_recess2_before_total_lecture_count'];
                            }
                            else
                            {
                                 echo "0";
                            }
                        ?>
                            </font>
                            is Reamaning
                        </th>
                        <td>
                            <button name="next_before_recess2_lecture_information_detail"
                                id="next_before_recess2_lecture_information_detail"
                                onclick="event.preventDefault();add_new_lecture(this.id);">Add Next Before Recess 2
                                Lecture</button>
                        </td>
                    </tr>
                </table>


                <!-- after recess lecture -->
                <table width="100%" border="1" cellspacing="0" cellpadding="1" id="after_recess_lecture_table_1"
                    class="hide">
                    <tr>
                        <th scope="row">All After Recess Lecture Information</th>
                    </tr>
                </table>

                <table width="95%" border="1" cellspacing="5" cellpadding="3" id="after_recess_lecture_table_2"
                    class="hide">
                    <tr>
                        <th scope="row">Day</th>
                        <th scope="row">Name Of Teacher</th>
                        <th scope="row">Name Of Lecture</th>
                        <th scope="row">Name Of Place Where Lecture Will Held</th>
                        <th scope="row">
                            Enter Total Number Of This Lecture In Week
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <th width="50%">Used</th>
                                    <th width="50%">Available</th>
                                </tr>
                            </table>
                        </th>
                        <th scope="row">Modify/Insert</th>
                        <th width="row">Delete</th>
                    </tr>
                    <tr id="default_after_recess_lecture">
                        <th scope="row" colspan="7"> ----------------- click on Add Next After Recess Lecture to add
                            lecture ----------------- </th>
                    </tr>
                    <tbody id="new_after_recess_lecture">
                    </tbody>
                </table>

                <table width="95%" border="1" cellspacing="5" cellpadding="3" id="after_recess_lecture_table_3"
                    class="hide">
                    <tr>
                        <th scope="row" colspan="2">
                            Lecture <font id="post_used_after_recess_lecture_count"
                                name="post_used_after_recess_lecture_count">0</font>
                            out of
                            <font id="post_after_recess_total_lecture_count"
                                name="post_after_recess_total_lecture_count">
                                <?php
                            if(isset($data12['col_recess_after_total_lecture_count']))
                            {
                                echo $data12['col_recess_after_total_lecture_count'];
                            }
                            else
                            {
                                 echo "0";
                            }
                        ?>
                            </font>
                            is Reamaning
                        </th>
                        <td>
                            <button name="next_after_recess_lecture_information_detail"
                                id="next_after_recess_lecture_information_detail"
                                onclick="event.preventDefault();add_new_lecture(this.id);">Add Next After Recess
                                Lecture</button>
                        </td>
                    </tr>
                </table>
                <br>

                <!-- all lecture -->
                <table width="100%" border="1" cellspacing="0" cellpadding="1" id="all_area_lecture_table_1">
                    <tr>
                        <th scope="row">All Lecture Information</th>
                    </tr>
                </table>
                <br>
                <table width="95%" border="1" cellspacing="5" cellpadding="3" id="all_area_lecture_table_2">
                    <tr>
                        <th scope="row">Day</th>
                        <th scope="row">Name Of Teacher</th>
                        <th scope="row">Name Of Lecture</th>
                        <th scope="row">Name Of Place Where Lecture Will Held</th>
                        <th scope="row">
                            Enter Total Number Of This Lecture In Week
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <th width="50%">Used</th>
                                    <th width="50%">Available</th>
                                </tr>
                            </table>
                        </th>
                        <th scope="row">Modify/Insert</th>
                        <th width="row">Delete</th>
                    </tr>
                    <tr id="default_all_area_lecture">
                        <th scope="row" colspan="7"> ----------------- click on add lecture button to add lecture
                            ----------------- </th>
                    </tr>
                    <tbody id="new_all_area_lecture">
                    </tbody>
                </table>
                <br>
                <table width="95%" border="1" cellspacing="5" cellpadding="3" id="all_area_lecture_table_3">
                    <tr>
                        <td id="next_all_area_lecture_information_detail_td">
                            <button name="next_all_area_lecture_information_detail"
                                id="next_all_area_lecture_information_detail"
                                onclick="event.preventDefault();add_new_lecture(this.id);">Add Next Lecture</button>
                        </td>
                    </tr>
                </table>
                <br>

                <!-- fullday lecture -->
                <table width="100%" border="1" cellspacing="0" cellpadding="1" id="fullday_lecture_table_1">
                    <tr>
                        <th scope="row">All Fullday Lecture Information</th>
                    </tr>
                </table>
                <br>
                <table width="95%" border="1" cellspacing="5" cellpadding="3" id="fullday_lecture_table_2">
                    <tr>
                        <th scope="row">Day</th>
                        <th scope="row">Name Of Teacher</th>
                        <th scope="row">Name Of Lecture</th>
                        <th scope="row">Name Of Place Where Lecture Will Held</th>
                        <th scope="row">
                            Enter Total Number Of This Lecture In Week
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <th width="50%">Used</th>
                                    <th width="50%">Available</th>
                                </tr>
                            </table>
                        </th>
                        <th scope="row">Modify/Insert</th>
                        <th width="row">Delete</th>
                    </tr>
                    <tr id="default_fullday_lecture">
                        <th scope="row" colspan="7"> ----------------- click on add fullday lecture button to add
                            lecture ----------------- </th>
                    </tr>
                    <tbody id="new_fullday_lecture">
                    </tbody>
                </table>
                <br>
                <table width="95%" border="1" cellspacing="5" cellpadding="3" id="fullday_lecture_table_3">
                    <tr>
                        <td id="next_fullday_lecture_information_detail_td">
                            <button name="next_fullday_lecture_information_detail"
                                id="next_fullday_lecture_information_detail"
                                onclick="event.preventDefault();add_new_lecture(this.id);" disabled>Add Next Fullday
                                Lecture</button>
                        </td>
                    </tr>
                </table>
                <br>

                <!-- all button at last place -->
                <table width="100%" border="0" cellspacing="0" cellpadding="1">
                    <tr>
                        <td id="before_recess_lecture_table_4">
                            <button type="submit" name="before_recess_lecture" id="before_recess_lecture"
                                onclick="event.preventDefault();next(this.id);">Add Before Recess Lecture</button>
                        </td>
                        <td id="before_recess2_lecture_table_4" class="hide">
                            <button type="submit" name="before_recess2_lecture" id="before_recess2_lecture"
                                onclick="event.preventDefault();next(this.id);">Add Before Recess 2 Lecture</button>
                        </td>
                        <td id="after_recess_lecture_table_4" class="">
                            <button type="submit" name="after_recess_lecture" id="after_recess_lecture"
                                onclick="event.preventDefault();next(this.id);">Add After Recess Lecture</button>
                        </td>
                        <td scope="row" colspan="2" id="total_lecture_count_col" class="hide"><b>
                                Lecture <font id="post_used_lecture_count" name="post_used_lecture_count">0</font>
                                out of
                                <font id="post_total_lecture_count" name="post_total_lecture_count">
                                    <?php
                            if(isset($data1['col_total_lecture_count']))
                            {
                                echo $data1['col_total_lecture_count'];
                            }
                            else
                            {
                                 echo "0";
                            }
                        ?>
                                </font>
                                is Reamaning
                            </b>
                        </td>
                        <!--<td id="after_recess_lecture_table_5">
                    <a href="index.php"><button type="clear" name="back" id="back">Back</button></a>
                </td>-->
                    </tr>
                    <tr id="bring_timetable_td" class="">
                        <td>
                            <button type="submit" name="bring_timetable_button" id="bring_timetable_button"
                                onclick="event.preventDefault();bring_timetable();">Next</button>
                        </td>
                        <td>
                            <a href="index.php"><button type="clear" name="back" id="back">Back</button></a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

<?php }?>

<!-- <style>
/* The Close Button */
.close {
  color: green;
  font-size: 28px;
  font-weight: bold;
  display:none;
}

.close:hover,
.close:focus {
  color: white;
  text-decoration: none;
  cursor: pointer;
}
.modal01:target {
    display: block;
    outline: none;
}
</style>    
 Modal for full size images on click
<div id="modal01" class="modal" style="display:none;width:100%;height:100%;background-color:rgba(0,0,0,0.7);position: absolute;left: 0%;top: 0%;z-index: 9999;">
    <center style="color:white;top: 40%;left: 40%;"> 
        <h4 id="text_for_loading"></h4>
        <span id="close" class="close">OK</span>
    </center>
</div>-->
<script>
/* Get the modal
var modal = document.getElementById("modal01");
	// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}*/
//gobal variable delcration(used in next(),lecture_count())
var recess_count = "<?php echo $data1['col_recess_count']?>";
var daily_lecture_count = "<?php echo $data1['col_daily_lecture_count']?>";

//inserting lecture(subject) information on user click and giving correct place option on subject selection
function lecture_fullday(id) {
    //finding number from option id
    var idno_array = id.match(/(\d+)/);
    var no = idno_array[0];

    if (id == "lecture_fullday_no" + no) {
        $('#lecture_fullday_tr' + no).css("display", "none");
    } else {
        $('#lecture_fullday_tr' + no).css("display", "block");
    }

}

//inserting teacher information on user click and giving correct teacher option on day selection
function display_teacher_name_option(option_id) {
    var post_teacher_name_option = " ";
    var day_lecture_count = " ";
    var per_day_lecture_count = daily_lecture_count;

    //finding number from option id
    var idno_array = option_id.match(/(\d+)/);
    var no = idno_array[0];

    var day = $('option:selected', '#post_day' + no).attr('id');

    //setting value of avai.. to original
    $('#display_lecture_available' + no).text("0");
    $('#post_lecture_count' + no).val("0");
    lecture_count();
    $('#post_lecture_count' + no).attr("disabled", "disabled");
    $('#display_lecture_available' + no).css("color", "grey");

    var lecture_area = $('#post_lecture_area' + no).val();
    var class_table_name = $('#post_class_table_name').val();
    //console.log("teacher="+no+" "+teacher_name+" vale="+lecture_name+" option id="+option_id);
    if (lecture_area == "fullday_lecture") {
        $('#post_day' + no).find('[value="ns"]').remove();
    }
    //chechinking day and cacultaing fullday lecture
    if (day < 6) {
        day_lecture_count = $('#post_lecture_count' + day).val();

        if (typeof(day_lecture_count) == "undefined" && day_lecture_count == null || day_lecture_count == 0) {
            day_lecture_count = 1;
        }
        per_day_lecture_count = parseInt(daily_lecture_count) - parseInt(day_lecture_count);
    }

    $.post('class_lecture_detail_back.php',

        {
            teacher_name_option: post_teacher_name_option,
            post_lecture_area: lecture_area,
            post_per_day_lecture_count: per_day_lecture_count,
            class_table_name: class_table_name,
            post_day: day,
            post_id_no: no
        },

        function(data) {
            $('#display_teacher_name_option' + no).html(data);
        }
    );

}

//inserting lecture(subject) information on user click and giving correct place option on subject selection
function display_lecture_type_option(option_id) {
    var post_lecture_type_option = " ";
    var day_lecture_count = " ";
    var per_day_lecture_count = daily_lecture_count;

    //finding number from option id
    var idno_array = option_id.match(/(\d+)/);
    var no = idno_array[0];

    var lecture_name = $('option:selected', '#post_lecture_name' + no).attr('id');
    var teacher_name = $('option:selected', '#post_teacher_name' + no).attr('id');
    var day = $('option:selected', '#post_day' + no).attr('id');
    if (typeof(lecture_name) != "undefined" && lecture_name != null) {
        //setting value of avai.. to original
        $('#display_lecture_available' + no).text("0");
        $('#post_lecture_count' + no).val("0");
        lecture_count();
        $('#post_lecture_count' + no).attr("disabled", "disabled");
        $('#display_lecture_available' + no).css("color", "grey");

        //finding number from option value
        var srno_array = lecture_name.match(/(\d+)/);
        var srno = srno_array[0];

        //checking duplicate value of option 
        var post_lecture_type = $('#post_lecture_type' + no).val();

        if (typeof(post_lecture_type) == "undefined" && post_lecture_type == null) {
            $('#hidden_data').append('<div id="hidden_data' + no + '"></div>');
        }

        var lecture_type = $('#post_lecture_type_value' + srno).val();
        var lecture_short_name = $('#post_lecture_short_name_value' + srno).val();
        var lecture_place = $('#post_lecture_place_value' + srno).val();
        var lecture_area = $('#post_lecture_area' + no).val();
        var class_table_name = $('#post_class_table_name').val();
        //console.log("teacher="+no+" "+teacher_name+" vale="+lecture_name+" option id="+option_id);

        //chechinking day and cacultaing fullday lecture
        if (day < 6) {
            day_lecture_count = $('#post_lecture_count' + day).val();

            if (typeof(day_lecture_count) == "undefined" && day_lecture_count == null || day_lecture_count == 0) {
                day_lecture_count = 1;
            }
            per_day_lecture_count = parseInt(daily_lecture_count) - parseInt(day_lecture_count);
        }

        $('#hidden_data' + no).html('<input type="hidden" name="post_lecture_type' + no + '" id="post_lecture_type' +
            no + '" value="' + lecture_type + '"><input type="hidden" name="post_lecture_short_name' + no +
            '" id="post_lecture_short_name' + no + '" value="' + lecture_short_name + '">');

        $.post('class_lecture_detail_back.php',

            {
                lecture_type_option: post_lecture_type_option,
                post_lecture_area: lecture_area,
                class_table_name: class_table_name,
                post_per_day_lecture_count: per_day_lecture_count,
                post_day: day,
                post_teacher_name: teacher_name,
                post_lecture_place_value: lecture_place,
                post_id_no: no
            },

            function(data) {
                $('#display_lecture_place_option' + no).html(data);
                if (lecture_place == 0) {
                    display_lecture_available(no);
                }
            }
        );
        $("#post_lecture_name" + no).find('[value="ns"]').remove();
    }

    if (typeof(teacher_name) != "undefined" && teacher_name != null) {
        $('#post_lecture_name' + no).removeAttr("disabled");
        $("#post_teacher_name" + no).find('[value="ns"]').remove();
    }

    if (typeof(day) != "undefined" && day != null) {
        $('#post_teacher_name' + no).removeAttr("disabled");
    }

}

//giving available lecture to user
function display_lecture_available(no) {
    //getting available th lecture solt
    var lecture_available = $('#th' + no).val();
    var lecture_available_id = 0;
    if (typeof(lecture_available) == "undefined" && lecture_available == null) {
        //getting id of place for available
        var lecture_place_name = $('option:selected', '#post_lecture_place_name' + no).attr('id');
        //creating id for display ava... solt
        var lecture_available_id = lecture_place_name.concat(no);
        //getting available ea,pr,.. lecture solt
        var lecture_available = $('#' + lecture_available_id).val();
    }


    //putting/display 
    $('#display_lecture_available' + no).text(lecture_available);
    $('#post_lecture_count' + no).val(1);

    $('#post_lecture_count' + no).removeAttr("disabled");
    $('#insert_' + no).removeAttr("disabled");
    $("#post_lecture_place_name" + no).find('[value="ns"]').remove();
    $('#display_lecture_available' + no).css("color", "black");
    bring_timetable(lecture_available_id);
}

//enable and disable button of area(i.e before,before2,after recess)
function next(id) {

    $('#' + id + '_table_1').removeClass('hide');
    $('#' + id + '_table_2').removeClass('hide');
    $('#' + id + '_table_3').removeClass('hide');

    $("<br>").insertAfter('#' + id + '_table_1');
    $("<br>").insertAfter('#' + id + '_table_2');
    $("<br>").insertAfter('#' + id + '_table_3');



    if (id == "before_recess_lecture") {
        /*var lecture_information_count=$('#post_lecture_information').val();
        lecture_information_count=parseInt(lecture_information_count)+parseInt(2);
        $('#post_lecture_information').val(lecture_information_count);
        lecture_count();*/

        if (recess_count == 1) {
            $('#after_recess_lecture_table_4').removeClass('hide');
            //$('#'+id+'_table_4').addClass('hide');
            $('#total_lecture_count_col').addClass('hide');
            id = "next_before_recess_lecture_information_detail";
            add_new_lecture(id);
        } else {
            $('#before_recess2_lecture_table_4').removeClass('hide');
            //$('#'+id+'_table_4').addClass('hide');
            $('#total_lecture_count_col').addClass('hide');
            id = "next_before_recess_lecture_information_detail";
            add_new_lecture(id);
        }
    } else if (id == "before_recess2_lecture") {
        $('#after_recess_lecture_table_4').removeClass('hide');
        //$('#'+id+'_table_4').addClass('hide');
        id = "next_before_recess2_lecture_information_detail";
        add_new_lecture(id);
    } else if (id == "all_area_lecture") {
        $('#all_area_lecture_table_4').removeClass('hide');
        //$('#'+id+'_table_4').addClass('hide');
        id = "all_area_lecture_information_detail";
        add_new_lecture(id);
    }
    /* else if(id == "fullday_lecture")
     {
         $('#fullday_lecture_td').addClass('hide');
         $('#'+id+'_table_4').addClass('hide');
         id="next_fullday_lecture_information_detail";
         add_new_lecture(id);
     }*/
    else {
        $('#bring_timetable_td').removeClass('hide');
        //$('#'+id+'_table_4').addClass('hide');
        //$('#'+id+'_table_5').addClass('hide');
        id = "next_after_recess_lecture_information_detail";
        add_new_lecture(id);
    }
}

//total lecture count(before+before2+after) and depentented fuction
function lecture_count() {
    var total_lecture_count = "0";
    var before_recess_lecture_count = "0";
    var before_recess2_lecture_count = "0";
    var after_recess_lecture_count = "0";
    var lecture_information_count = $('#post_lecture_information').val();
    var predefined_total_lecture_count = $('#post_total_lecture_count').text();
    var predefined_before_recess_lecture_count = $('#post_before_recess_total_lecture_count').text();
    var predefined_before_recess2_lecture_count = $('#post_before_recess2_total_lecture_count').text();
    var predefined_after_recess_lecture_count = $('#post_after_recess_total_lecture_count').text();

    for (var i = 0; i <= lecture_information_count; i++) {
        var lecture_area = $('#post_lecture_area' + i).val();

        if (typeof(lecture_area) != "undefined" && lecture_area != null) {
            var single_lecture_count = $('#post_lecture_count' + i).val();

            if (single_lecture_count == "") {
                single_lecture_count = 0;
            }

            total_lecture_count = parseFloat(total_lecture_count) + parseFloat(single_lecture_count);

            $('#post_used_lecture_count').text(total_lecture_count);

            if (total_lecture_count == predefined_total_lecture_count) {
                $('#bring_timetable_button').removeAttr('disabled');
            }
            if (total_lecture_count < predefined_total_lecture_count) {
                $('#bring_timetable_button').attr('disabled', true);
                $('#next_after_recess_lecture_information_detail').removeAttr('disabled');
            }
            if (total_lecture_count > predefined_total_lecture_count) {
                $('#next_before_recess_lecture_information_detail').attr('disabled', true);
                $('#next_after_recess_lecture_information_detail').attr('disabled', true);
            }



            if (lecture_area == "first_lecture" || lecture_area == "before_recess_lecture") {
                before_recess_lecture_count = parseFloat(before_recess_lecture_count) + parseFloat(
                single_lecture_count);
                $('#post_used_before_recess_lecture_count').text(before_recess_lecture_count);

                if (recess_count == 1) {
                    if (before_recess_lecture_count == predefined_before_recess_lecture_count) {
                        $('#before_recess_lecture_table_3').addClass('java_hide');
                        $('#after_recess_lecture').removeAttr('disabled');
                    }
                    if (before_recess_lecture_count < predefined_before_recess_lecture_count) {
                        $('#before_recess_lecture_table_3').removeClass('java_hide');
                        $('#after_recess_lecture').attr('disabled', true);
                        $('#next_before_recess_lecture_information_detail').removeAttr('disabled');
                        $('#next_after_recess_lecture_information_detail').attr('disabled', true);
                        $('#bring_timetable_button').attr('disabled', true);
                    }
                    if (before_recess_lecture_count > predefined_before_recess_lecture_count) {
                        $('#next_before_recess_lecture_information_detail').attr('disabled', true);
                        $('#next_after_recess_lecture_information_detail').attr('disabled', true);
                        $('#bring_timetable_button').attr('disabled', true);
                        $('#before_recess_lecture_table_3').removeClass('java_hide');
                    }
                } else {
                    if (before_recess_lecture_count == predefined_before_recess_lecture_count) {
                        $('#before_recess_lecture_table_3').addClass('java_hide');
                        $('#before_recess2_lecture').removeAttr('disabled');
                    }
                    if (before_recess_lecture_count < predefined_before_recess_lecture_count) {
                        $('#before_recess_lecture_table_3').removeClass('java_hide');
                        $('#before_recess2_lecture').attr('disabled', true);
                        $('#next_before_recess_lecture_information_detail').removeAttr('disabled');
                        $('#next_before_recess2_lecture_information_detail').removeAttr('disabled');
                        $('#next_after_recess_lecture_information_detail').attr('disabled', true);
                        $('#bring_timetable_button').attr('disabled', true);
                    }
                    if (before_recess_lecture_count > predefined_before_recess_lecture_count) {
                        $('#next_before_recess_lecture_information_detail').attr('disabled', true);
                        $('#next_before_recess2_lecture_information_detail').attr('disabled', true);
                        $('#next_after_recess_lecture_information_detail').attr('disabled', true);
                        $('#bring_timetable_button').attr('disabled', true);
                        $('#before_recess_lecture_table_3').removeClass('java_hide');
                    }

                }

            }

            if (lecture_area == "before_recess2_lecture") {
                before_recess2_lecture_count = parseFloat(before_recess2_lecture_count) + parseFloat(
                    single_lecture_count);
                $('#post_used_before_recess2_lecture_count').text(before_recess2_lecture_count);

                if (before_recess2_lecture_count == predefined_before_recess2_lecture_count) {
                    $('#before_recess2_lecture_table_3').addClass('java_hide');
                    $('#after_recess_lecture').removeAttr('disabled');
                }
                if (before_recess2_lecture_count < predefined_before_recess2_lecture_count) {
                    $('#before_recess2_lecture_table_3').removeClass('java_hide');
                    $('#after_recess_lecture').attr('disabled', true);
                    $('#next_before_recess2_lecture_information_detail').removeAttr('disabled');
                    $('#next_after_recess_lecture_information_detail').attr('disabled', true);
                    $('#bring_timetable_button').attr('disabled', true);
                }
                if (before_recess2_lecture_count > predefined_before_recess2_lecture_count) {
                    $('#next_before_recess_lecture_information_detail').attr('disabled', true);
                    $('#next_before_recess2_lecture_information_detail').attr('disabled', true);
                    $('#next_after_recess_lecture_information_detail').attr('disabled', true);
                    $('#bring_timetable_button').attr('disabled', true);
                    $('#before_recess2_lecture_table_3').removeClass('java_hide');
                }

            }

            if (lecture_area == "after_recess_lecture") {
                after_recess_lecture_count = parseFloat(after_recess_lecture_count) + parseFloat(single_lecture_count);

                $('#post_used_after_recess_lecture_count').text(after_recess_lecture_count);

                if (after_recess_lecture_count == predefined_after_recess_lecture_count) {
                    $('#after_recess_lecture_table_3').addClass('java_hide');
                }
                if (after_recess_lecture_count < predefined_after_recess_lecture_count) {
                    $('#after_recess_lecture_table_3').removeClass('java_hide');
                    $('#next_after_recess_lecture_information_detail').removeAttr('disabled');
                    $('#bring_timetable_button').attr('disabled', true);
                }
                if (after_recess_lecture_count > predefined_after_recess_lecture_count) {
                    $('#after_recess_lecture_table_3').removeClass('java_hide');
                    $('#next_after_recess_lecture_information_detail').attr('disabled', true);
                }

            }

        }
    }
}

//adding new lecture new row for entering information
function add_new_lecture(id) {
    var per_day_lecture_count = daily_lecture_count;
    var lecture_information_count = parseInt($('#post_lecture_information').val()) + parseInt(1);
    var class_table_name = $('#post_class_table_name').val();
    var type = "contain";
    $('#post_lecture_information').val(lecture_information_count);

    new_lecture_row = document.createElement('tr');

    if (id == "next_before_recess_lecture_information_detail") {
        var class_timming_id = "before_recess_lecture";
        $('#default_' + class_timming_id).addClass('hide');
    } else if (id == "next_before_recess2_lecture_information_detail") {
        var class_timming_id = "before_recess2_lecture";
        $('#default_' + class_timming_id).addClass('hide');
    } else if (id == "next_fullday_lecture_information_detail") {
        var class_timming_id = "fullday_lecture";
        $('#default_' + class_timming_id).addClass('hide');
    } else if (id == "next_after_recess_lecture_information_detail") {
        var class_timming_id = "after_recess_lecture";
        $('#default_' + class_timming_id).addClass('hide');
    } else {
        var class_timming_id = "all_area_lecture";
        $('#default_' + class_timming_id).addClass('hide');
    }

    $.post('class_lecture_detail_back.php',

        {
            lecture_information_display: lecture_information_count,
            class_timming_id: class_timming_id,
            post_per_day_lecture_count: per_day_lecture_count,
            post_type: type,
            class_table_name: class_table_name
        },

        function(data) {
            if (id == "next_before_recess_lecture_information_detail") {
                new_lecture_row.setAttribute("id", "new_before_recess_lecture" + lecture_information_count);
                $("#new_before_recess_lecture").append(new_lecture_row);
                $("#new_before_recess_lecture" + lecture_information_count).html(data);
                $('<input>', {
                    type: 'hidden',
                    id: 'post_lecture_area' + lecture_information_count,
                    name: 'post_lecture_area' + lecture_information_count,
                    value: 'before_recess_lecture'
                }).appendTo('form');
            } else if (id == "next_before_recess2_lecture_information_detail") {
                new_lecture_row.setAttribute("id", "new_before_recess2_lecture" + lecture_information_count);
                $("#new_before_recess2_lecture").append(new_lecture_row);
                $("#new_before_recess2_lecture" + lecture_information_count).html(data);
                $('<input>', {
                    type: 'hidden',
                    id: 'post_lecture_area' + lecture_information_count,
                    name: 'post_lecture_area' + lecture_information_count,
                    value: 'before_recess2_lecture'
                }).appendTo('form');
            } else if (id == "next_fullday_lecture_information_detail") {
                new_lecture_row.setAttribute("id", "new_fullday_lecture" + lecture_information_count);
                $("#new_fullday_lecture").append(new_lecture_row);
                $("#new_fullday_lecture" + lecture_information_count).html(data);
                $('<input>', {
                    type: 'hidden',
                    id: 'post_lecture_area' + lecture_information_count,
                    name: 'post_lecture_area' + lecture_information_count,
                    value: 'fullday_lecture'
                }).appendTo('form');
            } else if (id == "next_all_area_lecture_information_detail") {
                new_lecture_row.setAttribute("id", "new_all_area_lecture" + lecture_information_count);
                $("#new_all_area_lecture").append(new_lecture_row);
                $("#new_all_area_lecture" + lecture_information_count).html(data);
                $('<input>', {
                    type: 'hidden',
                    id: 'post_lecture_area' + lecture_information_count,
                    name: 'post_lecture_area' + lecture_information_count,
                    value: 'all_area_lecture'
                }).appendTo('form');
            } else {
                new_lecture_row.setAttribute("id", "new_after_recess_lecture" + lecture_information_count);
                $("#new_after_recess_lecture").append(new_lecture_row);
                $("#new_after_recess_lecture" + lecture_information_count).html(data);
                $('<input>', {
                    type: 'hidden',
                    id: 'post_lecture_area' + lecture_information_count,
                    name: 'post_lecture_area' + lecture_information_count,
                    value: 'after_recess_lecture'
                }).appendTo('form');

            }
            lecture_count();
        }
    );
}

//inserting subject
function insert_lecture(id, next_day_index) {
    //finding number from option id
    var idno_array = id.match(/(\d+)/);
    var no = idno_array[0];

    //inistlizing variable
    var insert_class_time_detail = "";
    var type = "button";
    var class_timming_id = "fullday_lecture";
    var per_day_lecture_count = daily_lecture_count;
    var lecture_information = $('#post_lecture_information').val();
    var class_table_name = $('#post_class_table_name').val();
    var lecture_area = $('#post_lecture_area' + no).val();
    var lecture_type = $('#post_lecture_type' + no).val();
    var lecture_count = $('#post_lecture_count' + no).val();
    var teacher_name = $('option:selected', '#post_teacher_name' + no).attr('value');
    var lecture_name = $('option:selected', '#post_lecture_name' + no).attr('value');
    var lecture_place_name = $('option:selected', '#post_lecture_place_name' + no).attr('value');

    if (no > 5) {
        var day = $('option:selected', '#post_day' + no).attr('id');
    } else {
        var day = no;
    }
    $.when(insert_information(insert_class_time_detail, no, lecture_area, teacher_name, lecture_name, lecture_type,
        lecture_place_name, lecture_count, day, class_table_name, next_day_index)).done(function() {
        if (typeof(next_day_index) == "undefined" && next_day_index == null || next_day_index > 5) {
            $('#next_all_area_lecture_information_detail').removeAttr("disabled");
            $.post('class_lecture_detail_back.php',

                {
                    lecture_information_display: lecture_information,
                    class_timming_id: class_timming_id,
                    post_per_day_lecture_count: per_day_lecture_count,
                    post_type: type,
                    class_table_name: class_table_name
                },

                function(data) {
                    $("#next_fullday_lecture_information_detail_td").html(data);
                }
            );
        }
    });

    function insert_information(insert_class_time_detail, no, lecture_area, teacher_name, lecture_name, lecture_type,
        lecture_place_name, lecture_count, day, class_table_name, next_day_index) {
        $.post('class_lecture_detail_back.php',

            {
                insert_class_time_detail: insert_class_time_detail,
                post_lecture_information: no,
                post_per_day_lecture_count: per_day_lecture_count,
                post_lecture_area: lecture_area,
                post_teacher_name: teacher_name,
                post_lecture_name: lecture_name,
                post_lecture_type: lecture_type,
                post_lecture_place_name: lecture_place_name,
                post_lecture_count: lecture_count,
                post_day: day,
                post_class_table_name: class_table_name
            },

            function(data) {
                if (next_day_index < 6) {
                    $('#post_teacher_name' + next_day_index).removeAttr("disabled");
                }
                $('#modify_' + no).removeClass('hide');
                $('#' + id).addClass('hide');

                $('#delete_' + no).attr('disabled', true);
                $('#post_teacher_name' + no).attr('disabled', true);
                $('#post_lecture_name' + no).attr('disabled', true);
                $('#post_lecture_place_name' + no).attr('disabled', true);
                $('#post_lecture_count' + no).attr('disabled', true);
                $('#display_lecture_available' + no).css("color", "grey");
                bring_timetable();
            }
        );
    }
}

//inserting subject
function modify_lecture(id) {
    //finding number from option id
    var idno_array = id.match(/(\d+)/);
    var no = idno_array[0];

    $('#insert_' + no).removeClass('hide');
    $('#' + id).addClass('hide');
    $('#delete_' + no).attr('disabled', true);
    $('#post_day' + no).attr('disabled', false);
    $('#post_lecture_name' + no).attr('disabled', false);
    $('#post_teacher_name' + no).attr('disabled', false);
    $('#post_lecture_name' + no).attr('disabled', false);
    $('#post_lecture_place_name' + no).attr('disabled', false);
    $('#post_lecture_count' + no).attr('disabled', false);
    $('#display_lecture_available' + no).css("color", "black");
}

//display timetable
function bring_timetable(first_arry_index) {
    if (first_arry_index == null && first_arry_index == undefined) {
        first_arry_index = 0;
    }
    var post_class_name = "<?php echo $class_table_name; ?>";
    $.post('class_lecture_detail_back.php', {
            display_class_name: post_class_name,
            first_arry_index: first_arry_index
        },

        function(data) {
            //$('#form').addClass('hide');
            //$('#timetable').removeClass('hide');
            $('#display_timetable').html(data);
        }
    );
}

//avilability checker
function avilability_checker() {
    $('#second_id_th').html("checking");
    $('#exchange').attr('disabled', true);
    var class_table_name = $('#post_class_table_name').val();
    var first_id = $('#first_id').val();

    $.when(finding_solt(class_table_name, first_id)).done(function() {
        setTimeout(function() {
            bring_timetable();
        }, 100);
    });

    function finding_solt(class_table_name, first_id) {
        $.post('class_lecture_detail_back.php', {
                class_table_name: class_table_name,
                first_id: first_id
            },

            function(data) {
                //$('#form').addClass('hide');
                //$('#timetable').removeClass('hide');
                $('#second_id_th').html(data);
            }
        );
    }
}

//exchange_enable
function exchange_enable() {
    $('#exchange').attr('disabled', false);
}

//excange
function exchange() {
    var first_id = $('#first_id').val();
    var second_id = $('option:selected', '#second_id').attr('value');
    var class_table_name = $('#post_class_table_name').val();

    $.when(finding_solt(class_table_name, first_id, second_id)).done(function() {
        setTimeout(function() {
            bring_timetable();
        }, 100);
    });

    function finding_solt(class_table_name, first_id, second_id) {
        $.post('class_lecture_detail_back.php', {
            class_table_name: class_table_name,
            first_id: first_id,
            second_id: second_id
        });
    }
}
</script>

<!--    <body onload="bring_timetable()"> 
        <div class="main_div">
            <div class="sub_top_div" id="display_timetable">
        </div>
         <div class="sub_bottom_div" id="lecture_information">
            <table class="lecture_information_table">
                <?php
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
                       $day_array=array('Monday','Tuesday','Wensday','Thursday','Friday','Saturday');
                        
                       for($a = 0; $a < 6; $a++)
                       {
                           if($closed_day != $a)
                           {
                ?>
                    <tr>
                        <th>Day</th>
                        <td><?php echo $day_array[$a]; ?></td>
                    </tr>
                    <tr>
                        <th>Teacher Name</th>
                        <td>
                            <select>
                                <option>
                                    <?php
                                    
                                    ?>
                                </option>
                            </select>
                        </td>
                    </tr>
                <?php
                           }
                       }
                   }
                ?>
            </table>
        </div>
        </div> 
    </body> 
    <script>
       function bring_timetable()
        {
            var post_class_name="<?php echo $class_table_name; ?>";
            $.post('class_lecture_detail_back.php',
                {
                    display_class_name        : post_class_name
                },
               
		        function(data)
                {
                    $('#display_timetable').html(data);
		        }
              ); 
        }
    </script> -->

</html>