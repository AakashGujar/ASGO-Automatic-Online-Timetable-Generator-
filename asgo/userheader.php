<?php ob_start();

?>
<!DOCTYPE html>
<style>
.usernamecss{
  color:#fff; 
  display:block;
  font-size:1rem;
  padding:1.25rem; 
  cursor: context-menu;
} 
.usernamecss:hover {
	background:#152732;
	cursor: context-menu;
	} 
</style>
<html>
	<title>AOTG:Atomatic Time Table Generater</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta http-equiv="content-Type" content="text/html"; charset="UTF-8">
		<meta name="description" content=""> 
		<meta name="keywords" content="HTML,CSS,XML,JavaScript">
		<meta name="author" content="Het Sheth">
															<!-- responsive viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
															<!-- Icons -->	
		<link rel="shortcut icon"  href="image/logo.ico">
		<link rel="icon" type="image/ico"  href="image/logo.ico">
		<link rel="apple-touch-icon"  href="image/logo.ico">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/icons.css">
      <link rel="stylesheet" href="css/responsee.css">
	  <link rel="stylesheet" href="css/template-style.css"> 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">	  
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.0.min.js"></script>
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- TOP NAV WITH LOGO -->
      <header id=myhidediv1>
         <nav>
            <div class="line">
               <div class="s-12 l-2">
                  <img class="s-5 l-12 center" src="image/pagelogo.png">
               </div>
			   <div class="top-nav s-12 l-10 right">
			   
			   <p class="nav-text">menu</p>
                  <ul class="right">
				   <li class="usernamecss">
				   Welcome &nbsp <i class='fas fa-user-tie'></i> &nbsp<?php echo $login_user; ?>
				   </li>
					<?php
					
    

					if($home == "student")
	 {
		$link='<li><a  href="studenthome.php">Home</a></li>';
	 }else if($home == "admin")
	 {
		$link='<li><a  href="adminhome.php">Home</a></li>
		<li><a href="pricing.php">Price</a></li>';
	 }else if($home == "teacher")
	 {
		$link='<li><a  href="teacherhome.php">Home</a></li>';
	 } echo $link;?>
					<li><a href="aboutyou.php">Profile</a></li>
					<li><a href="aboutus.php">About us</a></li>
					<li><a href="contactus.php">Contact us</a></li>
					<li><a href = "logout.php">Sign out</a></li>
				</ul>
               </div>
            </div>
         </nav>
      </header>

</html>