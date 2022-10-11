<?php
 include('session.php');
if(isset($_GET['link']))
{
	$teacherfoldername=$_SESSION['teacherfoldername'];
    $var_1 = "1".$_GET['link'];
//    $file = $var_1;

$dir = "$teacherfoldername/"; // trailing slash is important
$file = $dir . $var_1;

if (file_exists($file))
    {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
	header("Location:filesearch.php");
    }
}else{
	header("Location:filesearch.php");
}
?>