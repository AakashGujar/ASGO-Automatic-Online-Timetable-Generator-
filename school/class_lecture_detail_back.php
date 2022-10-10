<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection to database
include('user_connection.php');

//lecture type option function
if (isset($_POST['lecture_information_display'])) 
{
    //id for lecture information
    $lecture_information_id = htmlspecialchars($_POST['lecture_information_display']);
    $class_table_name = htmlspecialchars($_POST['class_table_name']);
    $class_timming_id = htmlspecialchars($_POST['class_timming_id']);
    $type = htmlspecialchars($_POST['post_type']);
    $per_day_lecture_count = htmlspecialchars($_POST['post_per_day_lecture_count']);

    /* Finding class_time_detail table in database */
    $sql_query1 = "SELECT * FROM " . $class_table_name . "_time_detail";
    $result1 = $conn->query($sql_query1); /* execution of query */
    /* extractinng class_time_detail table in database */
    $data1 = $result1->fetch_array();
    if ($data1['col_holiday'] != 0) {
        $closed_day = $data1['col_closed_day'];
    }
    else {
        $closed_day = 6;
    }

    /* Extractin  freesolt information from  table in database */
    $sql_query13 = "SELECT  *  FROM " . $class_table_name . "_timetable WHERE col_day_wise_id!='1' AND col_available='1';";
    $result13 = $conn->query($sql_query13); /* execution of query */
    /* extractinng from table in database */
    while ($data13 = $result13->fetch_array()) {
        $table_class_timming_id[] = $data13['col_lecture_area'];
        $class_timming[] = $data13['col_timming'];
        $class_available[] = $data13['col_available'];
        $class_day[] = $data13['col_day'];
    }

    if ($type == "contain") {
?>

                <td>
                    <select id="post_day<?php echo $lecture_information_id; ?>" name="post_day<?php echo $lecture_information_id; ?>" onchange="display_lecture_type_option(this.id);display_teacher_name_option(this.id);">
                            <option id="6" value="ns">Not Selected</option>
                        <?php
    }
    $day_array = array('Monday', 'Tuesday', 'Wensday', 'Thursday', 'Friday', 'Saturday');
    for ($day_index = 0; $day_index < 6; $day_index++) {
        if ($closed_day != $day_index) {
            /* Extractin  freesolt information from  table in database */
            $sql_query13 = "SELECT  *  FROM " . $class_table_name . "_timetable WHERE col_day_wise_id!='1' AND col_available='1' AND col_day='" . $day_index . "';";
            $result13 = $conn->query($sql_query13); /* execution of query */

            $count = $result13->num_rows;
            if ($class_timming_id == "fullday_lecture") {
                if ($per_day_lecture_count - 1 == $count || $per_day_lecture_count - 2 == $count) {
                    if (!isset($perment_set) && $type == "button") {
                        $perment_set = 1;
                        echo '<button name="next_fullday_lecture_information_detail" id="next_fullday_lecture_information_detail" onclick="event.preventDefault();add_new_lecture(this.id);">Add Next Fullday Lecture</button>';
                    }
                    if ($type == "contain") {
                        echo '<option id="' . $day_index . '" value="' . $day_index . '">' . $day_array[$day_index] . '</option>';
                    }

                }
            }
            else {

                if (0 < $count && $type == "contain") {
                    echo '<option id="' . $day_index . '" value="' . $day_index . '">' . $day_array[$day_index] . '</option>';
                }
            }
            unset($count);

        }
    }

    if (!isset($perment_set) && $type == "button") {
        echo '<button name="next_fullday_lecture_information_detail" id="next_fullday_lecture_information_detail" onclick="event.preventDefault();add_new_lecture(this.id);" disabled>Add Next Fullday Lecture</button>';
    }
    if ($type == "contain") {
?>
                    </select>    
                </td>
                <td id="display_teacher_name_option<?php echo $lecture_information_id; ?>">
                    <select name="post_teacher_name<?php echo $lecture_information_id; ?>" id="post_teacher_name<?php echo $lecture_information_id; ?>" onchange="display_lecture_type_option(this.id);" <?php if ($class_timming_id == "fullday_lecture") {
            echo 'disabled="disabled"';
        }?> >
                        <option value="ns" >Not Selected</option>
                        <?php
        //unset reused array
        unset(
        $srno,
        $teacher_first_name,
        $teacher_last_name
        );
        /* Finding teacher detail table in database */
        $sql_query2 = "SELECT * FROM teacher_detail";
        $result2 = $conn->query($sql_query2); /* execution of query */
        if ($result2 == "") {
            echo '
                            <script>
                                alert("No Teacher found")
                            </script>
                            ';
        }
        else {
            /* counting no of row from teacher detail table */
            $teacher_detail_count = $result2->num_rows;

            if ($result2->num_rows > 0) {
                while ($data2 = $result2->fetch_array()) {
                    /* storing data from teacher detail table to array variable*/
                    $srno[] = $data2['srno'];
                    $teacher_first_name[] = $data2['col_teacher_first_name'];
                    $teacher_last_name[] = $data2['col_teacher_last_name'];
                }
            }

            if ($teacher_detail_count == 0) {
                echo '
                                <script>
                                    alert("No Teacher found")
                                </script>
                                ';
            }
            else {

                //displaying data of teacher detail table in loop
                for ($i = 0; $i < $teacher_detail_count; $i++) {
                    $set = 0;
                    $daily_lecture_count = count($class_timming);
                    for ($j = 1; $j < $daily_lecture_count; $j++) {
                        if ($class_timming_id == $table_class_timming_id[$j] || $class_timming_id == "fullday_lecture" || $class_timming_id == "all_area_lecture") {
                            /* Extractin  freesolt information from free_solt_detail table in database */
                            $sql_query14 = "SELECT  *  FROM " . $teacher_first_name[$i] . "_" . $teacher_last_name[$i] . "_timetable WHERE col_day='" . $class_day[$j] . "' AND col_timming ='" . $class_timming[$j] . "'";
                            $result14 = $conn->query($sql_query14); /* execution of query */
                            /* extractinng from free_solt_detail table in database */
                            $data14 = $result14->fetch_array();

                            if (isset($data14['col_timming']) && $set == 0) {
                                if ($data14['col_timming'] == $class_timming[$j] && $data14['col_available'] == 1 && $class_available[$j] == 1) {
                                    $set = 1;
                                    echo '
                                                <option id=' . $teacher_first_name[$i] . "_" . $teacher_last_name[$i] . ' value=' . $teacher_first_name[$i] . "_" . $teacher_last_name[$i] . '>' . $teacher_first_name[$i] . " " . $teacher_last_name[$i] . '</option>
                                                ';
                                    break;
                                }
                            }

                        }
                    }
                }
            }
        }

?>
                    </select>
                </td>
                <td>
                    <select name="post_lecture_name<?php echo $lecture_information_id; ?>" id="post_lecture_name<?php echo $lecture_information_id; ?>" onchange="display_lecture_type_option(this.id);" disabled>
                        <option value="ns" >Not Selected</option>
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
        $sql_query2 = "SELECT * FROM lecture_information";
        $result2 = $conn->query($sql_query2); /* execution of query */
        if ($result2 == "") {
            echo '
                            <script>
                                alert("No Lecture found")
                            </script>
                            ';
        }
        else {
            /* counting no of row from lecture information table */
            $lecture_information_count = $result2->num_rows;
            if ($result2->num_rows > 0) {
                while ($data3 = $result2->fetch_array()) {
                    /* storing data from teacher detail table to array variable*/
                    $srno[] = $data3['srno'];
                    $lecture_full_name[] = $data3['col_lecture_full_name'];
                    $lecture_short_name[] = $data3['col_lecture_short_name'];
                    $lecture_type[] = $data3['col_lecture_type'];
                    $lecture_place[] = $data3['col_lecture_place'];
                }
                print_r($srno);
            }

            if ($lecture_information_count == 0) {
                echo '
                                <script>
                                    alert("No Lecture found")
                                </script>
                                ';
            }
            else {
                $lecture_type_array = array('Theory(TH)', 'Pratical(PR)', 'Extracurricular Activities(EA)');
                //displaying data of teacher detail table in loop
                for ($i = 0; $i < $lecture_information_count; $i++) {
                    echo '
                                    <option id=' . $lecture_full_name[$i] . "_" . $srno[$i] . ' value=' . $lecture_full_name[$i] . '>' . $lecture_full_name[$i] . " (" . $lecture_short_name[$i] . ') - ' . $lecture_type_array[$lecture_type[$i]] . '</option>
                                    ';

                }

                for ($i = 0; $i < $lecture_information_count; $i++) {
                    echo '
                                    <input type="hidden" name="post_lecture_type_value' . $srno[$i] . '" id="post_lecture_type_value' . $srno[$i] . '" value="' . $lecture_type[$i] . '">
                                    
                                    <input type="hidden" name="post_lecture_short_name_value' . $srno[$i] . '" id="post_lecture_short_name_value' . $srno[$i] . '" value="' . $lecture_short_name[$i] . '">
                                    
                                    <input type="hidden" name="post_lecture_place_value' . $srno[$i] . '" id="post_lecture_place_value' . $srno[$i] . '" value="' . $lecture_place[$i] . '">
                                    ';
                }
            }
        }

?>
                    </select>
                </td>
                <td id="display_lecture_place_option<?php echo $lecture_information_id; ?>">
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>
                </td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="50%" style="text-align:center;">
                                <input type="number" id="post_lecture_count<?php echo $lecture_information_id; ?>"name="post_lecture_count<?php echo $lecture_information_id; ?>" min='1' max='30' value='0' onkeyup='lecture_count()'; onclick='lecture_count();' disabled>
                            </td>
                            <td id="display_lecture_available<?php echo $lecture_information_id; ?>" width="50%" style="text-align:center;color:grey;">0</td>
                        </tr>
                    </table>
                    <!--<input type="number" id="post_lecture_count<?php echo $lecture_information_id; ?>"name="post_lecture_count<?php echo $lecture_information_id; ?>" min='1' max='30' value='1' onkeyup='lecture_count()'; onclick='lecture_count();'> -->
                </td>
                <td>
                    <button id="modify_<?php echo $lecture_information_id; ?>" name="modify_<?php echo $lecture_information_id; ?>" value="modify" class="hide" onclick="event.preventDefault();modify_lecture(this.id);">Modify</button>
                    <button id="insert_<?php echo $lecture_information_id; ?>" name="insert_<?php echo $lecture_information_id; ?>" value="insert" onclick="event.preventDefault();insert_lecture(this.id);" disabled>Insert</button>
                </td>
                <td >
                    <button id="delete_<?php echo $lecture_information_id; ?>" name="delete_<?php echo $lecture_information_id; ?>" value="delete" onclick="event.preventDefault();">Delete</button>
                </td>
<?php
    }
}

//teacher_name_option function
if (isset($_POST['teacher_name_option'])) 
{
    $id_no = htmlspecialchars($_POST['post_id_no']);
    $lecture_area = htmlspecialchars($_POST['post_lecture_area']);
    $per_day_lecture_count = htmlspecialchars($_POST['post_per_day_lecture_count']);
    $class_table_name = htmlspecialchars($_POST['class_table_name']);
    $day = htmlspecialchars($_POST['post_day']);
    /*extra condn.. for where clause of query */
    $class_where_clause = ";";

    if ($lecture_area == "fullday_lecture" || $day < 6) {
        /*extra condn.. for where clause of query */
        $class_where_clause = "AND col_day='" . $day . "';";
    }

    /* Finding teacher table in database */
    $sql_query13 = "SELECT * FROM " . $class_table_name . "_timetable WHERE col_day_wise_id!='1' AND col_available='1'  $class_where_clause";
    $result13 = $conn->query($sql_query13); /* execution of query */
    /* extractinng from table in database */
    while ($data13 = $result13->fetch_array()) {
        $class_lecture_area[] = $data13['col_lecture_area'];
        $class_timming[] = $data13['col_timming'];
        $class_available[] = $data13['col_available'];
        $class_day[] = $data13['col_day'];
    }

    $daily_lecture_count = count($class_timming);

    //unset reused array
    unset($srno,
    $teacher_first_name,
    $teacher_last_name);

    /* Finding teacher detail table in database */
    $sql_query2 = "SELECT * FROM teacher_detail";
    $result2 = $conn->query($sql_query2); /* execution of query */
    if ($result2 == "") {
        echo 'No Teacher found';
    }
    else {
        /* counting no of row from teacher detail table */
        $teacher_detail_count = $result2->num_rows;

        if ($result2->num_rows > 0) {
            while ($data2 = $result2->fetch_array()) {
                /* storing data from teacher detail table to array variable*/
                $srno[] = $data2['srno'];
                $teacher_first_name[] = $data2['col_teacher_first_name'];
                $teacher_last_name[] = $data2['col_teacher_last_name'];
            }
        }

        if ($teacher_detail_count == 0) {
            echo '<script>
                        alert("No Teacher found")
                 </script>';
        }
        else {
            //displaying data of teacher detail table in loop
            for ($i = 0; $i < $teacher_detail_count; $i++) {
                $set = 0;
                $available_count_array[$i] = 0;
                for ($j = 0; $j < $daily_lecture_count; $j++) {
                    if ($lecture_area == $class_lecture_area[$j] || $lecture_area == "fullday_lecture" || $lecture_area == "all_area_lecture") {
                        /* Extractin  freesolt information from free_solt_detail table in database */
                        $sql_query14 = "SELECT  *  FROM " . $teacher_first_name[$i] . "_" . $teacher_last_name[$i] . "_timetable WHERE  col_day='" . $class_day[$j] . "' AND col_timming ='" . $class_timming[$j] . "'";
                        $result14 = $conn->query($sql_query14); /* execution of query */
                        /* extractinng from free_solt_detail table in database */
                        $data14 = $result14->fetch_array();

                        if (isset($data14['col_timming']) && $set == 0) {
                            if ($data14['col_timming'] == $class_timming[$j] && $data14['col_available'] == 1 && $class_available[$j] == 1) {
                                if ($lecture_area == "fullday_lecture") {
                                    $available_count_array[$i] = $available_count_array[$i] + 1;

                                    if ($available_count_array[$i] == $per_day_lecture_count) {
                                        if (!isset($perment_set)) {
                                            $perment_set = 1;
                                            echo '
                                            <select name="post_teacher_name' . $id_no . '" id="post_teacher_name' . $id_no . '" onchange="display_lecture_type_option(this.id);">
                                                    <option value="ns" >Not Selected</option>
                                            ';
                                        }
                                        echo ' <option  id=' . $teacher_first_name[$i] . "_" . $teacher_last_name[$i] . ' value=' . $teacher_first_name[$i] . "_" . $teacher_last_name[$i] . '>' . $teacher_first_name[$i] . " " . $teacher_last_name[$i] . '</option>';
                                    }
                                }
                                else {
                                    if (!isset($perment_set)) {
                                        $perment_set = 1;
                                        echo '
                                        <select name="post_teacher_name' . $id_no . '" id="post_teacher_name' . $id_no . '" onchange="display_lecture_type_option(this.id);">
                                                <option value="ns" >Not Selected</option>
                                        ';
                                    }
                                    $set = 1;
                                    echo ' <option  id=' . $teacher_first_name[$i] . "_" . $teacher_last_name[$i] . ' value=' . $teacher_first_name[$i] . "_" . $teacher_last_name[$i] . '>' . $teacher_first_name[$i] . " " . $teacher_last_name[$i] . '</option>';
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    if (!isset($perment_set)) {
        echo 'No Teacher Available ';
    }
    else {
        echo '	</select>
					';
    }
}

//lecture type option function
if (isset($_POST['lecture_type_option'])) 
{
    $id_no = htmlspecialchars($_POST['post_id_no']);
    $lecture_place_value = htmlspecialchars($_POST['post_lecture_place_value']);
    $lecture_area = htmlspecialchars($_POST['post_lecture_area']);
    $class_table_name = $_POST['class_table_name'];
    $per_day_lecture_count = htmlspecialchars($_POST['post_per_day_lecture_count']);

    if (isset($_POST['post_teacher_name'])) {
        $teacher_name = htmlspecialchars($_POST['post_teacher_name']);
    }
    if (isset($_POST['post_day'])) {
        $day = htmlspecialchars($_POST['post_day']);
    }
    else {
        $day = 6;
    }

    if ($lecture_area == "first_lecture") {
        /* Finding teacher table in database */
        $class_where_clause = " AND col_day_wise_id IN ('1', '2') AND col_day='" . $id_no . "';";
        $lecture_area = "before_recess_lecture";
    }
    else if ($day < 6) {
        /* Finding teacher table in database */
        $class_where_clause = " AND col_day_wise_id!='1' AND col_day='" . $day . "';";
    }
    else {
        /* Finding teacher table in database */
        $class_where_clause = " AND col_day_wise_id!='1';";
    }

    /* Finding teacher table in database */
    $sql_query13 = "SELECT * FROM " . $class_table_name . "_timetable WHERE col_available='1' $class_where_clause";
    $result13 = $conn->query($sql_query13); /* execution of query */
    /* extractinng from table in database */
    while ($data13 = $result13->fetch_array()) {
        $table_class_timming_id[] = $data13['col_lecture_area'];
        $class_timming[] = $data13['col_timming'];
        $class_available[] = $data13['col_available'];
        $class_day[] = $data13['col_day'];
    }

    $daily_lecture_count = count($class_timming);

    /* Finding lecture place detail table in database */
    $sql_query1 = "SELECT * FROM lecture_place_detail WHERE col_lecture_place='" . $lecture_place_value . "'";
    $result1 = $conn->query($sql_query1); /* execution of query */
    if ($result1 == "") {
        if (isset($_POST['post_teacher_name'])) {
            echo '
            <select disabled>
                 <option value="ns" >Not Selected</option>
            </select>
            ';
        }
        else {
            echo '
                <select disabled>
                    <option value="ns" >Not Selected</option>
                </select>[please select teacher name]
                ';
        }
    }
    else {
        /* counting no of row from lecture place detail table */
        $lecture_place_detail_count = $result1->num_rows;

        if ($result1->num_rows > 0) {
            while ($data1 = $result1->fetch_array()) {
                /* storing data from lecture place detail table to array variable*/
                $srno[] = $data1['srno'];
                $lecture_place_name[] = $data1['col_lecture_place_name'];
            }
        }

        if ($lecture_place_detail_count == 0) {
            if (isset($_POST['post_teacher_name'])) {
                echo '
                <select disabled>
                 <option value="ns" >Not Selected</option>
                </select>
                ';
                $available_count = 0;
                for ($j = 0; $j < $daily_lecture_count; $j++) {
                    if ($lecture_area == $table_class_timming_id[$j] || $lecture_area == "fullday_lecture" || $lecture_area == "all_area_lecture") {
                        /* Extractin  freesolt information from free_solt_detail table in database */
                        $sql_query16 = "SELECT  *  FROM " . $teacher_name . "_timetable WHERE col_day='" . $class_day[$j] . "' AND col_timming ='" . $class_timming[$j] . "'";
                        $result16 = $conn->query($sql_query16); /* execution of query */
                        /* extractinng from free_solt_detail table in database */
                        $data16 = $result16->fetch_array();

                        if (isset($data16['col_timming'])) {
                            if ($data16['col_timming'] == $class_timming[$j] && $data16['col_available'] == 1 && $class_available[$j] == 1) {
                                $avilable_solt[] = $data16['col_timming_id'];
                                $available_count = $available_count + 1;
                            }
                        }
                    }
                }
                echo '<input type="hidden" id="th' . $id_no . '" value="' . $available_count . '">';
                $_SESSION["avilable_solt"][0] = $avilable_solt;
            }
            else {
                echo '
                <select disabled>
                    <option value="ns" >Not Selected</option>
                </select>[please select teacher name]
                ';
            }
        }
        else {
            if (isset($_POST['post_teacher_name'])) {
                //displaying data of lecture information table in loop
                for ($i = 0; $i < $lecture_place_detail_count; $i++) {
                    $set = 0;
                    $available_count = 0;
                    $available[$i] = $available_count;
                    for ($j = 0; $j < $daily_lecture_count; $j++) {
                        if ($lecture_area == $table_class_timming_id[$j] || $lecture_area == "fullday_lecture" || $lecture_area == "all_area_lecture") {
                            /* Extractin  freesolt information from free_solt_detail table in database */
                            $sql_query14 = "SELECT  *  FROM " . $lecture_place_name[$i] . "_timetable WHERE col_day='" . $class_day[$j] . "' AND col_timming ='" . $class_timming[$j] . "'";
                            $result14 = $conn->query($sql_query14); /* execution of query */
                            /* extractinng from free_solt_detail table in database */
                            $data14 = $result14->fetch_array();

                            /* Extractin  freesolt information from free_solt_detail table in database */
                            $sql_query15 = "SELECT  *  FROM " . $teacher_name . "_timetable WHERE col_day='" . $class_day[$j] . "' AND col_timming ='" . $class_timming[$j] . "'";
                            $result15 = $conn->query($sql_query15); /* execution of query */
                            /* extractinng from free_solt_detail table in database */
                            $data15 = $result15->fetch_array();

                            if (isset($data14['col_timming']) && isset($data15['col_timming'])) {

                                if ($data14['col_timming'] == $data15['col_timming'] && $data14['col_available'] == 1 && $data15['col_available'] == 1) {
                                    $available_count = $available_count + 1;
                                    $available[$i] = $available_count;
                                    $avilable_solt[$i][] = $data14['col_timming_id'];

                                    if ($lecture_area == "fullday_lecture") {
                                        if ($available[$i] == $per_day_lecture_count) {
                                            if (!isset($perment_set)) {
                                                $perment_set = 1;
                                                echo '
                                        <select name="post_lecture_place_name' . $id_no . '" id="post_lecture_place_name' . $id_no . '" onchange="display_lecture_available(' . $id_no . ');">
                                                <option value="ns" >Not Selected</option>
                                            ';
                                            }
                                            echo ' <option id="' . $lecture_place_name[$i] . '" value="' . $lecture_place_name[$i] . '">' . $lecture_place_name[$i] . '</option>';
                                        }
                                    }
                                    else {
                                        if ($set == 0) {
                                            if (!isset($perment_set)) {
                                                $perment_set = 1;
                                                echo '
                                        <select name="post_lecture_place_name' . $id_no . '" id="post_lecture_place_name' . $id_no . '" onchange="display_lecture_available(' . $id_no . ');">
                                                <option value="ns" >Not Selected</option>
                                            ';
                                            }
                                            $set = 1;
                                            echo '<option id="' . $lecture_place_name[$i] . '" value="' . $lecture_place_name[$i] . '">' . $lecture_place_name[$i] . '</option>';
                                        }
                                    }
                                }

                            }
                        }

                    }
                }
                if (!isset($perment_set)) {
                    echo '
                    <select disabled>
                        <option value="ns" >Not Selected</option>
                    </select>[please select Different teacher name because this teacher is not available]
                                ';
                }
                else {
                    echo '	</select>
					';
                    for ($i = 0; $i < $lecture_place_detail_count; $i++) {
                        echo '<input type="hidden" id="' . $lecture_place_name[$i] . $id_no . '" value="' . $available[$i] . '">';
                        if (isset($avilable_solt[$i])) {
                            $_SESSION["avilable_solt"][$lecture_place_name[$i] . $id_no] = $avilable_solt[$i];
                        }
                    }
                }

            }
            else {
                echo '
                <select disabled>
                    <option value="ns" >Not Selected</option>
                </select>[please select teacher name]
                ';
            }
        }
    }
}

//inserting data in timetable table of class,teacher,lecture,etc
if (isset($_POST['insert_class_time_detail'])) 
{
    $class_table_name = htmlspecialchars($_POST['post_class_table_name']);
    $lecture_information = htmlspecialchars($_POST['post_lecture_information']);
    $per_day_lecture_count = htmlspecialchars($_POST['post_per_day_lecture_count']);

    /* Finding teacher/class timetable table in database */
    $sql_query2 = "SELECT * FROM " . $class_table_name . "_subject_detail";
    $result2 = $conn->query($sql_query2); /* execution of query */
    if (!empty($result2)) {
    //$sql_query2="TRUNCATE ".$class_table_name."_subject_detail"; 
    //$result2=$conn->query($sql_query2);/* execution of query */
    }
    else {
        /* create user class timetable table  */
        $sql_query1 = "CREATE TABLE " . $class_table_name . "_subject_detail
        ( /* Column name    		     Column data type */
		  srno       	    			 int   AUTO_INCREMENT,
		  col_lecture_area	         	 text,
		  col_day				         int, 
		  col_teacher_name   	         text,
          col_lecture_name   	         text,
		  col_lecture_type	          	 text,
          col_lecture_place	         	 text,
		  col_lecture_count           	 int,
          col_lecture_set                int,
		  col_lecture_information        int,
		  PRIMARY KEY (`srno`)
        );";
        $conn->query($sql_query1); /* execution of query */

    }

    $sql_query1 = "SELECT * FROM " . $class_table_name . "_time_detail";
    $result1 = $conn->query($sql_query1); /* execution of query */
    /* extractinng class_time_detail table in database */
    $data1 = $result1->fetch_array();

    if (isset($data1)) {
        if ($data1['col_holiday'] != 0) {
            $closed_day = $data1['col_closed_day'];
        }
        else {
            $closed_day = 6;
        }
    }

    if (isset($_POST['post_lecture_area'])) {
        unset($lecture_place, $lecture_place_alternative);
        $lecture_area = htmlspecialchars($_POST['post_lecture_area']);
        $teacher_name = htmlspecialchars($_POST['post_teacher_name']);
        $lecture_name = htmlspecialchars($_POST['post_lecture_name']);
        $lecture_type = htmlspecialchars($_POST['post_lecture_type']);
        $lecture_count = htmlspecialchars($_POST['post_lecture_count']);

        if (isset($_POST['post_lecture_place_name'])) {
            $lecture_place = htmlspecialchars($_POST['post_lecture_place_name']);
        }

        if (isset($_POST['post_day'])) {
            $day = htmlspecialchars($_POST['post_day']);
        }
        else {
            $day = 6;
        }


        if ($lecture_area == "first_lecture") {
            /* class exter where condn.. */
            $class_where_clause = " WHERE col_day_wise_id IN ('1', '2') AND col_day='" . $day . "'";
        }
        else if ($lecture_area == "fullday_lecture") {
            /* class exter where condn.. */
            $class_where_clause = "WHERE  col_day_wise_id NOT IN ('1','0') AND col_day='" . $day . "' ";
        }
        else if ($lecture_area == "all_area_lecture") {
            if ($day < 6) {
                /* Finding teacher table in database */
                $class_where_clause = " WHERE col_day='" . $day . "' AND col_day_wise_id NOT IN ('1','0') ";
            }
            else {
                /* class exter where condn.. */
                $class_where_clause = "WHERE col_day_wise_id NOT IN ('1','0')";
            }
        }
        else if ($day < 6) {
            /* Finding teacher table in database */
            $class_where_clause = " WHERE col_day='" . $day . "' AND col_lecture_area='" . $lecture_area . "' AND col_day_wise_id NOT IN ('0') ";
        }
        else {
            /* class exter where condn.. */
            $class_where_clause = "WHERE col_lecture_area='" . $lecture_area . "' AND col_day_wise_id NOT IN ('0')";
        }

        /* Extractin  freesolt information from free_solt_detail table in database */
        $sql_query13 = "SELECT  *  FROM " . $class_table_name . "_timetable $class_where_clause";
        $result13 = $conn->query($sql_query13); /* execution of query */
        /* extractinng from free_solt_detail table in database */
        while ($data13 = $result13->fetch_array()) {
            $class_timming_id[] = $data13['col_lecture_area'];
            $class_timming[] = $data13['col_timming'];
            $class_available[] = $data13['col_available'];
            $class_day[] = $data13['col_day'];
            $day_wise_id[] = $data13['col_day_wise_id'];
        }

        echo "<br> ctc " . $class_timming_count = count($class_timming);

        /* Extractin  freesolt information from free_solt_detail table in database */
        $sql_query20 = "SELECT  *  FROM " . $class_table_name . "_subject_detail WHERE col_lecture_information='" . $lecture_information . "' AND col_day='" . $day . "'";
        $result20 = $conn->query($sql_query20); /* execution of query */
        /* extractinng from free_solt_detail table in database */
        $data20 = $result20->fetch_array();

        if (!isset($data20)) {
            $sql_statement1 = $conn->prepare("
        INSERT INTO " . $class_table_name . "_subject_detail
				(
					col_lecture_area,
					col_day, 
					col_teacher_name ,
					col_lecture_name ,
					col_lecture_type	,
					col_lecture_place	 ,
					col_lecture_count  ,
					col_lecture_information  
				)VALUES(?,?,?,?,?,?,?,?)");

            $sql_statement1->bind_param("sissssii",
                $lecture_area,
                $day,
                $teacher_name,
                $lecture_name,
                $lecture_type,
                $lecture_place,
                $lecture_count,
                $lecture_information
            );
            $sql_statement1->execute(); /* execution of query */
        }
        else {
            $sql_statement1 = $conn->prepare("
         UPDATE " . $class_table_name . "_subject_detail SET 
					col_lecture_area = ?,
					col_day = ?,
					col_teacher_name= ?,
					col_lecture_name= ?,
					col_lecture_type=?,
					col_lecture_place=?,
					col_lecture_count=?,
					col_lecture_information =? 
				     WHERE srno=?");

            $sql_statement1->bind_param("sissssiii",
                $lecture_area,
                $day,
                $teacher_name,
                $lecture_name,
                $lecture_type,
                $lecture_place,
                $lecture_count,
                $lecture_information,
                $data20['srno']
            );
            $sql_statement1->execute(); /* execution of query */
        }

        if ($lecture_area == "first_lecture") {
            for ($j = 1; $j <= $lecture_count; $j++) {
                if ($j == 2) {
                    $lecture_count = 3;
                }

                $available = 0;
                $sql_statement2 = $conn->prepare("
				    UPDATE " . $class_table_name . "_timetable SET 
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
                    $class_timming[$j - 1]
                );
                $sql_statement2->execute(); /* execution of query */

                $sql_statement3 = $conn->prepare("
				    UPDATE  " . $teacher_name . "_timetable SET 
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
                    $class_timming[$j - 1]
                );
                $sql_statement3->execute(); /* execution of query */

                if (!empty($lecture_place)) {
                    $sql_statement4 = $conn->prepare("
				    UPDATE  " . $lecture_place . "_timetable SET 
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
                        $class_timming[$j - 1]
                    );
                    $sql_statement4->execute(); /* execution of query */
                }
                if ($j == 2) {
                    $lecture_count = 2;
                }

            }

        }
        else {
            if ($lecture_area != "fullday_lecture") {
                $lecture_not_asign_loop = 0;
                $lecture_count_loop_even = 0;
                $lecture_count_loop_odd = $lecture_count;
                if ($lecture_count % 2 == 0 && ($day < 6 || $lecture_type != 0 || $lecture_count == 2)) {
                    $lecture_count_loop_even = $lecture_count / 2;
                    $lecture_count_loop_odd = 0;
                }
                else if ($day < 6 || $lecture_type != 0) {
                    if ($lecture_count - 1 != 0) {
                        $lecture_count = $lecture_count - 1;
                        $lecture_count_loop_even = $lecture_count / 2;
                        $lecture_count_loop_odd = 1;
                    }
                    else {
                        $lecture_count_loop_odd = $lecture_count;
                    }

                }


                if ($lecture_count_loop_even != 0) {
                    $subject_cheker = 0;
                    for ($lecture_count_index = 1; $lecture_count_index <= $lecture_count_loop_even; $lecture_count_index++) {
                        $class_timming_index_1 = -1;
                        $class_timming_index_2 = 0;
                        for ($per_day_lecture_count_index = $day_wise_id[0]; $per_day_lecture_count_index <= $day_wise_id[$class_timming_count - 1] + 1; $per_day_lecture_count_index++) {
                            //$subject_cheker = 1;
                            //setting of col day wise id 
                            //$lecture_id=$per_day_lecture_count_index; //$alternative_lecture_id=$per_day_lecture_count_index+1; 

                            //setting class postion[index] for time 
                            echo "<br><br> ci1 : " . $class_timming_index_1 = $class_timming_index_1 + 1;
                            echo "<br> ci2 : " . $class_timming_index_2 = $class_timming_index_2 + 1;
                            echo "<br>";
                            //setting all remaing data for odd loop 
                            if ($per_day_lecture_count_index > $day_wise_id[$class_timming_count - 1]) {
                                echo "<br> ol co : " . $lecture_count_loop_odd = $lecture_count_loop_odd + 2;
                                echo "<br>";
                                break;
                            }

                            //break if lecture is arrange
                            if (isset($insert_set)) {
                                $subject_cheker = 0;
                                unset($insert_set);
                                break;
                            }

                            $day_array = array('0', '1', '2', '3', '4', '5');
                            shuffle($day_array);

                            for ($day_index = 0; $day_index < 6; $day_index++) {

                                //break if lecture is arrange
                                if (isset($insert_set)) {
                                    $subject_cheker = 0;
                                    break;
                                }
                                //
                                if ($day < 6) {
                                    $day_for_cheking = $day;
                                }
                                else {
                                    $day_for_cheking = $day_array[$day_index];
                                }

                                if ($closed_day != $day_array[$day_index]) {
                                    if ($subject_cheker == 0) {

                                        /* Extractin  freesolt information from free_solt_detail table in database */
                                        echo "<br> q1 : " . $sql_query14 = "SELECT  *  FROM " . $class_table_name . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_lecture_name='" . $lecture_name . "' AND col_lecture_type='" . $lecture_type . "' ";
                                        $result14 = $conn->query($sql_query14); /* execution of query */
                                        /* extractinng from free_solt_detail table in database */
                                        $data14 = $result14->fetch_array();

                                        if (!isset($data14['col_timming'])) {
                                            /* Extractin  freesolt information from free_solt_detail table in database */
                                            echo "<br> q1 : " . $sql_query15 = "SELECT  *  FROM " . $class_table_name . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_lecture_type='" . $lecture_type . "' ";
                                            $result15 = $conn->query($sql_query15); /* execution of query */
                                            /* extractinng from free_solt_detail table in database */
                                            $data15 = $result15->fetch_array();
                                            if (!isset($data15['col_timming']) || $lecture_type == 0) {
                                                echo "<br> ns : " . $subject_cheker = 1;
                                            }
                                            else {
                                                echo "<br> s : " . $subject_cheker = 0;
                                            }
                                        }
                                        else {
                                            echo "<br> s : " . $subject_cheker = 0;
                                        }
                                    }
                                    if ($subject_cheker == 1) {

                                        /* Extractin freesolt information from free_solt_detail table in database */
                                        echo "<br> q2 : " . $sql_query15 = "SELECT  *  FROM " . $teacher_name . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_available='1' AND col_timming='" . $class_timming[$class_timming_index_1] . "' ";
                                        $result15 = $conn->query($sql_query15); /* execution of query */
                                        /* extractinng from free_solt_detail table in database */
                                        $data15 = $result15->fetch_array();

                                        /* Extractin  freesolt information from free_solt_detail table in database */
                                        echo " <br> q1 : " . $sql_query16 = "SELECT * FROM " . $teacher_name . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_available='1' AND col_timming ='" . $class_timming[$class_timming_index_2] . "' ";
                                        $result16 = $conn->query($sql_query16); /* execution of query */
                                        /* extractinng from free_solt_detail table in database */
                                        $data16 = $result16->fetch_array();

                                        /* Extractin freesolt information from free_solt_detail table in database */
                                        echo "<br> q2 : " . $sql_query17 = "SELECT  *  FROM " . $class_table_name . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_available='1' AND col_timming='" . $class_timming[$class_timming_index_1] . "' ";
                                        $result17 = $conn->query($sql_query17); /* execution of query */
                                        /* extractinng from free_solt_detail table in database */
                                        $data17 = $result17->fetch_array();

                                        /* Extractin  freesolt information from free_solt_detail table in database */
                                        echo " <br> q1 : " . $sql_query18 = "SELECT * FROM " . $class_table_name . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_available='1' AND col_timming ='" . $class_timming[$class_timming_index_2] . "' ";
                                        $result18 = $conn->query($sql_query18); /* execution of query */
                                        /* extractinng from free_solt_detail table in database */
                                        $data18 = $result18->fetch_array();

                                        if (isset($data15['col_timming']) && isset($data16['col_timming']) && isset($data17['col_timming']) && isset($data18['col_timming'])) {
                                            if (!empty($lecture_place)) {
                                                /* Extractin  freesolt information from free_solt_detail table in database */
                                                echo "<br> q2 : " . $sql_query17 = "SELECT  *  FROM " . $lecture_place . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_available='1' AND col_timming ='" . $class_timming[$class_timming_index_1] . "' ";
                                                $result17 = $conn->query($sql_query17); /* execution of query */
                                                /* extractinng from free_solt_detail table in database */
                                                $data17 = $result17->fetch_array();
                                            }
                                            else {
                                                $place_not_set = 1;
                                            }
                                            if (isset($data17['col_timming']) || isset($place_not_set)) {
                                                $insert_set = 1;
                                                $class_timming_value = $data15['col_timming'];
                                                $row_span = 2;
                                                for ($j = 1; $j <= $row_span; $j++) {

                                                    echo "<br> j : " . $j;
                                                    if ($j == 2) {
                                                        $row_span = 3;
                                                        $class_timming_value = $data16['col_timming'];
                                                    }
                                                    $available = 0;

                                                    $sql_statement2 = $conn->prepare("
                                UPDATE " . $class_table_name . "_timetable SET
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
                                                        $class_timming_value);
                                                    $sql_statement2->execute(); /* execution of query */

                                                    $sql_statement3 = $conn->prepare("
                                UPDATE " . $teacher_name . "_timetable SET
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
                                                        $class_timming_value);
                                                    $sql_statement3->execute(); /* execution of query */

                                                    if (!empty($lecture_place)) {
                                                        $sql_statement4 = $conn->prepare("
                                    UPDATE " . $lecture_place . "_timetable SET
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
                                                        $sql_statement4->execute(); /* execution of query */
                                                    }

                                                    if ($j == 2) {
                                                        $row_span = 2;
                                                    }
                                                }
                                            }
                                            else {
                                                echo "<br> sc in teach ns : " . $subject_cheker = 0;
                                            }
                                        }
                                        else {
                                            echo "<br> sc in teach ns : " . $subject_cheker = 0;
                                        }
                                    }
                                //for loop day index                     
                                }

                            //for loop $per_day_lecture_count_index     
                            }
                        }
                    }
                }

                if ($lecture_count_loop_odd != 0) {
                    $subject_cheker = 0;
                    for ($lecture_count_index = 1; $lecture_count_index <= $lecture_count_loop_odd; $lecture_count_index++) {

                        $class_timming_index_1 = -1;
                        //$class_timming_index_2=0; 
                        //note:each and every timeing in table its is runnning
                        for ($per_day_lecture_count_index = $day_wise_id[0]; $per_day_lecture_count_index <= $day_wise_id[$class_timming_count - 1] + 1; $per_day_lecture_count_index++) {
                            //$subject_cheker = 1;
                            //$day_wise_id=$day_wise_id[$per_day_lecture_count_index];
                            //setting of col day wise id
                            //$lecture_id=$per_day_lecture_count_index;
                            //$alternative_lecture_id=$per_day_lecture_count_index+1;

                            //setting class postion[index] for time
                            echo "<br><br> ci1 odd : " . $class_timming_index_1 = $class_timming_index_1 + 1;
                            echo "<br>";
                            //$class_timming_index_2=$class_timming_index_2+1;

                            //break if lecture is arrange
                            if (isset($insert_set)) {
                                if (!isset($perment_subject_cheker_set)) {
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

                            $day_array = array('0', '1', '2', '3', '4', '5');
                            shuffle($day_array);

                            for ($day_index = 0; $day_index < 6; $day_index++) {
                                //break if lecture is arrange
                                if (isset($insert_set)) {
                                    if (!isset($perment_subject_cheker_set)) {
                                        $subject_cheker = 0;
                                    }
                                    break;
                                }
                                //
                                if ($day < 6) {
                                    $day_for_cheking = $day;
                                }
                                else {
                                    $day_for_cheking = $day_array[$day_index];
                                }

                                if ($closed_day != $day_array[$day_index]) {
                                    if ($subject_cheker == 0) {
                                        /* Extractin  freesolt information from free_solt_detail table in database */
                                        echo "<br> q1 odd : " . $sql_query14 = "SELECT  *  FROM " . $class_table_name . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_lecture_name='" . $lecture_name . "' AND col_lecture_type='" . $lecture_type . "' ";
                                        $result14 = $conn->query($sql_query14); /* execution of query */
                                        /* extractinng from free_solt_detail table in database */
                                        $data14 = $result14->fetch_array();

                                        if (!isset($data14['col_timming'])) {
                                            if ($lecture_type != 0) {
                                                /* Extractin  freesolt information from free_solt_detail table in database */
                                                echo "<br> q1 : " . $sql_query15 = "SELECT  *  FROM " . $class_table_name . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_lecture_type NOT IN('0')";
                                                $result15 = $conn->query($sql_query15); /* execution of query */
                                                /* extractinng from free_solt_detail table in database */
                                                $data15 = $result15->fetch_array();
                                                if (!isset($data15['col_timming'])) {
                                                    echo "<br> s1 l : " . $subject_cheker = 1;
                                                }
                                                else {
                                                    echo "<br> s0 l : " . $subject_cheker = 0;
                                                }
                                            }
                                            else {
                                                echo "<br> s1 l out : " . $subject_cheker = 1;
                                            }

                                        }
                                        else {
                                            echo "<br> s0 : " . $subject_cheker = 0;
                                        }
                                    }
                                    if ($subject_cheker == 1) {

                                        /* Extractin  freesolt information from free_solt_detail table in database */
                                        echo "<br> q2 : " . $sql_query15 = "SELECT  *  FROM " . $teacher_name . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_available='1' AND col_timming ='" . $class_timming[$class_timming_index_1] . "' ";
                                        $result15 = $conn->query($sql_query15); /* execution of query */
                                        /* extractinng from free_solt_detail table in database */
                                        $data15 = $result15->fetch_array();

                                        /* Extractin  freesolt information from free_solt_detail table in database */
                                        echo "<br> q2 : " . $sql_query16 = "SELECT  *  FROM " . $class_table_name . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_available='1' AND col_timming ='" . $class_timming[$class_timming_index_1] . "' ";
                                        $result16 = $conn->query($sql_query16); /* execution of query */
                                        /* extractinng from free_solt_detail table in database */
                                        $data16 = $result16->fetch_array();

                                        if (isset($data15['col_timming']) && isset($data16['col_timming'])) {
                                            if (!empty($lecture_place)) {
                                                /* Extractin  freesolt information from free_solt_detail table in database */
                                                echo "<br> q2 : " . $sql_query17 = "SELECT  *  FROM " . $lecture_place . "_timetable WHERE col_day='" . $day_for_cheking . "' AND col_available='1' AND col_timming ='" . $class_timming[$class_timming_index_1] . "' ";
                                                $result17 = $conn->query($sql_query17); /* execution of query */
                                                /* extractinng from free_solt_detail table in database */
                                                $data17 = $result17->fetch_array();
                                            }
                                            else {
                                                $place_not_set = 1;
                                            }
                                            if (isset($data17['col_timming']) || isset($place_not_set)) {
                                                unset($place_not_set);
                                                echo "<br> is : " . $insert_set = 1;
                                                $class_timming_value = $data15['col_timming'];
                                                $row_span = 1;
                                                /* for($j=1;$j<=$row_span;$j++) { echo "<br> j : " .$j; if($j==2) { $row_span=3; $class_timming_value=$data16['col_timming']; }*/$available = 0;
                                                $sql_statement2 = $conn->prepare("
                                    UPDATE " . $class_table_name . "_timetable SET
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
                                                $sql_statement2->execute(); /* execution of query */

                                                $sql_statement3 = $conn->prepare("
                                    UPDATE " . $teacher_name . "_timetable SET
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
                                                $sql_statement3->execute(); /* execution of query */

                                                if (!empty($lecture_place)) {
                                                    $sql_statement4 = $conn->prepare("
                                    UPDATE " . $lecture_place . "_timetable SET
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
                                                    $sql_statement4->execute(); /* execution of query */
                                                }
                                                break;
                                            }
                                            else {
                                                if (!isset($perment_subject_cheker_set)) {
                                                    echo "<br> sc in teach ns odd : " . $subject_cheker = 0;
                                                }

                                            }
                                        }
                                        else {
                                            if (!isset($perment_subject_cheker_set)) {
                                                echo "<br> sc in teach ns odd : " . $subject_cheker = 0;
                                            }

                                        }
                                    }
                                }
                            }

                            if ($per_day_lecture_count_index == $day_wise_id[$class_timming_count - 1] && !isset($perment_subject_cheker_set) && !isset($insert_set)) {
                                echo "per day lecture count reach";
                                $per_day_lecture_count_index = $day_wise_id[0];
                                $perment_subject_cheker_set = "1";
                                $subject_cheker = 1;
                                $class_timming_index_1 = -1;
                            }
                        }
                    }
                }
            }

            if ($lecture_area == "fullday_lecture") {
                for ($j = 0; $j < $class_timming_count; $j++) {
                    /* Extractin  freesolt information from free_solt_detail table in database */
                    echo "<br> q2 : " . $sql_query15 = "SELECT  *  FROM " . $teacher_name . "_timetable WHERE col_day='" . $day . "' AND col_available='1' AND col_timming ='" . $class_timming[$j] . "' ";
                    $result15 = $conn->query($sql_query15); /* execution of query */
                    /* extractinng from free_solt_detail table in database */
                    $data15 = $result15->fetch_array();

                    /* Extractin  freesolt information from free_solt_detail table in database */
                    echo "<br> q2 : " . $sql_query16 = "SELECT  *  FROM " . $class_table_name . "_timetable WHERE col_day='" . $day . "' AND col_available='1' AND col_timming ='" . $class_timming[$j] . "' ";
                    $result16 = $conn->query($sql_query16); /* execution of query */
                    /* extractinng from free_solt_detail table in database */
                    $data16 = $result16->fetch_array();


                    if (isset($data15['col_timming']) && isset($data16['col_timming'])) {
                        echo "<br> is : " . $insert_set = 1;
                        $class_timming_value = $data15['col_timming'];
                        $row_span = 1;
                        /* for($j=1;$j<=$row_span;$j++) { echo "<br> j : " .$j; if($j==2) { $row_span=3; $class_timming_value=$data16['col_timming']; }*/$available = 0;
                        $sql_statement2 = $conn->prepare("
                                    UPDATE " . $class_table_name . "_timetable SET
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
                        $sql_statement2->execute(); /* execution of query */

                        $sql_statement3 = $conn->prepare("
                                    UPDATE " . $teacher_name . "_timetable SET
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
                        $sql_statement3->execute(); /* execution of query */

                        if (!empty($lecture_place)) {
                            $sql_statement4 = $conn->prepare("
                                    UPDATE " . $lecture_place . "_timetable SET
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
                            $sql_statement4->execute(); /* execution of query */
                        }
                    }
                }
            }
        }

    }
}

//diplaying timetable
if (isset($_POST['display_class_name'])) 
{
    $class_table_name = htmlspecialchars($_POST['display_class_name']);

    /* Finding class_time_detail table in database */
    $sql_query1 = "SELECT * FROM " . $class_table_name . "_time_detail";
    $result1 = $conn->query($sql_query1); /* execution of query */
    /* extractinng class_time_detail table in database */
    $data1 = $result1->fetch_array();

    if ($data1['col_holiday'] != 0) {
        $closed_day = $data1['col_closed_day'];
    }
    else {
        $closed_day = 6;
    }

    $day_array = array('Monday', 'Tuesday', 'Wensday', 'Thursday', 'Friday', 'Saturday');

?>
 <table border="2px" width="100%">
        <tr>
            <th>Time</th>
            <?php
    $day_col_count = 0;
    $day = " ";
    for ($a = 0; $a < 6; $a++) {
        if ($closed_day != $a) {
            //total day count for class timetable 
            $day_col_count = $day_col_count + 1;
            //variable for removing time of per day from class time table 
            if ($day == " ") {
                $day = $a;
            }

            //echo subject name as per user defined
            echo '<th>' . $day_array[$a] . '</th>';
        }
    }
?>
     </tr>
    <?php
    //removing time details from class timetable
    $sql_query2 = "SELECT * FROM " . $class_table_name . "_timetable WHERE col_day=" . $day . "";
    $result2 = $conn->query($sql_query2); /* execution of query */
    /* extractinng class_time_detail table in database */
    while ($data2 = $result2->fetch_array()) {
        $timming[] = $data2['col_timming'];
    }

    $timming_count = count($timming);
    $recess_set = 0;
    $lecture_type_array = array('(TH)', '(PR)', '(EA)');

    $first_arry_index = htmlspecialchars($_POST["first_arry_index"]);
    $avilable_solt = $_SESSION["avilable_solt"][$first_arry_index];
    $avilable_solt_count = count($_SESSION["avilable_solt"][$first_arry_index]);

    for ($b = 0; $b < $timming_count; $b++) {
        unset($srno, $day_wise_id, $class_available, $timming_id, $teacher_name, $lecture_name, $lecture_type, $lecture_place, $row_span);

        //removing data of every day as per time solt
        $sql_query3 = "SELECT * FROM " . $class_table_name . "_timetable WHERE col_timming='" . $timming[$b] . "' ";
        $result3 = $conn->query($sql_query3); /* execution of query */

        /* extractinng class_time_detail table in database */
        while ($data3 = $result3->fetch_array()) {
            $srno[] = $data3['srno'];
            $day_wise_id[] = $data3['col_day_wise_id'];
            $class_available[] = $data3['col_available'];
            $timming_id[] = $data3['col_timming_id'];
            $teacher_name[] = $data3['col_teacher_name'];
            $lecture_name[] = $data3['col_lecture_name'];
            $lecture_type[] = $data3['col_lecture_type'];
            $lecture_place[] = $data3['col_lecture_place'];
            $row_span[] = $data3['col_row_span'];

        }

        echo '<tr>
                            <td>' . $timming[$b] . '</td>';
        for ($c = 0; $c < $day_col_count; $c++) {
            if (isset($day_wise_id[$c])) {
                unset($avilable_solt_set, $teacher_name_set);
                if ($day_wise_id[$c] != 0) {
                    if (isset($teacher_name[$c])) {
                        if ($class_available[$c] != 1) {
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
                            for ($d = 0; $d < $avilable_solt_count; $d++) {
                                if ($timming_id[$c] == $avilable_solt[$d]) {
                                    $avilable_solt_set = 1;
                                    echo "<td style='color:white;background-color:Blue;' >";
                                    break;
                                }
                            }

                            if (!isset($avilable_solt_set)) {
                                echo "<td>";
                            }

                            echo "id : " . $srno[$c];
                            echo "<br>teacher name : " . $teacher_name[$c];
                            echo "<br>lecture name : " . $lecture_name[$c] . " " . $lecture_type_array[$lecture_type[$c]];

                            if (isset($lecture_place[$c])) {
                                echo "<br>lecture place : " . $lecture_place[$c] . "</td>";
                            }
                            else {
                                echo "</td>";
                            }
                        }
                        else {
                            $teacher_name_set = 1;
                        }
                    }

                    if (!isset($teacher_name[$c]) || isset($teacher_name_set)) {
                        for ($d = 0; $d < $avilable_solt_count; $d++) {
                            if ($timming_id[$c] == $avilable_solt[$d]) {
                                $avilable_solt_set = 1;
                                echo "<td style='color:white;background-color:Blue;' >";
                            }
                        }

                        if (!isset($avilable_solt_set)) {
                            echo "<td style='color:red;'>";
                        }

                        echo "id : " . $srno[$c];
                        echo "<br>teacher name : -----";
                        echo "<br>lecture name : ----- ";
                        echo "<br>lecture place : ----- </td>";
                    }
                }
                else {

                    if ($recess_set == 0) {
                        $recess_set = 1;
                        echo "<td colspan='" . $day_col_count . "'>Recess</td>";
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
    $_SESSION["avilable_solt"][0] = array(1);
}

//checking teacher avilableity for exange 
if (isset($_POST['first_id'])) 
{
    $class_table_name = htmlspecialchars($_POST['class_table_name']);
    $first_id = htmlspecialchars($_POST["first_id"]);

    //removing time details from class timetable
    $sql_query1 = "SELECT * FROM " . $class_table_name . "_timetable WHERE srno=" . $first_id . "";
    $result1 = $conn->query($sql_query1); /* execution of query */
    /* extractinng class_time_detail table in database */
    $data1 = $result1->fetch_array();
    if (isset($data1['col_teacher_name'])) {
        //removing time details from class timetable
        $sql_query2 = "SELECT * FROM " . $class_table_name . "_timetable";
        $result2 = $conn->query($sql_query2); /* execution of query */
        /* extractinng class_time_detail table in database */
        while ($data2 = $result2->fetch_array()) {
            $timetable_srno[] = $data2['srno'];
            $timetable_day[] = $data2['col_day'];
            $timetable_timming[] = $data2['col_timming'];
            $timetable_timming_id[] = $data2['col_timming_id'];
            $timetable_teacher_name[] = $data2['col_teacher_name'];
            $timetable_lecture_place[] = $data2['col_lecture_place'];
        }
        /*counting of data */
        $class_loop_count = count($timetable_timming);

        for ($class_index = 0; $class_index < $class_loop_count; $class_index++) {
            $id_set = 1;
            if ($data1['col_teacher_name'] != $timetable_teacher_name[$class_index]) {
                /* Extractin  freesolt information from free_solt_detail table in database */
                $sql_query4 = "SELECT  *  FROM " . $data1['col_teacher_name'] . "_timetable WHERE col_day='" . $timetable_day[$class_index] . "' AND col_available='1' AND col_timming ='" . $timetable_timming[$class_index] . "' ";
                $result4 = $conn->query($sql_query4); /* execution of query */
                /* extractinng from free_solt_detail table in database */
                $data4 = $result4->fetch_array();

                if (isset($data1['col_lecture_place'])) {
                    /* Extractin  freesolt information from free_solt_detail table in database */
                    $sql_query5 = "SELECT  *  FROM " . $data1['col_lecture_place'] . "_timetable WHERE col_day='" . $timetable_day[$class_index] . "' AND col_available='1' AND col_timming ='" . $timetable_timming[$class_index] . "' ";
                    $result5 = $conn->query($sql_query5); /* execution of query */
                    /* extractinng from free_solt_detail table in database */
                    $data5 = $result5->fetch_array();
                }
                else {
                    $lecture_place_5 = "1";
                }

                if (isset($data4['col_timming']) && (isset($data5['col_timming']) || $lecture_place_5 == "1")) {
                    unset($lecture_place_5, $lecture_place_7);
                    if (isset($timetable_teacher_name[$class_index])) {
                        /* Extractin  freesolt information from free_solt_detail table in database */
                        $sql_query6 = "SELECT  *  FROM " . $timetable_teacher_name[$class_index] . "_timetable WHERE col_day='" . $data1['col_day'] . "' AND col_available='1' AND col_timming ='" . $data1['col_timming'] . "' ";
                        $result6 = $conn->query($sql_query6); /* execution of query */
                        /* extractinng from free_solt_detail table in database */
                        $data6 = $result6->fetch_array();

                        if (isset($timetable_lecture_place[$class_index])) {
                            /* Extractin  freesolt information from free_solt_detail table in database */
                            $sql_query7 = "SELECT  *  FROM " . $timetable_lecture_place[$class_index] . "_timetable WHERE col_day='" . $data1['col_day'] . "' AND col_available='1' AND col_timming ='" . $data1['col_timming'] . "' ";
                            $result7 = $conn->query($sql_query7); /* execution of query */
                            /* extractinng from free_solt_detail table in database */
                            $data7 = $result7->fetch_array();

                            if ($timetable_lecture_place[$class_index] == $data1['col_lecture_place']) {
                                $data7['col_teacher_name'] = "1";
                            }
                        }
                        else {
                            $lecture_place_7 = "1";
                        }


                        if (isset($data6['col_timming']) && (isset($data7['col_timming']) || $lecture_place_7 == 1)) {
                            if (!isset($perment_set)) {
                                $perment_set = 1;
                                echo '
                                <select name="second_id" id="second_id" onchange="exchange_enable();">
                                    <option value="ns" >Not Selected</option>
                                ';
                            }
                            $avilable_solt[] = $timetable_timming_id[$class_index];

                            echo '<option value="' . $timetable_srno[$class_index] . '">' . $timetable_srno[$class_index] . '</option>';
                        }
                    }
                    else {
                        if (!isset($perment_set)) {
                            $perment_set = 1;
                            echo '
                            <select name="second_id" id="second_id" onchange="exchange_enable();">
                                <option value="ns" >Not Selected</option>
                            ';
                        }
                        $avilable_solt[] = $timetable_timming_id[$class_index];
                        echo '<option value="' . $timetable_srno[$class_index] . '">' . $timetable_srno[$class_index] . '</option>';
                    }
                }
            }
            else {
                if (isset($data1['col_lecture_place'])) {
                    $id_set = 0;
                    if ($data1['col_lecture_place'] != $timetable_lecture_place[$class_index]) {
                        /* Extractin  freesolt information from free_solt_detail table in database */
                        $sql_query8 = "SELECT  *  FROM " . $data1['col_lecture_place'] . "_timetable WHERE col_day='" . $timetable_day[$class_index] . "' AND col_available='1' AND col_timming ='" . $timetable_timming[$class_index] . "' ";
                        $result8 = $conn->query($sql_query8); /* execution of query */
                        /* extractinng from free_solt_detail table in database */
                        $data8 = $result8->fetch_array();

                        if (isset($data8['col_timming'])) {
                            $id_set = 1;
                        }
                    }
                    else {
                        $id_set = 1;
                    }
                }

                if ($id_set == 1 && $timetable_srno[$class_index] != $first_id) {
                    if (!isset($perment_set)) {
                        $perment_set = 1;
                        echo '
                        <select name="second_id" id="second_id" onchange="exchange_enable();">
                            <option value="ns" >Not Selected</option>
                        ';
                    }
                    $avilable_solt[] = $timetable_timming_id[$class_index];
                    echo '<option value="' . $timetable_srno[$class_index] . '">' . $timetable_srno[$class_index] . '</option>';
                }
            }
        }

        if (!isset($perment_set)) {
            echo '<span id="error">no id is present for excange</span>';
        }
        else {
            echo '	</select>
			';
            $_SESSION["avilable_solt"][0] = $avilable_solt;
        }
    }
    else {
        echo '<span id="error">There is no teacher on this id</span>';
    }
}

//checking teacher avilableity for exange 
if (isset($_POST['second_id'])) 
{
    $class_table_name = htmlspecialchars($_POST['class_table_name']);
    $first_id = htmlspecialchars($_POST["first_id"]);
    $second_id = htmlspecialchars($_POST["second_id"]);

    //removing first id detail from class timetable
    $sql_query1 = "SELECT * FROM " . $class_table_name . "_timetable WHERE srno=" . $first_id . "";
    $result1 = $conn->query($sql_query1); /* execution of query */
    /* extractinng class_time_detail table in database */
    $data1 = $result1->fetch_array();
    $data[1] = $data1;

    //removing second id detail  from class timetable
    $sql_query2 = "SELECT * FROM " . $class_table_name . "_timetable WHERE srno=" . $second_id . "";
    $result2 = $conn->query($sql_query2); /* execution of query */
    /* extractinng class_time_detail table in database */
    $data2 = $result2->fetch_array();
    $data[2] = $data2;

    //update rowspan in all table
    function update_rowspan($data, $class_table_name, $exchange_id, $col_day_wise_id, $conn)
    {
        //updating from class timetable
        $sql_query3 = "UPDATE " . $class_table_name . "_timetable SET col_row_span ='1' WHERE col_day='" . $data[$exchange_id]['col_day'] . "' AND col_day_wise_id='" . $col_day_wise_id . "' ";
        $conn->query($sql_query3); /* execution of query */
        echo "<br>";
        //updating from teacher timetable
        $sql_query4 = "UPDATE " . $data[$exchange_id]['col_teacher_name'] . "_timetable SET col_row_span ='1' WHERE col_day='" . $data[$exchange_id]['col_day'] . "' AND col_day_wise_id='" . $col_day_wise_id . "' ";
        $conn->query($sql_query4); /* execution of query */
        echo "<br>";
        if (null !== $data[$exchange_id]['col_lecture_place'] && $data[$exchange_id != " "]['col_lecture_place']) {
            //updating from teacher timetable
            $sql_query5 = "UPDATE " . $data[$exchange_id]['col_lecture_place'] . "_timetable SET col_row_span ='1' WHERE col_day='" . $data[$exchange_id]['col_day'] . "' AND col_day_wise_id='" . $col_day_wise_id . "'  ";
            $conn->query($sql_query5); /* execution of query */
            echo "<br>";
        }
    }

    //update subject detail
    function update_subject_detail($data, $class_table_name, $exchange_id, $conn, $exchange_id_2)
    {
        if (null !== $data[$exchange_id]['col_lecture_place'] && $data[$exchange_id]['col_lecture_place'] != " ") {
            $col_lecture_place = ",col_lecture_place='" . $data[$exchange_id]['col_lecture_place'] . "'";
        }
        else {
            $col_lecture_place = ",col_lecture_place=null";
        }

        if ($data[$exchange_id]['col_day_wise_id'] == 2) {
            /* updateing subject detail table in database */
            echo "<br> cdwi !=1 " . $sql_query6 = "UPDATE " . $class_table_name . "_subject_detail SET col_lecture_count ='1' WHERE col_lecture_area='first_lecture' AND col_day='" . $data[$exchange_id]['col_day'] . "'";
            $conn->query($sql_query6); /* execution of query */
            echo "<br>";
        }
        else {
            $not_isert_set = 0;
            if ($data[$exchange_id]['col_day_wise_id'] == 1 && $data[$exchange_id_2]['col_day_wise_id'] == 1) {
                if (isset($data[$exchange_id]['col_teacher_name'])) {
                    $update_set = "col_teacher_name='" . $data[$exchange_id]['col_teacher_name'] . "',col_lecture_name='" . $data[$exchange_id]['col_lecture_name'] . "',col_lecture_type='" . $data[$exchange_id]['col_lecture_type'] . "' " . $col_lecture_place . ",col_lecture_count ='1'";
                }
                else {
                    $update_set = "col_teacher_name=null,col_lecture_name=null,col_lecture_type=null,col_lecture_place=null,col_lecture_count =null";
                }
                /* updateing subject detail table in database */
                echo "<br> cdwi both_s_d ==1 " . $sql_query6 = "UPDATE " . $class_table_name . "_subject_detail SET col_lecture_count ='1',col_lecture_area='before_recess_lecture' WHERE col_lecture_area='first_lecture' AND col_day='" . $data[$exchange_id_2]['col_day'] . "'";
                $conn->query($sql_query6); /* execution of query */
                echo "<br>";

                /* insert data in subject detail table in database */
                echo "<br> cdwi both_s_d ==1 " . $sql_query8 = "INSERT INTO " . $class_table_name . "_subject_detail (col_lecture_area,col_day,col_teacher_name,col_lecture_name,col_lecture_type,col_lecture_place,col_lecture_count) VALUES ('first_lecture','" . $data[$exchange_id_2]['col_day'] . "','" . $data[$exchange_id]['col_teacher_name'] . "','" . $data[$exchange_id]['col_lecture_name'] . "','" . $data[$exchange_id]['col_lecture_type'] . "' " . $col_lecture_place . ",'1')";
                $conn->query($sql_query8); /* execution of query */
            }
            else {
                /* updateing subject detail table in database */
                echo "<br> cdwi one !=1 " . $sql_query6 = "UPDATE " . $class_table_name . "_subject_detail SET col_lecture_count ='2',col_lecture_area='before_recess_lecture',col_day=null WHERE col_lecture_area='first_lecture' AND col_day='" . $data[$exchange_id]['col_day'] . "'";
                $conn->query($sql_query6); /* execution of query */
                echo "<br>";
            }
        }

        if (!isset($not_isert_set)) {
            /* Extractin data subject detail table in database */
            echo "<br>" . $sql_query7 = "SELECT * FROM " . $class_table_name . "_subject_detail ";
            $result7 = $conn->query($sql_query7); /* execution of query */
            /* extractinng from free_solt_detail table in database */
            $data7 = $result7->fetch_array();

            $col_day = $data[$exchange_id_2]['col_day'];

            /* insert data in subject detail table in database */
            echo "<br>" . $sql_query8 = "INSERT INTO " . $class_table_name . "_subject_detail (col_lecture_area,col_day,col_teacher_name,col_lecture_name,col_lecture_type,col_lecture_place,col_lecture_count) VALUES ('before_recess_lecture','" . $col_day . "','" . $data[$exchange_id]['col_teacher_name'] . "','" . $data[$exchange_id]['col_lecture_name'] . "','" . $data[$exchange_id]['col_lecture_type'] . "' " . $col_lecture_place . ",'1')";
            $conn->query($sql_query8); /* execution of query */
        }
    }

    //update id 1 to id 2 in all table
    function update_id_1($data1, $data2, $class_table_name, $conn)
    {
        if (null !== $data1['col_lecture_place'] && $data1['col_lecture_place'] != " ") {
            $col_lecture_place = ", col_lecture_place ='" . $data1['col_lecture_place'] . "'";
        }
        else {
            $col_lecture_place = ", col_lecture_place = null";
        }

        if (null !== $data1['col_batch'] && $data1['col_batch'] != " ") {
            $col_batch = ", col_batch ='" . $data1['col_batch'] . "'";
        }
        else {
            $col_batch = ", col_batch = null";
        }

        if (null !== $data1['col_batch_day'] && $data1['col_batch_day'] != " ") {
            $col_batch_day = ", col_batch_day ='" . $data1['col_batch_day'] . "'";
        }
        else {
            $col_batch_day = ", col_batch_day = null";
        }

        if (null !== $data1['col_batch_student'] && $data1['col_batch_student'] != " ") {
            $col_batch_student = ", col_batch_student ='" . $data1['col_batch_student'] . "'";
        }
        else {
            $col_batch_student = ", col_batch_student = null";
        }

        //updating from class timetable
        $sql_query9 = "UPDATE " . $class_table_name . "_timetable SET  col_teacher_name ='" . $data1['col_teacher_name'] . "', col_lecture_name ='" . $data1['col_lecture_name'] . "', col_lecture_type ='" . $data1['col_lecture_type'] . "'" . $col_lecture_place . $col_batch . $col_batch_day . $col_batch_student . ",col_class_name='" . $data1['col_class_name'] . "',col_row_span ='1', col_available ='" . $data1['col_available'] . "' WHERE col_timming_id='" . $data2['col_timming_id'] . "'";
        $conn->query($sql_query9); /* execution of query */

        //updating from teacher timetable
        $sql_query10 = "UPDATE " . $data1['col_teacher_name'] . "_timetable SET  col_teacher_name ='" . $data1['col_teacher_name'] . "', col_lecture_name ='" . $data1['col_lecture_name'] . "', col_lecture_type ='" . $data1['col_lecture_type'] . "'" . $col_lecture_place . $col_batch . $col_batch_day . $col_batch_student . ",col_class_name ='" . $data1['col_class_name'] . "',col_row_span ='1', col_available ='" . $data1['col_available'] . "' WHERE col_timming_id='" . $data2['col_timming_id'] . "'";
        $conn->query($sql_query10); /* execution of query */

        //updating odd placde teacher timetable
        $sql_query11 = "UPDATE " . $data1['col_teacher_name'] . "_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_timming_id='" . $data1['col_timming_id'] . "'";
        $conn->query($sql_query11); /* execution of query */

        if (null !== $data1['col_lecture_place'] && $data1['col_lecture_place'] != " ") {
            //updating from lecture place timetable
            $sql_query12 = "UPDATE " . $data1['col_lecture_place'] . "_timetable SET  col_teacher_name ='" . $data1['col_teacher_name'] . "', col_lecture_name ='" . $data1['col_lecture_name'] . "', col_lecture_type ='" . $data1['col_lecture_type'] . "'" . $col_lecture_place . $col_batch . $col_batch_day . $col_batch_student . ",col_class_name ='" . $data1['col_class_name'] . "',col_row_span ='1', col_available ='" . $data1['col_available'] . "' WHERE col_timming_id='" . $data2['col_timming_id'] . "'";
            $conn->query($sql_query12); /* execution of query */

            //updating odd  lecture place timetable
            $sql_query13 = "UPDATE " . $data1['col_lecture_place'] . "_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_timming_id='" . $data1['col_timming_id'] . "'";
            $conn->query($sql_query13); /* execution of query */
        }
    }

    //update id 2 to id 1 in all table
    function update_id_2($data1, $data2, $class_table_name, $conn)
    {
        if (isset($data2['col_row_span'])) {
            if (null !== $data2['col_lecture_place'] && $data2['col_lecture_place'] != " ") {
                $col_lecture_place = ", col_lecture_place ='" . $data2['col_lecture_place'] . "'";
            }
            else {
                $col_lecture_place = ", col_lecture_place = null";
            }

            if (null !== $data2['col_batch'] && $data2['col_batch'] != " ") {
                $col_batch = ", col_batch ='" . $data2['col_batch'] . "'";
            }
            else {
                $col_batch = ", col_batch = null";
            }

            if (null !== $data2['col_batch_day'] && $data2['col_batch_day'] != " ") {
                $col_batch_day = ", col_batch_day ='" . $data2['col_batch_day'] . "'";
            }
            else {
                $col_batch_day = ", col_batch_day = null";
            }

            if (null !== $data2['col_batch_student'] && $data2['col_batch_student'] != " ") {
                $col_batch_student = ", col_batch_student ='" . $data2['col_batch_student'] . "'";
            }
            else {
                $col_batch_student = ", col_batch_student = null";
            }

            //updating from class timetable
            $sql_query14 = "UPDATE " . $class_table_name . "_timetable SET  col_teacher_name ='" . $data2['col_teacher_name'] . "', col_lecture_name ='" . $data2['col_lecture_name'] . "', col_lecture_type ='" . $data2['col_lecture_type'] . "'" . $col_lecture_place . $col_batch . $col_batch_day . $col_batch_student . ",col_class_name ='" . $data2['col_class_name'] . "',col_row_span ='1', col_available ='" . $data2['col_available'] . "' WHERE col_timming_id='" . $data1['col_timming_id'] . "'";
            $conn->query($sql_query14); /* execution of query */

            //updating from teacher timetable
            $sql_query15 = "UPDATE " . $data2['col_teacher_name'] . "_timetable SET  col_teacher_name ='" . $data2['col_teacher_name'] . "', col_lecture_name ='" . $data2['col_lecture_name'] . "', col_lecture_type ='" . $data2['col_lecture_type'] . "'" . $col_lecture_place . $col_batch . $col_batch_day . $col_batch_student . ",col_class_name ='" . $data2['col_class_name'] . "',col_row_span ='1', col_available ='" . $data2['col_available'] . "' WHERE col_timming_id='" . $data1['col_timming_id'] . "'";
            $conn->query($sql_query15); /* execution of query */
            if ($data2['col_teacher_name'] != $data1['col_teacher_name']) {
                //updating odd placde teacher timetable
                $sql_query16 = "UPDATE " . $data2['col_teacher_name'] . "_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_timming_id='" . $data2['col_timming_id'] . "'";
                $conn->query($sql_query16); /* execution of query */
            }

            if (null !== $data2['col_lecture_place'] && $data2['col_lecture_place'] != " ") {
                //updating from lecture place timetable
                $sql_query17 = "UPDATE " . $data2['col_lecture_place'] . "_timetable SET  col_teacher_name ='" . $data2['col_teacher_name'] . "', col_lecture_name ='" . $data2['col_lecture_name'] . "', col_lecture_type ='" . $data2['col_lecture_type'] . "'" . $col_lecture_place . $col_batch . $col_batch_day . $col_batch_student . ",col_class_name ='" . $data2['col_class_name'] . "',col_row_span ='1', col_available ='" . $data2['col_available'] . "' WHERE col_timming_id='" . $data1['col_timming_id'] . "'";
                $conn->query($sql_query17); /* execution of query */

                if ($data2['col_lecture_place'] != $data1['col_lecture_place']) {
                    //updating odd placde lecture place timetable
                    $sql_query18 = "UPDATE " . $data2['col_lecture_place'] . "_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='1' WHERE col_timming_id='" . $data2['col_timming_id'] . "'";
                    $conn->query($sql_query18); /* execution of query */
                }
            }
        }
        else {
            //updating from class timetable
            $sql_query19 = "UPDATE " . $class_table_name . "_timetable SET  col_teacher_name = null, col_lecture_name = null, col_lecture_type =null, col_lecture_place = null, col_batch =null, col_batch_day =null, col_batch_student =null,col_class_name =null,col_row_span =null, col_available ='" . $data2['col_available'] . "' WHERE col_timming_id='" . $data1['col_timming_id'] . "'";
            $conn->query($sql_query19); /* execution of query */
        }
    }

    //loop for 2 id
    for ($exchange_id = 1; $exchange_id < 3; $exchange_id++) {
        if ($exchange_id == 1) {
            $exchange_id_2 = 2;
        }
        else {
            $exchange_id_2 = 1;
        }

        if (null !== $data[$exchange_id]['col_lecture_place'] && $data[$exchange_id]['col_lecture_place'] != " ") {
            $col_lecture_place = ",col_lecture_place='" . $data[$exchange_id]['col_lecture_place'] . "'";
        }
        else {
            $col_lecture_place = ",col_lecture_place=null";
        }

        if (isset($data[$exchange_id]['col_row_span'])) {
            /* Extractin data subject detail table in database */
            echo "<br>" . $sql_query23 = "SELECT * FROM " . $class_table_name . "_subject_detail WHERE col_teacher_name='" . $data[$exchange_id]['col_teacher_name'] . "' ";
            $result23 = $conn->query($sql_query23); /* execution of query */
            /* extractinng from free_solt_detail table in database */
            $data23 = $result23->fetch_array();
            /* extractinng from table in database */
            while ($data13 = $result13->fetch_array()) {
                if ($data13['col_lecture_area'] == "first_lecture" && !isset($data13['col_lecture_set'])) {
                    if ($data[$exchange_id]['col_day_wise_id'] == 1 && data[$exchange_id_2]['col_day_wise_id'] == 1) {
                        /* updateing subject detail table in database */
                        echo "<br> cdwi both_s_d ==1 " . $sql_query6 = "UPDATE " . $class_table_name . "_subject_detail SET col_lecture_count ='1',col_lecture_area='before_recess_lecture' WHERE col_lecture_area='first_lecture' AND col_day='" . $data[$exchange_id_2]['col_day'] . "'";
                        $conn->query($sql_query6); /* execution of query */
                        echo "<br>";

                        /* insert data in subject detail table in database */
                        echo "<br> cdwi both_s_d ==1 " . $sql_query8 = "INSERT INTO " . $class_table_name . "_subject_detail (col_lecture_area,col_day,col_teacher_name,col_lecture_name,col_lecture_type,col_lecture_place,col_lecture_count) VALUES ('first_lecture','" . $data[$exchange_id_2]['col_day'] . "','" . $data[$exchange_id]['col_teacher_name'] . "','" . $data[$exchange_id]['col_lecture_name'] . "','" . $data[$exchange_id]['col_lecture_type'] . "' " . $col_lecture_place . ",'1')";
                        $conn->query($sql_query8); /* execution of query */
                    }

                    if ($data[$exchange_id]['col_day_wise_id'] == 1 && data[$exchange_id_2]['col_day_wise_id'] != 1) {
                        /* updateing subject detail table in database */
                        echo "<br> cdwi one !=1 " . $sql_query6 = "UPDATE " . $class_table_name . "_subject_detail SET col_lecture_count ='2',col_lecture_area='before_recess_lecture',col_day=null WHERE col_lecture_area='first_lecture' AND col_day='" . $data[$exchange_id]['col_day'] . "'";
                        $conn->query($sql_query6); /* execution of query */
                        echo "<br>";
                    }

                    if ($data[$exchange_id]['col_day_wise_id'] != 1 && data[$exchange_id_2]['col_day_wise_id'] == 1) {
                        /* updateing subject detail table in database */
                        echo "<br> cdwi !=1 " . $sql_query6 = "UPDATE " . $class_table_name . "_subject_detail SET col_teacher_name='" . $data[$exchange_id]['col_teacher_name'] . "',col_lecture_name='" . $data[$exchange_id]['col_lecture_name'] . "',col_lecture_type='" . $data[$exchange_id]['col_lecture_type'] . "' " . $col_lecture_place . ",col_lecture_count ='1' WHERE col_lecture_area='first_lecture' AND col_day='" . $data[$exchange_id_2]['col_day'] . "'";
                        $conn->query($sql_query6); /* execution of query */
                        echo "<br>";
                    }
                    break;
                }
                else {

                }
            }

            if ($data[$exchange_id]['col_row_span'] == 2) {
                $col_day_wise_id = $data[$exchange_id]['col_day_wise_id'] + 1;
                update_rowspan($data, $class_table_name, $exchange_id, $col_day_wise_id, $conn);

                if ($data[$exchange_id]['col_day_wise_id'] == 1) {
                //update_subject_detail($data,$class_table_name,$exchange_id,$conn,$exchange_id_2);
                }
            }

            if ($data[$exchange_id]['col_row_span'] == 3) {
                $col_day_wise_id = $data[$exchange_id]['col_day_wise_id'] - 1;
                update_rowspan($data, $class_table_name, $exchange_id, $col_day_wise_id, $conn);

                if ($data[$exchange_id]['col_day_wise_id'] == 2) {
                //////update_subject_detail($data,$class_table_name,$exchange_id,$conn,$exchange_id_2);
                }
            }
        }
    }


    update_id_1($data1, $data2, $class_table_name, $conn);
    update_id_2($data1, $data2, $class_table_name, $conn);
}

if (isset($_POST['back'])) 
{
    header("Location:index.php");
}
?>