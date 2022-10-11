<?php
//session start 
include('session.php');
include('userheader.php');
//connection to database
//include('user_connection.php');

//declaration global variable
$class_detail="";
$selection="";
$newdata="";
$class_table_name="";
$teacher_table_name="";
$teacher_detail_count="";

//identify type of time detail
if(isset($_POST['institute_time_detail']))
{
	  $type_name="Institute";
	/* Finding institute_time_detail table in database */
	$sql_query1="SELECT * FROM ".$login_session."_institute_time_detail";
	$result1=$conn->query($sql_query1);/* execution of query */
	if($result1 == "")
	{
		//not get institute_time_detail table in database
		$newdata="1";
		
		$button='
			<tr>
                <td><button type="submit" name="insert_institute_time_detail" id="insert_institute_time_detail" onclick=" loading();">Insert</button></td>
                <td></td>
                <td></td>
                <td><a href="index.php"><button type="clear" name="back" id="back" onclick=" loading();">Back</button></a></td>
            </tr>	
	';
	}
	else
	{
		//get institute_time_detail table in database
		$newdata="0";
		/* extractinng institute_time_detail table in database */
		$data = $result1->fetch_array();
		
		$button='
            <tr>    
                <td><button type="submit" name="update_institute_time_detail" id="update_institute_time_detail" onclick=" loading();">Update</button></td>
                <td></td>
                <td></td>
                <td><a href="index.php"><button type="clear" name="back" id="back" onclick=" loading();">Back</button></a></td>
            </tr>
	';
	}
			
}

if(isset($_POST['teacher_time_detail']))
{
    $selection='
	  <table width="100%" border="0" cellspacing="0" cellpadding="5">
		  <form method="POST" target="_self" action="time_detail.php" >
             <tr>
                <th scope="row" colspan="4">Select Teacher</th>
             </tr>
             <tr colspan="4">
                <th scope="row" >
                    <select name="select_teacher_name">
                     <option value="ns" >Not Selected</option>
					';
                        /* Finding teacher detail table in database */
	                    $sql_query2="SELECT * FROM ".$login_session."_teacher_detail";
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
                                    $selection.='
                                    <option value='.$teacher_first_name[$i]."_".$teacher_last_name[$i].'>'.$teacher_first_name[$i]." ".$teacher_last_name[$i].'</option>
                                    ';
                                }
                            }
                        }
     $selection.='
                    </select>
                </th>
				<td>
					<input type=submit class="check_teacher_name" id="check_teacher_name" value="Next" onclick=" loading();">
				</td>
             </tr>
		  </form>
	  </table>	
            ';		
}

if(isset($_POST['select_teacher_name']))
{
	$teacher_table_name=$login_session."_".$_POST['select_teacher_name'];	
    $type_name="Teacher";
	/* Finding teacher_time_detail table in database */
	$sql_query3="SELECT * FROM ".$teacher_table_name."_time_detail";
	$result3=$conn->query($sql_query3);/* execution of query */
	if($result3 == "")
	{
		//not get teacher_time_detail table in database
        
        /* Finding institute_time_detail table in database */
	   $sql_query4="SELECT * FROM ".$login_session."_institute_time_detail";
	   $result4=$conn->query($sql_query4);/* execution of query */
	   if($result4 == "")
	   {
		  //not get institute_time_detail table in database
		  echo "go home and insert institute time detail";
       }
       else
       {
           //get teacher_time_detail table in database
		  $newdata="0";
		  /* extractinng institute_time_detail table in database */
		  $data = $result4->fetch_array();
           $button='
			<tr>
                <td><button type="submit" name="insert_teacher_time_detail" id="insert_teacher_time_detail" onclick=" loading();">Insert</button></td>
                <td></td>
                <td></td>
                <td><a href="index.php"><button type="clear" name="back" id="back" onclick=" loading();">Back</button></a></td>
            </tr>		
	       ';
       }
	}
	else
	{
		//get teacher_time_detail table in database
		$newdata="0";
		/* extractinng institute_time_detail table in database */
		$data = $result3->fetch_array();
		
		$button='
            <tr>    
                <td><button type="submit" name="update_teacher_time_detail" id="update_teacher_time_detail" onclick=" loading();">Update</button></td>
                <td></td>
                <td></td>
                <td><a href="index.php"><button type="clear" name="back" id="back" onclick=" loading();">Back</button></a></td>
            </tr>
	';
	}
	
}

if(isset($_POST['class_time_detail']) || isset($_GET['class_time_detail']))
{
    $selection='
	<form method="post" target="_self" action="time_detail.php" >
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <th scope="col" colspan="2">Insert Class Details</th>
            </tr>
            <tr> 
                <td >
                    <input type="text" name="class_name" id="class_name" placeholder="Class Name">
                </td>
                <td>
                    <input type="text" name="class_div" id="class_div" placeholder="Class Div">
                </td>
           <td>
					<input type=submit class="check_class_name" id="check_class_name" value="Next" onclick=" loading();">
				</td>
             </tr>
        </table>
	</form>		
            ';
   
}

if(isset($_POST['class_name']))
{
	$class_table_name=$login_session."_".$_POST['class_name'].$_POST['class_div'];	
    $type_name="Class";
    
	/* Finding class_time_detail table in database */
	$sql_query5="SELECT * FROM ".$class_table_name."_time_detail";
	$result5=$conn->query($sql_query5);/* execution of query */
	if($result5 == "")
	{
        //not get class_time_detail table in database
        
        /* Finding institute_time_detail table in database */
	   $sql_query6="SELECT * FROM ".$login_session."_institute_time_detail";
	   $result6=$conn->query($sql_query6);/* execution of query */
	   if($result6 == "")
	   {
		  //not get institute_time_detail table in database
		  echo "go home and insert institute time detail";
       }
       else
       {
           //get teacher_time_detail table in database
		  $newdata="0";
		  /* extractinng institute_time_detail table in database */
		  $data = $result6->fetch_array();
           $class_detail='
            <tr>
                <th scope="row" colspan="4">Student Detail</th>
            </tr>
            <tr>  
				<th scope="row" >how many Student are there in class ?</th>
				<td> <input type="number" name="post_student_count" id="post_student_count" min="1" max="300" ></td>
				<td> </td>
                <td> </td>
            </tr>
            <tr>  
				<th scope="row" >how many Batch are there in pratical ?</th>
				<td> <input type="number" name="post_batch_count" id="post_batch_count" min="1" max="10" ></td>
				<td> </td>
                <td> </td>
            </tr>
            ';
			
		  $button='
			<tr>
                <td><button type="submit" name="insert_class_time_detail" id="insert_class_time_detail" onclick=" loading();">Insert</button></td>
                <td></td>
                <td></td>
                <td><a href="index.php"><button type="clear" name="back" id="back" onclick=" loading();">Back</button></a></td>
            </tr>	
	       ';
       }
		
	}
	else
	{
		//get class_time_detail table in database
		$newdata="0";
		/* extractinng class_time_detail table in database */
		$data = $result5->fetch_array();
		
		$class_detail='
            <tr>
                <th scope="row" colspan="4">Student Detail</th>
            </tr>
            <tr>  
				<th scope="row" >how many Student are there in class ?</th>
				<td> <input type="number" name="post_student_count" id="post_student_count" min="1" max="300" value="'.$data['col_student_count'].'"></td>
				<td> </td>
                <td> </td>
            </tr>
            <tr>  
				<th scope="row" >how many Batch are there in pratical ?</th>
				<td> <input type="number" name="post_batch_count" id="post_batch_count" min="1" max="10" value="'.$data['col_batch_count'].'"></td>
				<td> </td>
                <td> </td>
            </tr>
            ';
			
		$button='
            <tr>    
                <td><button type="submit" name="update_class_time_detail" id="update_class_time_detail" onclick=" loading();">Update</button></td>
                <td></td>
                <td></td>
                <td><a href="index.php"><button type="clear" name="back" id="back">Back</button></a></td>
            </tr>
	';
	}
	
}
?>
<!DOCTYPE html PUBLIC>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel="stylesheet" href="css/styles.css">
    <script type="text/javascript" src="javascript/jQuery 3.5.1.js"></script>
    <title>Time Detail</title>
</head>

<body style="color:black;">
    <div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section class="s-12 l-11">

    <!-- section of techer/class -->
    <?php 
  echo $selection;
if($newdata == "1")
{
echo '
<form method="post" target="_self" action="time_detail_back.php" >
	<input type=hidden id=post_class_name name=post_class_name value="'.$class_table_name.'">
	<input type=hidden id=post_teacher_name name=post_teacher_name value="'.$teacher_table_name.'">
    <table width="100%" border="1" cellspacing="1" cellpadding="1">
            <!-- time detail -->
            <tr>
                <th scope="row" colspan="4">'. $type_name.' Time Detail[<b style="color:red;"> Fill Time Detail As per 24 Hour </b>]</th>
            </tr>
			<tr>
				<th scope="row">Start Time</th>
				<td>
                    <input type="number" name="post_institute_strat_hour" id="post_institute_strat_hour" placeholder="hour"  min="1" max="24" autofocus  >
				</td>
				<td>
                    <input type="number" name="post_institute_strat_minute" id="post_institute_strat_minute" placeholder=" minute" min="0" max="60" autofocus  >
				</td>
				<td>
                    <select name="post_institute_start_amorpm">
                        <option value="Ns" >Not selected</option>
                        <option value="Am" >Am</option>
                        <option value="Pm">Pm</option>
                    </select>
                </td>
			</tr>
			<tr>
				<th scope="row">End Time</th>
				<td>
                    <input type="number" name="post_institute_end_hour" id="post_institute_end_hour" placeholder="hour"  min="1" max="24" autofocus  >
				</td>
				<td>
                    <input type="number" name="post_institute_end_minute" id="post_institute_end_minute" placeholder=" minute"  min="0" max="60" autofocus >
				</td>
				<td>
                    <select name="post_institute_end_amorpm">
                        <option value="Ns" >Not selected</option>
                        <option value="Am" >Am</option>
                        <option value="Pm">Pm</option>
                    </select>
                </td>
			</tr>
			
            <!-- recess detail -->
            <tr> 
				<th scope="row" >how many recess will there on each day ?</th>
				<td><input type="radio" id="first_recess" name="post_recess_count" value="1" checked> 1</td> 
                <td><input type="radio" id="second_recess" name="post_recess_count" value="2"> 2</td> 
				<td> </td>						
            </tr> 
             
            <!-- recess 1 time detail -->
            <tr>
                <th scope="row" colspan="4">Recess Time Detail</th>
            </tr>
            <tr>
				<th scope="row">Start Time</th>
				<td>
                    <input type="number" name="post_first_recess_strat_hour" id="post_first_recess_strat_hour" placeholder="hour" min="1" max="24" autofocus  >
				</td>
				<td>
                    <input type="number" name="post_first_recess_strat_minute" id="post_first_recess_strat_minute" placeholder=" minute"  min="0" max="60" autofocus  >
				</td>
				<td>
                    <select name="post_first_recess_start_amorpms">
                        <option value="Ns" >Not selected</option>
                        <option value="Am" >Am</option>
                        <option value="Pm">Pm</option>
                    </select>
                </td>
			</tr>
			<tr>
				<th scope="row">End Time</th>
				<td>
                    <input type="number" name="post_first_recess_end_hour" id="post_first_recess_end_hour" placeholder="hour"  min="1" max="24" autofocus  >
				</td>
				<td>
                    <input type="number" name="post_first_recess_end_minute" id="post_first_recess_end_minute" placeholder=" minute"  min="0" max="60" autofocus  >
				</td>
				<td>
                    <select name="post_first_recess_end_amorpms">
                        <option value="Ns" >Not selected</option>
                        <option value="Am" >Am</option>
                        <option value="Pm">Pm</option>
                    </select>
                </td>
			</tr>
            
             <!-- recess 2 time detail -->
            <tr class="second_recess_tr hides">
                <th scope="row" colspan="4">Second Recess Time Detail</th>
            </tr>
            <tr class="second_recess_tr hides">
				<th scope="row">Start Time</th>
				<td>
                    <input type="number" name="post_second_recess_strat_hour" id="post_second_recess_strat_hour" placeholder="hour"  min="1" max="24" autofocus  >
				</td>
				<td>
                    <input type="number" name="post_second_recess_strat_minute" id="post_second_recess_strat_minute" placeholder=" minute"  min="0" max="60" autofocus  >
				</td>
				<td>
                    <select name="post_second_recess_start_amorpms">
                        <option value="Ns" >Not selected</option>
                        <option value="Am" >Am</option>
                        <option value="Pm" >Pm</option>
                    </select>
                </td>
			</tr>
			<tr class="second_recess_tr hides">
				<th scope="row">End Time</th>
				<td>
                    <input type="number" name="post_second_recess_end_hour" id="post_second_recess_end_hour" placeholder="hour"  min="1" max="24" autofocus  >
				</td>
				<td>
                    <input type="number" name="post_second_recess_end_minute" id="post_second_recess_end_minute" placeholder=" minute"  min="0" max="60" autofocus  >
				</td>
				<td>
                    <select name="post_second_recess_end_amorpms">
                        <option value="Ns" >Not selected</option>
                        <option value="Am" >Am</option>
                        <option value="Pm">Pm</option>
                    </select>
                </td>
			</tr>
            
            <!-- student detail -->
             '.$class_detail.'
        
            <!-- lecture detail -->
            <tr>
                <th scope="row" colspan="4">Lecture Detail</th>
            </tr>
            <tr> 
				<th scope="row">Timming gap of per lecture</th>
				<td> <input type="number" name="post_lecture_gap_time" id="post_lecture_gap_time" placeholder="lecture_gap_time" min="1" max="60" value=" " onkeyup="lecture_count();"></td>
				<td></td>
				<td> </td>
            </tr>
			<tr> 
				<th scope="row">how many period will there in a day ?</th>
				<td id="post_daily_lecture_count_display"> <input type="number" name="post_daily_lecture_count" id="post_daily_lecture" placeholder="Daily Lecture Count" readonly></td>
				<td> </td>
				<td> </td>
			</tr>	
			<tr> 
				<th scope="row">Whether institute will remain close in weekdays(included saturday) ?</th>
				<td><input type="radio" id="holiday_yes" name="post_holiday" value="1" checked> Yes</td> 
                <td><input type="radio" id="holiday_no" name="post_holiday" value="0"> No</td> 
				<td> </td>
            </tr> 
            <tr class="holiday_yes_tr"> 
				<th scope="row" >on which day institute will remain close ?</th>
                <td> 
                    <select name="post_closed_day">
						<option value="ns">Not Selected</option>
                        <option value="0">Monday</option>
                        <option value="1">Tuesday</option>
                        <option value="2">Wensday</option>
				        <option value="3">thursday</option>
                        <option value="4">friday</option>
                        <option value="5">saturday</option>
                    </select>
                </td>
				<td> </td>
				<td> </td>
            </tr> 
            <tr class="holiday_no_tr hides"> 
				<th scope="row" >Whether institute having halfday ?</th>
				<td><input type="radio" id="halfday_yes" name="post_halfday" value="1" checked> Yes</td> 
                <td><input type="radio" id="halfday_no" name="post_halfday" value="0" > No</td> 
				<td> </td>
            </tr> 
            <tr class="holiday_no_tr halfday_yes_tr hides"> 
				<th scope="row" >on which day institute having halfday ?</th>
                <td> 
                    <select name="post_opened_day">
                        <option value="ns">Not Selected</option>
                        <option value="0">Monday</option>
                        <option value="1">Tuesday</option>
				        <option value="2">Wensday</option>
				        <option value="3">thursday</option>
                        <option value="4">friday</option>
                        <option value="5">saturday</option>
                    </select>
                </td>
				<td> </td>
				<td> </td>
            </tr> 
            <tr class="holiday_no_tr halfday_yes_tr hides">  
				<th scope="row" >how many lecture will there ?</th>
				<td colspan="1"> <input type="number" name="post_halfday_lecture_count" min="1" max="10" placeholder="Halfday Lecture Count"></td>
				<td> </td>
				<td> </td>
            </tr>	
            '.$button.'
		</table>	
</form>
  ';         
}
if($newdata == "0")
{
  echo '
<form method="post" target="_self" action="time_detail_back.php" width="80%">
	<input type=hidden id=post_class_name name=post_class_name value="'.$class_table_name.'">
	<input type=hidden id=post_teacher_name name=post_teacher_name value="'.$teacher_table_name.'">
    <table width="100%" border="1" cellspacing="1" cellpadding="1">
            <!-- time detail -->
            <tr>
                <th scope="row" colspan="4">'. $type_name.' Time Detail[<b style="color:red;"> Fill Time Detail As per 24 Hour </b>]</th>
            </tr>
			<tr>
				<th scope="row">Start Time</th>
				<td>
                    <input type="number" name="post_institute_strat_hour" id="post_institute_strat_hour" placeholder="hour"  min="1" max="24" value="'.$data['col_institute_start_hour'].'" >
				</td>
				<td>
                    <input type="number" name="post_institute_strat_minute" id="post_institute_strat_minute" placeholder=" minute" min="0" max="60" value="'.$data['col_institute_start_minute'].'" >
				</td>
				<td>
                    <select name="post_institute_start_amorpm" class="hides">
                        <option value="'.$data['col_institute_start_amorpm'].'" >'.$data['col_institute_start_amorpm'].'</option>';
						if($data['col_institute_start_amorpm'] != "Am")
						{
							echo '<option value="Am" >Am</option>';
						}
						if($data['col_institute_start_amorpm'] != "Pm")
						{
							echo '<option value="Pm">Pm</option>';
						}							
              echo '</select>
                </td>
			</tr>
			<tr>
				<th scope="row">End Time</th>
				<td>
                    <input type="number" name="post_institute_end_hour" id="post_institute_end_hour" placeholder="hour"  min="1" max="24" autofocus value="'.$data['col_institute_end_hour'].'" >
				</td>
				<td>
                    <input type="number" name="post_institute_end_minute" id="post_institute_end_minute" placeholder=" minute"  min="0" max="60" autofocus value="'.$data['col_institute_end_minute'].'" >
				</td>
				<td>
                    <select name="post_institute_end_amorpm" class="hides">
                        <option value="'.$data['col_institute_end_amorpm'].'" >'.$data['col_institute_end_amorpm'].'</option>';
						if($data['col_institute_end_amorpm'] != "Am")
						{
							echo '<option value="Am" >Am</option>';
						}
						if($data['col_institute_end_amorpm'] != "Pm")
						{
							echo '<option value="Pm">Pm</option>';
						}							
              echo '</select>
                </td>
			</tr>
            <!-- recess detail -->
            <tr> 
				<th scope="row" >how many recess will there on each day ?</th>';
				if($data['col_recess_count'] != "2")
				{
					echo '<td>
                            <input type="radio" id="first_recess" name="post_recess_count" value="1" checked> 1
                        </td> 
				        <td>
                            <input type="radio" id="second_recess" name="post_recess_count" value="2"> 2
                        </td> ';
				}
				else
				{
					echo '<td>
                            <input type="radio" id="first_recess" name="post_recess_count" value="1" > 1
                        </td> 
				        <td>
                            <input type="radio" id="second_recess" name="post_recess_count" value="2" checked > 2
                        </td> ';
				}							
			   
	echo	'<td> </td>						
            </tr> 
             
            <!-- recess 1 time detail -->
            <tr>
                <th scope="row" colspan="4">Recess Time Detail</th>
            </tr>
            <tr>
				<th scope="row">Start Time</th>
				<td>
                    <input type="number" name="post_first_recess_strat_hour" id="post_first_recess_strat_hour" placeholder="hour" min="1" max="24" autofocus value="'.$data['col_first_recess_start_hour'].'" >
				</td>
				<td>
                    <input type="number" name="post_first_recess_strat_minute" id="post_first_recess_strat_minute" placeholder=" minute"  min="0" max="60" autofocus value="'.$data['col_first_recess_start_minute'].'" >
				</td>
				<td>
                    <select name="post_first_recess_start_amorpms" class="hides">
                        <option value="'.$data['col_first_recess_start_amorpm'].'" >'.$data['col_first_recess_start_amorpm'].'</option>';
						if($data['col_first_recess_start_amorpm'] != "Am")
						{
							echo '<option value="Am" >Am</option>';
						}
						if($data['col_first_recess_start_amorpm'] != "Pm")
						{
							echo '<option value="Pm">Pm</option>';
						}							
              echo '</select>
                </td>
			</tr>
			<tr>
				<th scope="row">End Time</th>
				<td>
                    <input type="number" name="post_first_recess_end_hour" id="post_first_recess_end_hour" placeholder="hour"  min="1" max="24" autofocus value="'.$data['col_first_recess_end_hour'].'" >
				</td>
				<td>
                    <input type="number" name="post_first_recess_end_minute" id="post_first_recess_end_minute" placeholder=" minute"  min="0" max="60" autofocus value="'.$data['col_first_recess_end_minute'].'" >
				</td>
				<td>
                    <select name="post_first_recess_end_amorpms" class="hides">
                        <option value="'.$data['col_first_recess_end_amorpm'].'" >'.$data['col_first_recess_end_amorpm'].'</option>';
						if($data['col_first_recess_end_amorpm'] != "Am")
						{
							echo '<option value="Am" >Am</option>';
						}
						if($data['col_first_recess_end_amorpm'] != "Pm")
						{
							echo '<option value="Pm">Pm</option>';
						}							
              echo '</select>
                </td>
			</tr>
            
             <!-- recess 2 time detail -->
            <tr class="second_recess_tr hides">';
    
               echo ' <th scope="row" colspan="4">Second Recess Time Detail</th>
            </tr>
            <tr  class="second_recess_tr hides">
				 <th scope="row">Start Time</th>
				<td>
                    <input type="number" name="post_second_recess_strat_hour" id="post_second_recess_strat_hour" placeholder="hour"  min="1" max="24" autofocus value="'.$data['col_second_recess_start_hour'].'" >
				</td>
				<td>
                  <input type="number" name="post_second_recess_strat_minute" id="post_second_recess_strat_minute" placeholder=" minute"  min="0" max="60" autofocus value="'.$data['col_second_recess_start_minute'].'" >
				</td>
				<td>
                    <select name="post_second_recess_start_amorpms" class="hides">
                        <option value="'.$data['col_second_recess_start_amorpm'].'" >'.$data['col_second_recess_start_amorpm'].'</option>';
						if($data['col_second_recess_start_amorpm'] != "Am")
						{
							echo '<option value="Am" >Am</option>';
						}
						if($data['col_second_recess_start_amorpm'] != "Pm")
						{
							echo '<option value="Pm">Pm</option>';
						}							
              echo '</select>
                </td>
			</tr>
			<tr  class="second_recess_tr hides">
				<th scope="row">End Time</th>
				<td>
                    <input type="number" name="post_second_recess_end_hour" id="post_second_recess_end_hour" placeholder="hour"  min="1" max="24" autofocus  value="'.$data['col_second_recess_end_hour'].'" >
				</td>
				<td>
                    <input type="number" name="post_second_recess_end_minute" id="post_second_recess_end_minute" placeholder=" minute"  min="0" max="60" autofocus  value="'.$data['col_second_recess_end_minute'].'" >
				</td>
				<td>
                    <select name="post_second_recess_end_amorpms" class="hides">
                        <option value="'.$data['col_second_recess_end_amorpm'].'" >'.$data['col_second_recess_end_amorpm'].'</option>';
						if($data['col_second_recess_end_amorpm'] != "Am")
						{
							echo '<option value="Am" >Am</option>';
						}
						if($data['col_second_recess_end_amorpm'] != "Pm")
						{
							echo '<option value="Pm">Pm</option>';
						}							
              echo '</select>
                </td>';

			echo '</tr>
            
            <!-- student detail -->
             '.$class_detail.'
        
            <!-- lecture detail -->
            <tr>
                <th scope="row" colspan="4">Lecture Detail</th>
            </tr>';
			if(!isset($data['col_lecture_gap_time']))
				{
					echo '
					<tr> 
						<th scope="row">Timming gap of per lecture</th>
						<td> <input type="number" name="post_lecture_gap_time" id="post_lecture_gap_time" placeholder="lecture_gap_time" min="1" max="60" value=" " onkeyup="lecture_count();"></td>
						<td></td>
						<td> </td>
					</tr>';
				}
				else
				{
					echo '
					<tr> 
						<th scope="row">Timming gap of per lecture</th>
						<td> <input type="number" name="post_lecture_gap_time" id="post_lecture_gap_time" placeholder="lecture_gap_time" min="1" max="60" value="'.$data['col_lecture_gap_time'].'" onkeyup="lecture_count();"></td>
						<td></td>
						<td> </td>
					</tr>';
				}
     echo '  <tr> 
				<th scope="row">how many period will there in a day ?</th>
				<td id="post_daily_lecture_count_display"><input type="number" name="post_daily_lecture_count" id="post_daily_lecture" placeholder="Daily Lecture Count" min="1" max="10" value="'.$data['col_daily_lecture_count'].'" readonly ></td>
				<td></td>
				<td> </td>
            </tr>
            <tr> 
				<th scope="row">Whether institute will remain close in weekdays(included saturday) ?</th>';
				if($data['col_holiday'] != "0")
				{
					echo ' <td>
                                <input type="radio" id="holiday_yes" name="post_holiday" value="1" checked> Yes
                            </td> 
				            <td>
                                <input type="radio" id="holiday_no" name="post_holiday" value="0"> No
                            </td>  ';
				}
				else
				{
					echo '<td>
                                <input type="radio" id="holiday_yes" name="post_holiday" value="1" > Yes
                            </td> 
				            <td>
                                <input type="radio" id="holiday_no" name="post_holiday" value="0" checked> No
                            </td>   ';
				}							
			   
	echo	'<td> </td>
            </tr> 
            <tr class="holiday_yes_tr"> 
				<th scope="row" >on which day institute will remain close ?</th>
                <td> 
                    <select name="post_closed_day">';
						$first_option=$data['col_closed_day'];
					    $day_array=array('Monday','Tuesday','Wensday','Thursday','Friday','Saturday');
						
						echo '
							<option value="'.$first_option.'">'.$day_array[$first_option].'</option>
						  ';
						
						for($i=0;$i < 6;$i++)
						{
							if($data['col_closed_day'] != $i)
							{
								echo '<option value="'.$i.'">'.$day_array[$i].'</option>';
							}
						}
						
              echo '</select>
                </td>
				<td> </td>
				<td> </td>
            </tr> 
            <tr class="holiday_no_tr hides"> 
				<th scope="row" >Whether institute having halfday ?</th>';
				if($data['col_halfday'] != "0")
				{
					echo '<td>
                            <input type="radio" id="halfday_yes" name="post_halfday" value="1" checked> Yes
                          </td> 
				          <td>
                            <input type="radio" id="halfday_no" name="post_halfday" value="0"> No
                          </td>  ';
				}
				else
				{
					echo '<td>
                            <input type="radio" id="halfday_yes" name="post_halfday" value="1" > Yes
                          </td> 
				          <td>
                            <input type="radio" id="halfday_no" name="post_halfday" value="0" checked> No
                          </td>  ';
				}							
			   
	echo	'<td> </td>
            </tr> 
            <tr class="holiday_no_tr halfday_yes_tr hides"> 
				<th scope="row" >on which day institute having halfday ?</th>
                <td> 
                    <select name="post_opened_day">';
						$first_option=$data['col_opened_day'];
					    $day_array=array('Monday','Tuesday','Wensday','Thursday','Friday','Saturday');
						
						echo '
							<option value="'.$first_option.'">'.$day_array[$first_option].'</option>
						  ';
						
						for($i=0;$i < 6;$i++)
						{
							if($data['col_opened_day'] != $i)
							{
								echo '<option value="'.$i.'">'.$day_array[$i].'</option>';
							}
						}
						
              echo '</select>
                </td>
				<td> </td>
				<td> </td>
            </tr> 
            <tr class="holiday_no_tr halfday_yes_tr hides">';  
     if($data['col_halfday_lecture_count'] != "0"){
				echo '<th scope="row" >how many lecture will there ?</th>
				<td colspan="1"> <input type="number" name="post_halfday_lecture_count" min="1" max="10" placeholder="Halfday Lecture Count" value="'.$data['col_halfday_lecture_count'].'" ></td>
				<td> </td>
				<td> </td>';
     }
            echo '</tr>	
            '.$button.'
		</table>	
</form>
  ';
?>
    <script>
        //getting value of hoiday ,recess,halfday
        var col_recess_count = "<?php echo $data['col_recess_count']; ?>";
        var col_holiday = "<?php echo $data['col_holiday']; ?>";
        var col_halfday = "<?php echo $data['col_halfday']; ?>";

        if (col_recess_count != 2) {
            $('.second_recess_tr').addClass('hides');
        } else {
            $('.second_recess_tr').removeClass('hides');
        }

        if (col_holiday != 0) {
            $('.holiday_no_tr').addClass('hides');
            $('.holiday_yes_tr').removeClass('hides');
        } else {
            $('.holiday_no_tr').removeClass('hides');
            $('.holiday_yes_tr').addClass('hides');
        }

        if (col_halfday != 0 && col_holiday == 0) {
            $('.halfday_yes_tr').removeClass('hides');
        } else {
            $('.halfday_yes_tr').addClass('hides');
        }

    </script>
    <?php
}  
?>
    <!-- Modal for full size images on click-->
    <div id="modal01" class="modal" style="display:none;width:100%;height:100%;background-color:rgba(0,0,0,0.1);position: absolute;left: 0%;top: 0%;z-index: 9999;">
        <center style="color:white;padding-top: 20%;">
            <div class="loader"></div>
            <!--<h4 id="text_for_loading"><h4>
				<span id="close" class="close" >OK</span>-->
        </center>
    </div>
            </section>
            </div>
         </div>
      </div>
</body>
<script>
    // Get the modal
    var modal = document.getElementById("modal01");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    //span.onclick = function() {modal.style.display = "none";span.style.display = "none";}

    function loading() {
        document.getElementById("modal01").style.display = "block";
    }

    //count of per day lecture
    function lecture_count() {
        var institute_strat_hour = $('#post_institute_strat_hour').val();
        var institute_start_minute = $('#post_institute_strat_minute').val();
        var institute_end_hour = $('#post_institute_end_hour').val();
        var institute_end_minute = $('#post_institute_end_minute').val();
        var first_recess_start_hour = $('#post_first_recess_strat_hour').val();
        var first_recess_start_minute = $('#post_first_recess_strat_minute').val();
        var first_recess_end_hour = $('#post_first_recess_end_hour').val();
        var first_recess_end_minute = $('#post_first_recess_end_minute').val();
        var second_recess_start_hour = $('#post_second_recess_strat_hour').val();
        var second_recess_start_minute = $('#post_second_recess_strat_minute').val();
        var second_recess_end_hour = $('#post_second_recess_end_hour').val();
        var second_recess_end_minute = $('#post_second_recess_end_minute').val();
        var recess_count = $('input[name=post_recess_count]:checked').val();
        var lecture_gap_time = $('#post_lecture_gap_time').val();
        var lecture_count = "";
console.log(lecture_gap_time);
        if (typeof(lecture_gap_time) != "undefined" && lecture_gap_time != null && lecture_gap_time > 10) {
            console.log(lecture_gap_time);
            $('#post_daily_lecture_count_display').html('loading...');

            $.post('time_detail_back.php', {
                    post_lecture_count: lecture_count,
                    post_institute_strat_hour: institute_strat_hour,
                    post_institute_strat_minute: institute_start_minute,
                    post_institute_end_hour: institute_end_hour,
                    post_institute_end_minute: institute_end_minute,
                    post_first_recess_strat_hour: first_recess_start_hour,
                    post_first_recess_strat_minute: first_recess_start_minute,
                    post_first_recess_end_hour: first_recess_end_hour,
                    post_first_recess_end_minute: first_recess_end_minute,
                    post_second_recess_strat_hour: second_recess_start_hour,
                    post_second_recess_strat_minute: second_recess_start_minute,
                    post_second_recess_end_hour: second_recess_end_hour,
                    post_second_recess_end_minute: second_recess_end_minute,
                    post_recess_count: recess_count,
                    post_lecture_gap_time: lecture_gap_time
                },
                function(data) {
                console.log(data);
                    $('#post_daily_lecture_count_display').html(data);
                }
            );
        }
    }

    //hides tab
    $(document).ready(function() {

        $('#first_recess').click(function() {
            $('.second_recess_tr').addClass('hides');
        });

        $('#second_recess').click(function() {
            $('.second_recess_tr').removeClass('hides');
        });

        $('#holiday_yes').click(function() {
            $('.holiday_no_tr').addClass('hides');
            $('.holiday_yes_tr').removeClass('hides');
        });

        $('#holiday_no').click(function() {
            $('.holiday_no_tr').removeClass('hides');
            $('.holiday_yes_tr').addClass('hides');
        });

        $('#halfday_yes').click(function() {
            $('.halfday_yes_tr').removeClass('hides');
        });

        $('#halfday_no').click(function() {
            $('.halfday_yes_tr').addClass('hides');
        });

    });

</script>

</html>
