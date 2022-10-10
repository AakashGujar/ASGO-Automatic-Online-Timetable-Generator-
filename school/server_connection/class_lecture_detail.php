<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection to database
include('user_connection.php');

if(isset($_POST['class_lecture_detail']))
{
	echo "<h1>under development</h1>";
}
else if(isset($_POST['class_time_detail']))
{
	header('Location:time_detail.php?class_time_detail=class');
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
<body>
    <form>
        <div id="hidden_data">
        </div>
        <table width="100%" border="1" cellspacing="1" cellpadding="1">
            <tr>
                <th scope="row">All First Lecture Information</th>
            </tr>
        </table>
        <table width="90%" border="1" cellspacing="5" cellpadding="3">
			<tr>
                <th scope="row">Lecture Information Count</th>
                <th scope="row">Day</th>
                <th scope="row">Name Of Teacher</th>
                <th scope="row">Name Of Lecture</th>
                <th scope="row">Name Of Place Where Lecture Will Held</th>
                <th scope="row">Enter Total Number Of This Lecture In Week</th>
			</tr>
            <tr>
                <td id="post_lecture_information">1</td>
                <td id="post_day1">Monday</td>
                <td>
                    <select name="post_teacher_name1" id="post_teacher_name1">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
                                    echo '
                                    <option value='.$teacher_first_name[$i]."_".$teacher_last_name[$i].'>'.$teacher_first_name[$i]." ".$teacher_last_name[$i].'</option>
                                    ';
                                }
                            }
                        }
                        
                        ?>
                    </select>
                </td>
                <td>
                    <select name="post_lecture_name1" id="post_lecture_name1" onchange="display_lecture_type_option(this.id);">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
			                  while($data2=$result2->fetch_array())
			                 {
                                /* storing data from teacher detail table to array variable*/
				                $srno[]							= $data2['srno'];
				                $lecture_full_name[]			= $data2['col_lecture_full_name'];
				                $lecture_short_name[]			= $data2['col_lecture_short_name'];
				                $lecture_type[]			        = $data2['col_lecture_type'];
				                $lecture_place[]			    = $data2['col_lecture_place'];
			                 }
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
                <td id="display_lecture_place_option1">
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                </td>
                <td>
                    <select id="post_lecture_count1" name="post_lecture_count1">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                    </select>
                </td>
			</tr>
             <tr>
                 <td id="post_lecture_information1">2</td>
                <td id="day2">Tuesday</td>
                <td>
                    <select name="post_teacher_name2" id="post_teacher_name2">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
                                    echo '
                                    <option value='.$teacher_first_name[$i]."_".$teacher_last_name[$i].'>'.$teacher_first_name[$i]." ".$teacher_last_name[$i].'</option>
                                    ';
                                }
                            }
                        }
                        
                        ?>
                    </select>
                </td>
                <td>
                    <select name="post_lecture_name2" id="post_lecture_name2" onchange="display_lecture_type_option(this.id);">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
			                  while($data2=$result2->fetch_array())
			                 {
                                /* storing data from teacher detail table to array variable*/
				                $srno[]							= $data2['srno'];
				                $lecture_full_name[]			= $data2['col_lecture_full_name'];
				                $lecture_short_name[]			= $data2['col_lecture_short_name'];
				                $lecture_type[]			        = $data2['col_lecture_type'];
				                $lecture_place[]			    = $data2['col_lecture_place'];
			                 }
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
                <td id="display_lecture_place_option2">
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                </td>
                <td>
                    <select id="post_lecture_count2" name="post_lecture_count2">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td id="post_lecture_information3">3</td>
                <td id="day3">Wensday</td>
                <td>
                    <select name="post_teacher_name3" id="post_teacher_name3">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
                                    echo '
                                    <option value='.$teacher_first_name[$i]."_".$teacher_last_name[$i].'>'.$teacher_first_name[$i]." ".$teacher_last_name[$i].'</option>
                                    ';
                                }
                            }
                        }
                        
                        ?>
                    </select>
                </td>
                <td>
                    <select name="post_lecture_name3" id="post_lecture_name3" onchange="display_lecture_type_option(this.id);">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
			                  while($data2=$result2->fetch_array())
			                 {
                                /* storing data from teacher detail table to array variable*/
				                $srno[]							= $data2['srno'];
				                $lecture_full_name[]			= $data2['col_lecture_full_name'];
				                $lecture_short_name[]			= $data2['col_lecture_short_name'];
				                $lecture_type[]			        = $data2['col_lecture_type'];
				                $lecture_place[]			    = $data2['col_lecture_place'];
			                 }
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
                <td id="display_lecture_place_option3">
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                </td>
                <td>
                    <select id="post_lecture_count3" name="post_lecture_count3">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td id="post_lecture_information">4</td>
                <td id="day4">Thursday</td>
                <td>
                    <select name="post_teacher_name4" id="post_teacher_name4">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
                                    echo '
                                    <option value='.$teacher_first_name[$i]."_".$teacher_last_name[$i].'>'.$teacher_first_name[$i]." ".$teacher_last_name[$i].'</option>
                                    ';
                                }
                            }
                        }
                        
                        ?>
                    </select>
                </td>
                <td>
                    <select name="post_lecture_name4" id="post_lecture_name4" onchange="display_lecture_type_option(this.id);">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
			                  while($data2=$result2->fetch_array())
			                 {
                                /* storing data from teacher detail table to array variable*/
				                $srno[]							= $data2['srno'];
				                $lecture_full_name[]			= $data2['col_lecture_full_name'];
				                $lecture_short_name[]			= $data2['col_lecture_short_name'];
				                $lecture_type[]			        = $data2['col_lecture_type'];
				                $lecture_place[]			    = $data2['col_lecture_place'];
			                 }
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
                <td id="display_lecture_place_option4">
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                </td>
                <td>
                    <select id="post_lecture_count4" name="post_lecture_count4">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td id="post_lecture_information">5</td>
                <td id="day5">Friday</td>
                <td>
                    <select name="post_teacher_name5" id="post_teacher_name5">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
                                    echo '
                                    <option value='.$teacher_first_name[$i]."_".$teacher_last_name[$i].'>'.$teacher_first_name[$i]." ".$teacher_last_name[$i].'</option>
                                    ';
                                }
                            }
                        }
                        
                        ?>
                    </select>
                </td>
                <td>
                    <select name="post_lecture_name5" id="post_lecture_name5" onchange="display_lecture_type_option(this.id);">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
			                  while($data2=$result2->fetch_array())
			                 {
                                /* storing data from teacher detail table to array variable*/
				                $srno[]							= $data2['srno'];
				                $lecture_full_name[]			= $data2['col_lecture_full_name'];
				                $lecture_short_name[]			= $data2['col_lecture_short_name'];
				                $lecture_type[]			        = $data2['col_lecture_type'];
				                $lecture_place[]			    = $data2['col_lecture_place'];
			                 }
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
                <td id="display_lecture_place_option5">
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                </td>
                <td>
                    <select id="post_lecture_count5" name="post_lecture_count5">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td id="post_lecture_information">6</td>
                <td id="day6">Saturday</td>
                <td>
                    <select name="post_teacher_name6" id="post_teacher_name6">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
                                    echo '
                                    <option value='.$teacher_first_name[$i]."_".$teacher_last_name[$i].'>'.$teacher_first_name[$i]." ".$teacher_last_name[$i].'</option>
                                    ';
                                }
                            }
                        }
                        
                        ?>
                    </select>
                </td>
                <td>
                    <select name="post_lecture_name6" id="post_lecture_name6" onchange="display_lecture_type_option(this.id);">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
			                  while($data2=$result2->fetch_array())
			                 {
                                /* storing data from teacher detail table to array variable*/
				                $srno[]							= $data2['srno'];
				                $lecture_full_name[]			= $data2['col_lecture_full_name'];
				                $lecture_short_name[]			= $data2['col_lecture_short_name'];
				                $lecture_type[]			        = $data2['col_lecture_type'];
				                $lecture_place[]			    = $data2['col_lecture_place'];
			                 }
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
                <td id="display_lecture_place_option6">
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                </td>
                <td>
                    <select id="post_lecture_count6" name="post_lecture_count6">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                    </select>
                </td>
            </tr>
        </table>
        <table width="100%" border="1" cellspacing="1" cellpadding="1">  
            <tr>
                <th scope="row">All Before Recess Lecture Information(Not Include First Lecture)</th>
            </tr>
        </table>
        <table width="90%" border="1" cellspacing="5" cellpadding="3">
			<tr>
                <th scope="row">Lecture Information Count</th>
                <th scope="row">Name Of Teacher</th>
                <th scope="row">Name Of Lecture</th>
                <th scope="row">Name Of Place Where Lecture Will Held</th>
                <th scope="row">Enter Total Number Of This Lecture In Week</th>
			</tr>
            <tr>
                <td id="post_lecture_information">7</td>
                <td>
                    <select name="post_teacher_name1" id="post_teacher_name1">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
                                    echo '
                                    <option value='.$teacher_first_name[$i]."_".$teacher_last_name[$i].'>'.$teacher_first_name[$i]." ".$teacher_last_name[$i].'</option>
                                    ';
                                }
                            }
                        }
                        
                        ?>
                    </select>
                </td>
                <td>
                    <select name="post_lecture_name1" id="post_lecture_name1" onchange="display_lecture_type_option(this.id);">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
			                  while($data2=$result2->fetch_array())
			                 {
                                /* storing data from teacher detail table to array variable*/
				                $srno[]							= $data2['srno'];
				                $lecture_full_name[]			= $data2['col_lecture_full_name'];
				                $lecture_short_name[]			= $data2['col_lecture_short_name'];
				                $lecture_type[]			        = $data2['col_lecture_type'];
				                $lecture_place[]			    = $data2['col_lecture_place'];
			                 }
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
                <td id="display_lecture_place_option1">
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                </td>
                <td>
                    <select id="post_lecture_count1" name="post_lecture_count1">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                    </select>
                </td>
			</tr>
        </table>
        <table width="100%" border="1" cellspacing="1" cellpadding="1">  
            <tr>
                <th scope="row">All After Recess Lecture Information</th>
            </tr>
        </table>
        <table width="90%" border="1" cellspacing="5" cellpadding="3">
			<thead>
                <tr>
                    <th scope="row">Lecture Information Count</th>
                    <th scope="row">Name Of Teacher</th>
                    <th scope="row">Name Of Lecture</th>
                    <th scope="row">Name Of Place Where Lecture Will Held</th>
                    <th scope="row">Enter Total Number Of This Lecture In Week</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tr>
                <td id="post_lecture_information">7</td>
                <td>
                    <select name="post_teacher_name1" id="post_teacher_name1">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
                                    echo '
                                    <option value='.$teacher_first_name[$i]."_".$teacher_last_name[$i].'>'.$teacher_first_name[$i]." ".$teacher_last_name[$i].'</option>
                                    ';
                                }
                            }
                        }
                        
                        ?>
                    </select>
                </td>
                <td>
                    <select name="post_lecture_name1" id="post_lecture_name1" onchange="display_lecture_type_option(this.id);">
                        <option value="ns" >Not Selected</option>
                        <?php 
                        
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
			                  while($data2=$result2->fetch_array())
			                 {
                                /* storing data from teacher detail table to array variable*/
				                $srno[]							= $data2['srno'];
				                $lecture_full_name[]			= $data2['col_lecture_full_name'];
				                $lecture_short_name[]			= $data2['col_lecture_short_name'];
				                $lecture_type[]			        = $data2['col_lecture_type'];
				                $lecture_place[]			    = $data2['col_lecture_place'];
			                 }
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
                <td id="display_lecture_place_option1">
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                </td>
                <td>
                    <select id="post_lecture_count1" name="post_lecture_count1">
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                    </select>
                </td>
			</tr>
        </table>
        <table width="100%" border="1" cellspacing="1" cellpadding="1">  
            <tr>
                <th scope="row">Lecture 29 out of 35 is Reamaning</th>
            </tr>
        </table>
    </form>
</body>
<script>
    
     var no_count = "0";
    
    function display_lecture_type_option(option_id)
    {
         var post_lecture_type_option = " ";
         var option_value             = $('option:selected','#'+option_id).attr('id');
         
        //finding number from option value
		 var srno_array = option_value.match(/(\d+)/);
		 var srno       = srno_array[0];
        
        //finding number from option id
		 var idno_array = option_id.match(/(\d+)/);
		 var no         = idno_array[0];
        
        //checking duplicate value of option id
        if(no > no_count )
        {
            no_count=no;
            
            $('#hidden_data').append('<div id="hidden_data'+no+'"></div>');
        }
        
        var lecture_type       = $('#post_lecture_type_value'+srno).val();
        var lecture_short_name = $('#post_lecture_short_name_value'+srno).val();
        
        $('#hidden_data'+no).html('<input type="hidden" name="post_lecture_type'+no+'" id="post_lecture_type'+no+'" value="'+lecture_type+'"><input type="hidden" name="post_lecture_short_name'+no+'" id="post_lecture_short_name'+no+'" value="'+lecture_short_name+'">');
        
		display_lecture_place_option(option_id);      
    }
    
    function display_lecture_place_option(option_id)
    {
         var post_lecture_type_option=" ";
         var option_value=$('option:selected','#'+option_id).attr('id');
        
        //finding number from option value
		 var srno_array=option_value.match(/(\d+)/);
		 var srno=srno_array[0];
        
        //finding number from option id
		 var idno_array=option_id.match(/(\d+)/);
		 var no=idno_array[0];
        
        $.post('class_lecture_detail_back.php',
		
                {
                    lecture_type_option        : post_lecture_type_option,
                    post_lecture_place_value   : $('#post_lecture_place_value'+srno).val(),
                    post_id_no                 : no
                },
               
		        function(data)
                {
                    $('#display_lecture_place_option'+no).html(data);
		        }
              ); 
    }
</script>    
</html>