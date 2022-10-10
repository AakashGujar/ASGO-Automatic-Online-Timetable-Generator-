<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//connection to database
include('user_connection.php');

?>

<!DOCTYPE html PUBLIC>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="javascript/jQuery 3.5.1.js"></script>
    <title>Information</title>
</head>

<body>

    <?php
if (isset($_POST['lecture_detail'])) {
    echo '
    <body onload="display_lecture_information();">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <th scope="row" colspan="2">Lecture Detail</th>
            </tr>
            <tr>
                <th scope="row">Name</th>
                <td>
                    <input type="text" name="post_lecture_full_name" id="post_lecture_full_name" placeholder="Name">
                </td>
            </tr>
        
            <tr>
                <th scope="row">Short Name</th>
                <td>
                    <input type="text" name="post_lecture_short_name" id="post_lecture_short_name" placeholder="Short Name" maxlength="5">
                </td>
            </tr>
        
            <tr>
                <th scope="row">Type</th>
                <td>
                    <select name="post_lecture_type" id="post_lecture_type">
						<option value="ns" >Not Selected</option>
                        <option value="0">Theory(TH)</option>
                        <option value="1">Pratical(PR)</option>
                        <option value="2">Extracurricular Activities(EA)</option>
                    </select>
                </td>
            </tr>
        
            <tr>
                <th scope="row">Where Lecture will held ?</th>
                <td>
                    <select name="post_lecture_place" id="post_lecture_place">
						<option value="ns" >Not Selected</option>
						<option value="0">Classroom</option>
						<option value="1">Lab</option>
						<option value="2">Auditorium</option>
						<option value="3">Ground</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><button type="submit" name="insert_lecture_information" id="insert_lecture_information" onclick="insert_lecture_information()">Insert</button></td>
                <td><a href="index.php"><button type="clear" name="back" id="back">Back</button></a></td>
            </tr>
        </table>
		<table width="100%" border="1" cellspacing="1" cellpadding="5">
            <thead>
                <tr>
                    <th colspan="6">Lecture Information</th>
                </tr>
			    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Short Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Place Name</th>
                    <th scope="col">Update</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>    
            <tbody id="display_lecture_information">
            
			</tbody>
		</table>
    </body>    
    ';
}
else if (isset($_POST['lecture_place_detail'])) {
    echo '
    <body onload="display_lecture_place_detail();">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <th scope="row" colspan="2">Lecture Place Detail</th>
            </tr>
            <tr>
                <th scope="row">Place Name</th>
                <td>
                    <input type="text" name="post_lecture_place_name" id="post_lecture_place_name" placeholder="Name">(Special Charcter like - , . @ and many more are not allowed)
                </td>
            </tr>
            <tr>
                <th scope="row">Place Type</th>
                <td>
                    <select name="post_lecture_place" id="post_lecture_place">
						<option value="ns" >Not Selected</option>
                        <option value="1">Lab</option>
                        <option value="2">Auditorium</option>
                        <option value="3">Ground</option>
                    </select>
                </td>
            </tr>
			<tr>
                <td><button type="submit" name="insert_lecture_place_detail" id="insert_lecture_place_detail" onclick="insert_lecture_place_detail()">Insert</button></td>
                <td><a href="index.php"><button type="clear" name="back" id="back">Back</button></a></td>
            </tr>
        </table>
		<table width="100%" border="1" cellspacing="1" cellpadding="5">
            <thead>
                <tr>
                    <th colspan="4">Lecture Place Detail</th>
                </tr>
			    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Update</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>    
            <tbody id="display_lecture_place_detail">
            
			</tbody>
		</table>
    </body>
    ';
}
else if (isset($_POST['teacher_detail'])) {
    echo '
    <body onload="display_teacher_detail();">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
                <th scope="row" colspan="4">Teacher Detail</th>
            </tr>
            <tr>
                <th scope="row">Name</th>
                <td>
                    <input type="text" name="post_teacher_first_name" id="post_teacher_first_name" placeholder="First Name">
                </td>
                <td>
                    <input type="text" name="post_teacher_middle_name" id="post_teacher_middle_name" placeholder="Middle Name">
                </td>
                <td>
                    <input type="text" name="post_teacher_last_name" id="post_teacher_last_name" placeholder="Last Name">
                </td>
            </tr>
            <tr>
                <th scope="row">Short Name</th>
                <td>
                    <input type="text" name="post_teacher_short_name" id="post_teacher_short_name" placeholder="Short Name" maxlength="5">
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th scope="row">Password</th>
                <td>
                    <input type="text" name="post_default_password" id="post_default_password" placeholder="Auto Generated" disabled>
                </td>
                <td></td>
                <td></td>
            </tr>
			<tr>
                <td><button type="submit" name="insert_teacher_detail" id="insert_teacher_detail" onclick="insert_teacher_detail()">Insert</button></td>
				<td></td>
				<td></td>
                <td><a href="index.php"><button type="clear" name="back" id="back">Back</button></a></td>
            </tr>
        </table>
		<table width="100%" border="1" cellspacing="1" cellpadding="5">
            <thead>
                <tr>
                    <th colspan="8">Teacher Detail</th>
                </tr>
			    <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Middle Name</th>
                    <th scope="col">last Name</th>
                    <th scope="col">Short Name</th>
                    <th scope="col">Id</th>
                    <th scope="col">Password</th>
                    <th scope="col">Update</th>
                    <th scope="col">Remove</th>
                </tr>
            </thead>    
            <tbody id="display_teacher_detail">
            
			</tbody>
		</table>
    </body>';
}
else if (isset($_POST['student_detail'])) {
    echo '
    <script>
        id="display_student_detail";
    </script>
    <body onload="display_function(id);">
    </body> 
    ';
}


?>
    <!-- Modal for full size images on click-->
    <div id="modal01" class="modal"
        style="display:none;width:100%;height:100%;background-color:rgba(0,0,0,0.1);position: absolute;left: 0%;top: 0%;z-index: 9999;">
        <center style="color:black;padding-top: 15%;">
            <div id="loader" class="loader"></div>
            <h4 id="text_for_loading">
                <h4>
                    <span id="close" class="close">OK</span>
                </h4>
            </h4>
        </center>
    </div>
    <script>
    // Get the modal
    var modal = document.getElementById("modal01");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
        span.style.display = "none";
    }
    /* display function of lecture information */
    function display_lecture_information() {
        var post_display_lecture_information = " ";
        $.post('insert_information_back.php', {
                display_lecture_information: post_display_lecture_information
            },
            function(data) {
                $('#display_lecture_information').html(data);
            }

        );
    }

    /* insert function of lecture information */
    function insert_lecture_information() {
        $('#text_for_loading').text("inserting...");
        document.getElementById("modal01").style.display = "block";
        document.getElementById("loader").style.display = "block";

        var post_insert_lecture_information = " ";

        $.post('insert_information_back.php',

            {
                insert_lecture_information: post_insert_lecture_information,
                post_lecture_full_name: $('#post_lecture_full_name').val(),
                post_lecture_short_name: $('#post_lecture_short_name').val(),
                post_lecture_type: $('#post_lecture_type').val(),
                post_lecture_place: $('#post_lecture_place').val()
            },

            function(data) {
                display_lecture_information();
                document.getElementById("loader").style.display = "none";
                modal.style.display = "none";
                //document.getElementById("close").style.display = "block";
                // $('#text_for_loading').text("insert sucefully");
            }
        );
    }

    /* update function of lecture information */
    function update_lecture_information(post_srno) {
        $('#text_for_loading').text("updating...");
        document.getElementById("modal01").style.display = "block";
        document.getElementById("loader").style.display = "block";

        var post_update_lecture_information = " ";
        $.post('insert_information_back.php',

            {
                update_lecture_information: post_update_lecture_information,
                post_lecture_full_name: $('#post_lecture_full_name' + post_srno).val(),
                post_lecture_short_name: $('#post_lecture_short_name' + post_srno).val(),
                post_lecture_type: $('#post_lecture_type' + post_srno).val(),
                post_lecture_place: $('#post_lecture_place' + post_srno).val(),
                post_srno: post_srno
            },

            function(data) {
                display_lecture_information();
                document.getElementById("loader").style.display = "none";
                modal.style.display = "none";
                //document.getElementById("close").style.display = "block";
                // $('#text_for_loading').text("update sucefully");
            }
        );
    }

    /* remove function of lecture information */
    function remove_lecture_information(post_srno) {

    }

    /* display function of lecture place detail */
    function display_lecture_place_detail() {
        var post_display_lecture_place_detail = " ";
        $.post('insert_information_back.php',

            {
                display_lecture_place_detail: post_display_lecture_place_detail
            },

            function(data) {
                $('#display_lecture_place_detail').html(data);
            }

        );
    }

    /* insert function of lecture place detail */
    function insert_lecture_place_detail() {
        $('#text_for_loading').text("inserting...");
        document.getElementById("modal01").style.display = "block";
        document.getElementById("loader").style.display = "block";

        var post_insert_lecture_place_detail = " ";

        $.post('insert_information_back.php',

            {
                insert_lecture_place_detail: post_insert_lecture_place_detail,
                post_lecture_place_name: $('#post_lecture_place_name').val(),
                post_lecture_place: $('#post_lecture_place').val()
            },

            function(data) {
                display_lecture_place_detail();
                document.getElementById("loader").style.display = "none";
                modal.style.display = "none";
                //document.getElementById("close").style.display = "block";
                //$('#text_for_loading').text("insert sucefully");
            }
        );
    }

    /* update function of lecture place detail */
    function update_lecture_place_detail(post_srno) {
        $('#text_for_loading').text("updating...");
        document.getElementById("modal01").style.display = "block";
        document.getElementById("loader").style.display = "block";

        var post_update_lecture_place_detail = " ";
        $.post('insert_information_back.php',

            {
                update_lecture_place_detail: post_update_lecture_place_detail,
                post_lecture_place_name: $('#post_lecture_place_name' + post_srno).val(),
                post_lecture_place: $('#post_lecture_place' + post_srno).val(),
                post_srno: post_srno
            },

            function(data) {
                display_lecture_place_detail();
                document.getElementById("loader").style.display = "none";
                modal.style.display = "none";
                //document.getElementById("close").style.display = "block";
                //$('#text_for_loading').text("update sucefully");
            }
        );
    }

    /* remove function of lecture place detail */
    function remove_lecture_information(post_srno) {

    }

    /* display function of teacher detail */
    function display_teacher_detail() {
        var post_display_teacher_detail = " ";
        $.post('insert_information_back.php',

            {
                display_teacher_detail: post_display_teacher_detail
            },

            function(data) {
                $('#display_teacher_detail').html(data);
            }

        );
    }

    /* insert function of teacher detail */
    function insert_teacher_detail() {
        $('#text_for_loading').text("inserting...");
        document.getElementById("modal01").style.display = "block";
        document.getElementById("loader").style.display = "block";

        var post_insert_teacher_detail = " ";

        $.post('insert_information_back.php',

            {
                insert_teacher_detail: post_insert_teacher_detail,
                post_teacher_first_name: $('#post_teacher_first_name').val(),
                post_teacher_middle_name: $('#post_teacher_middle_name').val(),
                post_teacher_last_name: $('#post_teacher_last_name').val(),
                post_teacher_short_name: $('#post_teacher_short_name').val()
            },

            function(data) {
                display_teacher_detail();
                document.getElementById("loader").style.display = "none";
                modal.style.display = "none";
                //document.getElementById("close").style.display = "block";
                //$('#text_for_loading').text("insert sucefully");
            }
        );
    }

    /* update function of teacher detail */
    function update_teacher_detail(post_srno) {
        $('#text_for_loading').text("updating...");
        document.getElementById("modal01").style.display = "block";
        document.getElementById("loader").style.display = "block";

        var post_update_teacher_detail = " ";
        $.post('insert_information_back.php',

            {
                update_teacher_detail: post_update_teacher_detail,
                post_teacher_first_name: $('#post_teacher_first_name' + post_srno).val(),
                post_teacher_middle_name: $('#post_teacher_middle_name' + post_srno).val(),
                post_teacher_last_name: $('#post_teacher_last_name' + post_srno).val(),
                post_teacher_short_name: $('#post_teacher_short_name' + post_srno).val(),
                post_srno: post_srno
            },

            function(data) {
                display_teacher_detail();
                document.getElementById("loader").style.display = "none";
                modal.style.display = "none";
                //document.getElementById("close").style.display = "block";
                //$('#text_for_loading').text("update sucefully");
            }
        );
    }

    /* remove function of teacher detail */
    function remove_teacher_detail(post_srno) {

    }
    </script>
</body>

</html>