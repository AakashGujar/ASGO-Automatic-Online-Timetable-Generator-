<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//session file for user information
include('session.php');

//inilized requred variable with value
$servername = "localhost";
$username = "root";
$password = "";
$dbname = $institute_dbname;

//creating connection to server
$con = new mysqli($servername, $username, $password);

//creating database
$sql = "CREATE DATABASE  IF NOT EXISTS ".$dbname."";
$con->query($sql);

//creating connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

?>	
