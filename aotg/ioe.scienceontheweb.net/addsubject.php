<?php
	include('connection.php');
	include('session.php');
	
	if(isset($_POST['subject1']))
	{
		$classname  = $_SESSION['classnames'];
		$classdiv  = $_SESSION['classdivs'];
		$newtimetable=$_SESSION['newtimetable'];
		
		$database=$login_session."_".$classname.$classdiv."subject";
		$database1=$login_session."_".$classname.$classdiv."details";
		
		$query1="SELECT srno FROM $database";
		$result1 = $conn->query($query1);

		function subject($database, $result1, $conn)
		{
			$_SESSION['post-data'] = $_POST;

			if($result1 == "")
			{
				$sql2 = "CREATE TABLE `$database` (
						`srno` INT NOT NULL AUTO_INCREMENT , 
						`id` INT NOT NULL , 
						`name` TEXT NOT NULL , 
						`teacher` TEXT NOT NULL ,
						`type` TEXT NOT NULL ,
						`piroity` INT NOT NULL , 
						PRIMARY KEY (`srno`),
						UNIQUE(`srno`)
						) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
				$result2 = $conn->query($sql2);	
			}else
			{
				$sql3 = "TRUNCATE TABLE $database";
				$result3 = $conn->query($sql3);
			}

			$n =$_SESSION['post-data']['loopvalue'];	
			
			$piority = array();	
			$subject = array();	
			$subjecttype = array();	
			$subjectteacher = array();	
			$id = array();

			$sql4 = "INSERT INTO $database1 (loopvalue) VALUES ('$n')";
			$result4 = $conn->query($sql4);

			for($i=1;$i<=$n;)
			{
				$count1="subjecttype".$i;
				$y = $_SESSION['post-data'][$count1];
				$subjecttype[$i]=$y;
				$i++;
			}
	
			for($i=1;$i<=$n;)
			{
				$count2="subjectteacher".$i;
				$y = $_SESSION['post-data'][$count2];
				$subjectteacher[$i]=$y;
				$i++;
			}	

			for($i=1;$i<=$n;)
			{
				$count3="id".$i;
				$y = $_SESSION['post-data'][$count3];
				$id[$i]=$y;
				$i++;
			}	

			for($i=1;$i<=$n;)
			{
				$count4="subject".$i;
				$y = $_SESSION['post-data'][$count4];
				$subject[$i]=$y;
				$i++;
			}

			for($i=1;$i<=$n;)
			{
				$count5="piority".$i;
				$y = $_SESSION['post-data'][$count5];
				$piority[$i]=$y;
				$i++;
			}

			for($i=1;$i<=$n;)
			{
				$n1=$piority[$i];
				
				for($j=1;$j<=$n1;)
				{	
					$sql5 = "INSERT INTO $database (id,name,piroity,teacher,type) VALUES ('$id[$i]','$subject[$i]','$piority[$i]','$subjectteacher[$i]','$subjecttype[$i]')";
					$result5 = $conn->query($sql5);
					$j++;
				}
				$i++;	
			}
		}

		if(isset($_POST['newtimetable']))
		{
			$_SESSION['newtimetable'] = "newtimetable";
	 
			if($result1 == "")
			{
				subject($database, $result1, $conn);
				header('Location:timetablegenerater.php');
			}else
			{
				header('Location:adminhome.php');
				
				$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
				$txt1 = '<?php $error="error occur because class '.$classname.$classdiv.' subjects data is presert so update subject by clicking on  update subject button in subject section"; echo $error;?>';
				fwrite($myfile1, $txt1);
				fclose($myfile1);
			}
		}else if(isset($_POST['updatesubject']))
		{
			if($result1 != "")
			{
				subject($database, $result1, $conn);
				header('Location:adminhome.php');
				
				$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
				$txt1 = '<?php $error="subject updated of class '.$classname.$classdiv.'"; echo $error;?>';
				fwrite($myfile1, $txt1);
				fclose($myfile1);
			}else
			{
				header('Location:adminhome.php');
				
				$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
				$txt1 = '<?php $error="subjects are not there so add subject of class'.$classname.$classdiv.' by clicking in add subject in subject section "; echo $error;?>';
				fwrite($myfile1, $txt1);
				fclose($myfile1);
			}
		}else if(isset($_POST['addsubject']))
		{
			if($result1 == "")
			{
				subject($database, $result1, $conn);
				header('Location:adminhome.php');

				$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
				$txt1 = '<?php $error="subject added to class'.$classname.$classdiv.'"; echo $error;?>';
				fwrite($myfile1, $txt1);
				fclose($myfile1);
			}else
			{
				header('Location:adminhome.php');
				
				$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
				$txt1 = '<?php $error="class '.$classname.$classdiv.' already thier so use update subject button in subject section"; echo $error;?>';
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
?>