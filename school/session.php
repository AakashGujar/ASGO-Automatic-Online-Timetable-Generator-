<?php
//session start 
@ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

//inilized session variable
$_SESSION["institute_short_name"]="my";
$_SESSION["institute_type"]="college";

//inilized variable
$institute_dbname=strtolower($_SESSION["institute_short_name"]."_".$_SESSION["institute_type"]);

?>