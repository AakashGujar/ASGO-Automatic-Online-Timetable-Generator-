<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//session file for user information
include('session.php');

//inilized requred variable with value
$servername = "sql309.epizy.com";
$username = "epiz_26307787";
$password = "gtagame48";
$dbname = "epiz_26307787_Scheduler_User";

//creating connection to server
$con = new mysqli($servername, $username, $password);

//creating database
$sql = "CREATE DATABASE ".$dbname."";
$con->query($sql);

//creating connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

?>	
