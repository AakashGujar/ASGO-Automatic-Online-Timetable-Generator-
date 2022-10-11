
<?php

date_default_timezone_set("Asia/Kolkata");
include('../connection.php');


if (isset($_POST["Device_id"])) {
	$Device_id = $_POST["Device_id"];

	/* Extractin  freesolt information from free_solt_detail table in database */
	$sql_query = "SELECT  *  FROM  startup_details WHERE Device_id='" . $Device_id . "'";
	$result = $conn->query($sql_query);/* execution of query */
	/* extractinng from free_solt_detail table in database */
	$data = $result->fetch_array();

	if (time() >= strtotime($data['time'])) {
		$data['lecture_id'] = $data['lecture_id'] - 1;
	}

	if ($data['lecture_id'] >= 0 && $data['lecture_id'] <= 9) {
		$data['lecture_id'] = "0" . $data['lecture_id'];
	}

	echo $data['class_name'] . "," . $data['lecture_id'];
}



//fetching class time
if (isset($_POST['class_name'])) {
	//print_r($_POST);
	$class_name = trim(str_replace(' ', '', $_POST["class_name"]));
	$weekDay = trim(str_replace(' ', '', $_POST["weekDay"]));
	$current_lecture_id = trim(str_replace(' ', '', $_POST["current_lecture_id"]));

	/* Extractin  freesolt information from free_solt_detail table in database */
	$sql_query = "SELECT  *  FROM  startup_details WHERE class_name='" . $class_name . "'";
	$result = $conn->query($sql_query);/* execution of query */
	/* extractinng from free_solt_detail table in database */
	$data = $result->fetch_array();

	/* Extractin  freesolt information from free_solt_detail table in database */
	$sql_query0 = "SELECT  *  FROM  " . $class_name . "_time_detail";
	$result0 = $conn->query($sql_query0);/* execution of query */
	/* extractinng from free_solt_detail table in database */
	$data0 = $result0->fetch_array();
	if ($weekDay == 6) {
		$weekDay = 0;
	}
	if ($data['lecture_id'] > $data0['col_daily_lecture_count'] || $data['weekday'] != $weekDay || $data['lecture_id'] == 0) {
		$current_lecture_id = 1;
	}


	if (is_numeric($current_lecture_id) == TRUE && $current_lecture_id > 0) {
		/* Extractin  freesolt information from free_solt_detail table in database */
		$sql_query1 = "SELECT  *  FROM  " . $class_name . "_timetable WHERE col_day='" . $weekDay . "' and col_day_wise_id='" . $current_lecture_id . "'";
		$result1 = $conn->query($sql_query1);/* execution of query */
		/* extractinng from free_solt_detail table in database */
		$data1 = $result1->fetch_array();

		$lecture_type_array = array('TH', 'PR', 'EA');

		if ($current_lecture_id < $data0['col_daily_lecture_count']) {
			$next_lecture_id = $current_lecture_id + 1;

			/* Extractin  freesolt information from free_solt_detail table in database */
			$sql_query2 = "SELECT  *  FROM  " . $class_name . "_timetable WHERE col_day='" . $weekDay . "' and col_day_wise_id='" . $next_lecture_id . "'";
			$result2 = $conn->query($sql_query2);/* execution of query */
			/* extractinng from free_solt_detail table in database */
			$data2 = $result2->fetch_array();

			$next_lecture = " and Next Lecture = " . $data2['col_lecture_name'] . "(" . $lecture_type_array[$data2['col_lecture_type']] . ")";
		} else {
			$next_lecture_id = "1";
		}

		if ($data1['col_lecture_name'] != " " && $data1['col_lecture_name'] != " " && $data1['col_lecture_name'] != " ") {
			$date = date("d-m-y");
			$currentHour = date("H");
			$currentMinute = date("i");

			if (($currentHour >= 0 && $currentHour <= 9) && ($currentMinute >= 0 && $currentMinute <= 9)) {
				$currentTime =  "0" . $currentHour . ".0" . $currentMinute;
			} else if ($currentHour >= 0 && $currentHour <= 9) {
				$currentTime =  "0" . $currentHour . "." . $currentMinute;
			} else if ($currentMinute >= 0 && $currentMinute <= 9) {
				$currentTime =  $currentHour . ".0" . $currentMinute;
			} else {
				$currentTime = $currentHour . "." . $currentMinute;
			}

			/* Extractin  freesolt information from free_solt_detail table in database */
			$query3 = "UPDATE startup_details SET lecture_id='" . $next_lecture_id . "',weekday='" . $weekDay . "',date='" . $date . "',time='" . $currentTime . "' WHERE class_name='" . $class_name . "'";
			$result3 = $conn->query($query3);/* execution of query */

			echo "Current Lecture = " . $data1['col_lecture_name'] . "(" . $lecture_type_array[$data1['col_lecture_type']] . ")" . $next_lecture . "," . $data1['col_timming'];
			//echo "Current Lecture = ".$data1['col_lecture_name']."(".$lecture_type_array[$data1['col_lecture_type']].") and Next Lecture = ".$data2['col_lecture_name']."(".$lecture_type_array[$data2['col_lecture_type']]."),07.15 - 01.52";

		} else {
			echo "Please Contact Your Class Teacher";
		}
	} else {
		echo "Please Contact Your Class Teacher";
	}
}


?>