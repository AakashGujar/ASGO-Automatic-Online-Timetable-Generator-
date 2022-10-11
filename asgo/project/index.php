<?php
$k=1;
if($k=0){
$Write = "<?php $" . "getLEDStatusFromNodeMCU=''; " . "echo $" . "getLEDStatusFromNodeMCU;" . " ?>";
file_put_contents('LEDStatContainer.php', $Write);
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <script src="jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#getLEDStatus").load("LEDStatContainer.php");
            setInterval(function() {
                $("#getLEDStatus").load("LEDStatContainer.php");
            }, 500);
        });
    </script>
    <style>
        html {
            font-family: Arial;
            display: inline-block;
            margin: 0px auto;
            text-align: center;
        }

        h1 {
            font-size: 2.0rem;
            color: #2980b9;
        }

        h2 {
            font-size: 1.25rem;
            color: #2980b9;
        }

        .buttonON {
            display: inline-block;
            padding: 15px 25px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px #999;
        }

        .buttonON:hover {
            background-color: #3e8e41
        }

        .buttonON:active {
            background-color: #3e8e41;
            box-shadow: 0 1px #666;
            transform: translateY(4px);
        }

        .buttonOFF {
            display: inline-block;
            padding: 15px 25px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #e74c3c;
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px #999;
        }

        .buttonOFF:hover {
            background-color: #c0392b
        }

        .buttonOFF:active {
            background-color: #c0392b;
            box-shadow: 0 1px #666;
            transform: translateY(4px);
        }
    </style>
</head>

<body>
    <h1>Display data on NodeMCU ESP12E ESP8266 with MySQL Database</h1>

    <!--<form action="updateDBLED.php" method="post" id="LED_ON" onsubmit="myFunction()">
        <input type="hidden" name="Stat" value="1" />
    </form>

    <form action="updateDBLED.php" method="post" id="LED_OFF">
        <input type="hidden" name="Stat" value="0" />
    </form>

    <button class="buttonON" name="subject" type="submit" form="LED_ON" value="SubmitLEDON">LED ON</button>
    <button class="buttonOFF" name="subject" type="submit" form="LED_OFF" value="SubmitLEDOFF">LED OFF</button>
-->
    <h2 id="ledstatus" style="color:#6f4a8e;">LED Status = </h2>
    <p id="getLEDStatus" hidden></p>
    <br>
    <br>
    <br>
    <br>
    <form action="GetData.php" method="post" id="try">
        <p>Device_id</p>
        <input type="text" name="Device_id" value="" />
        <p>current lecture id</p>
        <input type="text" name="current_lecture_id" value="" />
    </form>
    <br>
    <br>
    <br>
    <button class="buttonON" name="subject" type="submit" form="try" value="try">Go To Getdata Page</button>
    <script>
        var myVar = setInterval(myTimer, 500);

        function myTimer() {
            var getLEDStat = document.getElementById("getLEDStatus").innerHTML;
            var LEDStatus = getLEDStat;
            if (LEDStatus == 1) {
                document.getElementById("ledstatus").innerHTML = "LED Status = ON";
            }
            if (LEDStatus == 0) {
                document.getElementById("ledstatus").innerHTML = "LED Status = OFF";
            }
            if (LEDStatus == "") {
                document.getElementById("ledstatus").innerHTML = "LED Status = Waiting for the Status LED from NodeMCU...";
            }
        }
    </script>

</body>

</html>
<?php
}else{

?>
<html>
<head>
	<title>AOTG:Atomatic Time Table Generater</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta http-equiv="content-Type" content="text/html"; charset="UTF-8">
		<meta name="description" content=""> 
		<meta name="keywords" content="HTML,CSS,XML,JavaScript">
		<meta name="author" content="Het Sheth">
															<!-- responsive viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
															<!-- Icons -->	
		<link rel="shortcut icon"  href="../image/logo.ico">
		<link rel="icon" type="image/ico"  href="../image/logo.ico">
		<link rel="apple-touch-icon"  href="../image/logo.ico">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/components.css">
      <link rel="stylesheet" href="../css/icons.css">
      <link rel="stylesheet" href="../css/responsee.css">
	  <link rel="stylesheet" href="../css/template-style.css">  
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.0.min.js"></script>
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    </head>   
<body>    
      <!-- TOP NAV WITH LOGO -->
      <header>
         <nav>
            <div class="line">
               <div class="s-12 l-2">
                  <img class="s-5 l-12 center" src="../image/pagelogo.png">
               </div>
               <div class="top-nav s-12 l-10 right">
			   <p class="nav-text">menu</p>
                  <ul class="right">
					<li><a href="../index.php">Home</a></li>
					<li><a href="../pricing.php">Price</a></li>
					<li><a href="../aboutus.php">About us</a></li>
					<li><a href="../contactus.php">Contact us</a></li>
				                  </ul>
               </div>
            </div>
         </nav>
      </header>
       
   
   <br>
  <div>
  
  <center>
  <h5>Arduino ide code</h5>
  <iframe  height="100%" width="90%" src="code.ino"></iframe>
  </center>
  </div>
  <br>
    <?php
include ("../footer.php");
?>
</body>
   
</html>
<?php
}
?>