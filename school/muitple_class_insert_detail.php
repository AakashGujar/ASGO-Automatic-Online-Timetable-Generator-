<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection to database
include('user_connection.php');

//function to update table with blank value and freesolt with increase value

//inserting data in timetable table of all class,teacher,lecture,etc 
if (isset($_POST['insert_all_class_time_detail'])) 
{
    $class_name = array('5a', '5b', '6a', '6b', '7a', '7b', '8a', '8b', '9a', '9b', '10a', '10b');
    //$class_name=array('5a','5b','6a','6b');
    $subject_detail_table = "subject_detail_1";
    //$class_name=array('7a','7b','8a','8b');
    //$subject_detail_table="subject_detail_2";

    /* Finding  subject detail table in database */
    $sql_query1 = "SELECT * FROM " . $subject_detail_table . "";
    $result1 = $conn->query($sql_query1); /* execution of query */
    if (empty($result1)) {
        echo "not declare";
    }
    else {
        $subject_detail_count = $result1->num_rows;
        /* extractinng from $subject_detail_table table in database */
        while ($subject_detail_data = $result1->fetch_array()) {
            $subject_lecture_area[] = $subject_detail_data['col_lecture_area'];
            $subject_teacher_name[] = $subject_detail_data['col_teacher_name'];
            $subject_lecture_name[] = $subject_detail_data['col_lecture_name'];
            $subject_lecture_type[] = $subject_detail_data['col_lecture_type'];
            $subject_table_lecture_count[] = $subject_detail_data['col_lecture_count'];
            $subject_table_color[] = $subject_detail_data['col_lecture_color'];
            $subject_class_teacher[] = $subject_detail_data['col_class_teacher'];
            if (isset($subject_detail_data['col_lecture_place'])) {
                $subject_lecture_place[] = $subject_detail_data['col_lecture_place'];
            }
            else {
                $subject_lecture_place[] = null;
            }
        }
        //truncate class,teacher,lecture place table
        for ($class_name_index = 0; $class_name_index < 6; $class_name_index++) {
            
            $class_table_name = $class_name[$class_name_index];
            /* Finding teacher/class timetable table in database */
            $sql_query2 = "SELECT col_teacher_name,col_lecture_place,col_class_name FROM " . $class_table_name . "_timetable ";
            $result2 = $conn->query($sql_query2); /* execution of query */

            if (!empty($result2)) {
                while ($data2 = $result2->fetch_array()) {
                    if (isset($data2['col_teacher_name'])) {
                        //updating teacher timetableto blank
                        $sql_query3 = "UPDATE " . $data2['col_teacher_name'] . "_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_class_name='" . $data2['col_class_name'] . "'";
                        $conn->query($sql_query3); /* execution of query */
                    }

                    if (isset($data2['col_lecture_place'])) {
                        //updating place timetable to blank
                        $sql_query4 = "UPDATE " . $data2['col_lecture_place'] . "_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_class_name='" . $data2['col_class_name'] . "'";
                        $conn->query($sql_query4); /* execution of query */
                    }

                    //updating class timetable to blank
                    $sql_query5 = "UPDATE " . $data2['col_class_name'] . "_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_class_name='" . $data2['col_class_name'] . "'";
                    $conn->query($sql_query5); /* execution of query */
                }
            }
        }

        $subject_teacher_name_count=count($subject_teacher_name);
        //insert i teacher table
        for ($subject_teacher_name_index = 0; $subject_teacher_name_index < $subject_teacher_name_count; $subject_teacher_name_index++) {
            
            $subject_teacher_table_name = $subject_teacher_name[$subject_teacher_name_index];

             /* Finding teacher/class timetable table in database */
            $sql_query6 = "SELECT * FROM " . $subject_teacher_table_name . "_timetable";
            $result6 = $conn->query($sql_query6); /* execution of query */
            /* extractinng teacher/class timetable table from database */
            while ($data6 = $result6->fetch_array()) {
                $subject_teacher_lecture_area[] = $data6['col_lecture_area'];
                $subject_teacher_timming[] = $data6['col_timming'];
                $subject_teacher_available[] = $data6['col_available'];
                $subject_teacher_day[] = $data6['col_day'];
                $subject_teacher_day_wise_id[] = $data6['col_day_wise_id'];
            }

            $subject_teacher_timming_count = $result6->num_rows;
            
            echo "<h1 style='background-color:red;color:white;'>" . $subject_teacher_table_name . "</h1>";
            $sql_query7 = "SELECT * FROM " . $subject_teacher_table_name . "_time_detail";
            $result7 = $conn->query($sql_query7); /* execution of query */
            /* extractinng class_time_detail table in database */
            $time_detail_data = $result7->fetch_array();

            if (isset($time_detail_data)) {
                if ($time_detail_data['col_holiday'] != 0) {
                    $closed_day = $time_detail_data['col_closed_day'];
                }
                else {
                    $closed_day = 6;
                }
            }

            
//            for ($class_name_index = 0; $class_name_index < 6; $class_name_index++){
//                
//                for ($class_name_index = 0; $class_name_index < 6; $class_name_index++){
//                    
//                }//for loop subject wise
//                
//            }//for loop of class
//               
        } //for loop of subject teacher 

    } //else of subject detail
} //main if  
?>
<form method="post" action="">
    <button type="submit" name="insert_all_class_time_detail">enter</button>
</form>