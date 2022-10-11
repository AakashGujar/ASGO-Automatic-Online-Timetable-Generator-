<?php
	include('connection.php');
	include('session.php');
	
	if(isset($_POST['startstimehrs']))
	{
		$starttimehrss		=	$_POST['startstimehrs'];
		$starttimemins		=	$_POST['startstimemin']; 
		$endtimehrss   		= 	$_POST['endstimehrs']; 
		$endtimemins   		= 	$_POST['endstimemin']; 
		$recessstarthrs1s 	= 	$_POST['recessstartstimehrs1']; 
		$recessstartmin1s 	= 	$_POST['recessstartsmins1']; 
		$recessendhrs1s 	= 	$_POST['recessendstimehrs1']; 
		$recessendmin1s 	= 	$_POST['recessendsmins1']; 
		$recessstarthrs2s 	= 	$_POST['recessstartstimehrs2']; 
		$recessstartmin2s 	= 	$_POST['recessstartsmins2']; 
		$recessendhrs2s 	= 	$_POST['recessendstimehrs2']; 
		$recessendmin2s 	= 	$_POST['recessendsmins2']; 
		$recessess 			= 	$_POST['one']; 
		$dailyperiods 		= 	$_POST['dailysperiod']; 
		$saturdays 			= 	$_POST['two']; 
		$halfdays 			= 	$_POST['three']; 
		$saturdayperiods 	= 	$_POST['periods']; 
		$amorpm   			= 	$_POST['amorpms'];
		$amorpm1  			= 	$_POST['amorpms1'];
		$amorpm2  			= 	$_POST['amorpms2'];
		$amorpm3  			= 	$_POST['amorpms3'];
		$amorpm4  			= 	$_POST['amorpms4'];
		$amorpm5  			=	$_POST['amorpms5'];
		
		$classname  = $_SESSION['classnames'];
		$classdiv  = $_SESSION['classdivs'];
		
		$database=$login_session."_".$classname.$classdiv."details";
		
		if(($classname == "") & ($classdiv == ""))
		{
			header('Location:adminhome.php');
	
			$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
			$txt1 = '<?php $error="please insert class name and class div proper and try it again"; echo $error;?>';
			fwrite($myfile1, $txt1);
			fclose($myfile1);
		}
		
		if($starttimehrss != "")
		{
			if(isset($_POST['updatedetails']))
			{
				$query4="SELECT srno FROM $database";
				$result4 = $conn->query($query4);
				
				if ($result4 != "") 
				{
					$query1 = "UPDATE $database SET srno=1,starttimehrs='$starttimehrss',starttimemin='$starttimemins',endtimehrs='$endtimehrss',endtimemin='$endtimemins',recessstarthrs1='$recessstarthrs1s',recessstartmin1='$recessstartmin1s',recessendhrs1='$recessendhrs1s',recessendmin1='$recessendmin1s',recessstarthrs2='$recessstarthrs2s',recessstartmin2='$recessstartmin2s',recessendhrs2='$recessendhrs2s',recessendmin2='$recessendmin2s',recesses='$recessess',dailyperiod='$dailyperiods',saturday='$saturdays',halfday='$halfdays',saturdayperiod='$saturdayperiods',amorpm='$amorpm' ,amorpm1='$amorpm1' ,amorpm2='$amorpm2' ,amorpm3='$amorpm3' ,amorpm4='$amorpm4' ,amorpm5='$amorpm5'  WHERE srno=1";
					$result1 = $conn->query($query1);

					header('Location:adminhome.php');

					$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
					$txt1 = '<?php $error="time details updated to class '.$classname.$classdiv.'"; echo $error;?>';
					fwrite($myfile1, $txt1);
					fclose($myfile1);
				}else
				{
					header('Location:adminhome.php');

					$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
					$txt1 = '<?php $error="error occur because class '.$classname.$classdiv.' time details is not presert so add time  by clicking on  add time button in time details section "; echo $error;?>';
					fwrite($myfile1, $txt1);
					fclose($myfile1);
				}
			}else
			{
				$query3="SELECT srno FROM $database";
				$result3 = $conn->query($query3);
				
				if ($result3 == "") 
				{
					$query1 = "CREATE TABLE `$database` (
								`srno` int(11) DEFAULT NULL,
								`starttimehrs` text,
								`starttimemin` text,
								`endtimehrs` text,
								`endtimemin` text,
								`recessstarthrs1` text,
								`recessstartmin1` text,
								`recessendhrs1` text,
								`recessendmin1` text,
								`recessstarthrs2` text,
								`recessstartmin2` text,
								`recessendhrs2` text,
								`recessendmin2` text,
								`recesses` text,
								`dailyperiod` text,
								`saturday` text,
								`halfday` text,
								`saturdayperiod` text,
								`amorpm` text,
								`amorpm1` text,
								`amorpm2` text,
								`amorpm3` text,
								`amorpm4` text,
								`amorpm5` text,
								`totallecture` text,
								`loopvalue` text
								) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
								$result1 = $conn->query($query1);

								$query2="INSERT INTO `$database` (`srno`, `starttimehrs`, `starttimemin`, `endtimehrs`, `endtimemin`, `recessstarthrs1`, `recessstartmin1`, `recessendhrs1`, `recessendmin1`, `recessstarthrs2`, `recessstartmin2`, `recessendhrs2`, `recessendmin2`, `recesses`, `dailyperiod`, `saturday`, `halfday`, `saturdayperiod`, `amorpm`, `amorpm1`, `amorpm2`, `amorpm3`, `amorpm4`, `amorpm5`, `totallecture`, `loopvalue` ) VALUES
								(1, '$starttimehrss', '$starttimemins', '$endtimehrss', '$endtimemins', '$recessstarthrs1s', '$recessstartmin1s', '$recessendhrs1s', '$recessendmin1s', '$recessstarthrs2s', '$recessstartmin2s', '$recessendhrs2s', '$recessendmin2s', '$recessess', '$dailyperiods', '$saturdays', '$halfdays', '$saturdayperiods', '$amorpm', '$amorpm1', '$amorpm2', '$amorpm3', '$amorpm4', '$amorpm5','1','1');";
								$result2 = $conn->query($query2);
					
					if(isset($_POST['newtimetable']))
					{
						$_SESSION['newtimetable'] = "newtimetable";
						
						header('Location:subject.php');
	
					}else if(isset($_POST['adddetails']))
					{
						header('Location:adminhome.php');

						$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
						$txt1 = '<?php $error="time details added to class '.$classname.$classdiv.'"; echo $error;?>';
						fwrite($myfile1, $txt1);
						fclose($myfile1);
					}		
				}else
				{
					header('Location:adminhome.php');
					
					$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
					$txt1 = '<?php $error="error occur because class '.$classname.$classdiv.'time detail is presert so update time by clicking on  updae time  button in time details section"; echo $error;?>';
					fwrite($myfile1, $txt1);
					fclose($myfile1);
				}
			}
		}else
		{
			header('Location:adminhome.php');
	
			$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
			$txt1 = '<?php $error="TRY AGAIN AND MAKE SURE TO FILL DATA IN FIELD"; echo $error;?>';
			fwrite($myfile1, $txt1);
			fclose($myfile1);
		}
	}else
	{
		header('Location:adminhome.php');
		
		$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
		$txt1 = '<?php $error="TRY AGAIN AND MAKE SURE TO FILL DATA IN FIELD"; echo $error;?>';
		fwrite($myfile1, $txt1);
		fclose($myfile1);
	}
?>