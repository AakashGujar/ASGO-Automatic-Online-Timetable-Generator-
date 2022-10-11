<?php
	include ("connection.php");
	include('session.php');
	include('userheader.php');
	
	if($_SESSION['classnames'] == "")
	{
		$_SESSION['classnames']=$_POST['classname'];
		$_SESSION['classdivs']=$_POST['classdiv'];
	}
	
	$classname  = $_SESSION['classnames'];
	$classdiv  = $_SESSION['classdivs'];

	if(($classname == "") & ($classdiv == ""))
	{
		header('Location:adminhome.php');
		
		$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
		$txt1 = '<?php $error="please insert class name and class div proper and try it again"; echo $error;?>';
		fwrite($myfile1, $txt1);
		fclose($myfile1);
	}
	
	$database1=$login_session."_".$classname.$classdiv."details";
	$database2=$login_session."_".$classname.$classdiv."subject";
	$database3=$login_session."_".$classname.$classdiv."timetable";

	$query1="SELECT starttimehrs FROM $database1";
	$result1 = $conn->query($query1);
	
	$query2="SELECT name FROM $database2";
	$result2 = $conn->query($query2);
	
	if(($result1  != "" ) && ($result2  != ""))
	{
		$rows=array();
		
		$sql2 = "SELECT * FROM $database2 ORDER BY RAND()";
		$result2 = $conn->query($sql2);

		if ($result2->num_rows > 0) 
		{
			// output data of each row
			while($row2 = $result2->fetch_array()) 
			{
				$rows4[]=$row2['name'];
				$rows5[]=$row2['teacher'];
				$rows6[]=$row2['type'];
			}
		}

		$sql2="SELECT * FROM $database1";
		$result2 = $conn->query($sql2);

		if ($result2->num_rows > 0) 
		{
			// output data of each row
			while($row2 = $result2->fetch_array())
			{
				$totallecture 		=	 $row2['totallecture'];
			}
		}

		$query3="SELECT srno FROM $database3";
		$result3 = $conn->query($query3);

		if($result3 != "")
		{
			$sql3 = "TRUNCATE TABLE $database3";
			$result3 = $conn->query($sql3);
		}else
		{
			$sql3 = "CREATE TABLE `$database3` (
					`srno` INT NOT NULL AUTO_INCREMENT , 
					`name` TEXT NOT NULL ,
					`teacher` TEXT NOT NULL ,
					`type` TEXT NOT NULL ,  
					`code` TEXT,
					`count` TEXT, 
					`classname` TEXT, 
					PRIMARY KEY (`srno`),
					UNIQUE(`srno`)
					) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
			$result3 = $conn->query($sql3);
		}
		
		$n=$totallecture-$count;

		for($j=0;$j<$n;)
		{	
			$sql4 = "INSERT INTO $database3 (name,teacher,type) VALUES ('$rows4[$j]','$rows5[$j]','$rows6[$j]')";
			$result4 = $conn->query($sql4);
			$j++;
		}

		$sql5 = "INSERT INTO $database3 (classname) VALUES ('$classname-$classdiv ')";
		$result5= $conn->query($sql5);

		header('Location:timetablepreview.php');
	}else
	{
		if($result1  == "" ) 
		{
		   $data="time details";
		}
     
		if($result2  == "")
		{
		   $data="subject ";
		}
	   
		if(($result1  != "" ) && ($result2  != ""))
		{
			$data="time details and subject  ";
		}
	
		$newtimetable=$_SESSION['newtimetable'];
	
		if(isset($_POST['next']))
		{
			header('Location:adminhome.php');
	
			$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
			$txt1 = '<?php $error="'.$classname.$classdiv.' class '.$data.' not found . insert '.$classname.$classdiv.' class '.$data.' proper and try it again"; echo $error;?>';
			fwrite($myfile1, $txt1);
			fclose($myfile1);
		}else if($newtimetable == "")
		{
			header('Location:adminhome.php');
	
			$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
			$txt1 = '<?php $error=" '.$classname.$classdiv.'  class  '.$data.'  is not proply insert please insert  '.$classname.$classdiv.' class '.$data.' proper and try it again"; echo $error;?>';
			fwrite($myfile1, $txt1);
			fclose($myfile1);
		}else
		{
			header('Location:adminhome.php');
		
			$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
			$txt1 = '<?php $error="TRY AGAIN AND MAKE SURE YOU FILL '.$data.' OF CLASS '.$classname.$classdiv.'"; echo $error;?>';
			fwrite($myfile1, $txt1);
			fclose($myfile1);
		}
	}
?>	