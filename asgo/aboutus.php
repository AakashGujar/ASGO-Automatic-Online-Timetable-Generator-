	<?php
session_start();
	if($_SESSION['location']=="")
	{
		include ("header.php");
	}else{
		include('session.php');
		if($location == "adminhome.php"){
	include ("userheader.php");
	}
	if($location == "teacherhome.php"){
	include ("userheader.php");
	}
	if($location == "studenthome.php"){
	include ("userheader.php");
	}
	}
?>
<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section>
<form method=post action=contactus.php>
<div class="card columns">
  <img src="image/img.jpg" alt="John" style="width:100%">
  <h1>Het Sheth</h1>
  <p class="title">Founder</p>
  <p>College : BHAUSAHEB VARTAK POLYTECHNIC</p>
  <p>Langauge Specalist in: php,javascript,sql,html,css</p>
  
  <p><button name=hetsheth >Contact</button></p>
</div>
<div class="card columns">
  <img src="image/img.jpg" alt="John" style="width:100%">
  <h1>Yash Tailor</h1>
  <p class="title">Co-Founder</p>
  <p>College : BHAUSAHEB VARTAK POLYTECHNIC</p>
  <p>Langauge Specalist in: sql,html,css</p>
  
  <p><button name=yashttailor>Contact</button></p>
</div>
<div class="card columns">
  <img src="image/img.jpg" alt="John" style="width:100%">
  <h1>Swapnil Somawanshi</h1>
  <p class="title">Co-Founder</p>
  <p>College : BHAUSAHEB VARTAK POLYTECHNIC</p>
  <p> Langauge Specalist in: sql,html</p>
  <p><button name=swapnilsomawanshi>Contact</button></a></p>
</div>
</form>
</section>
</div>
</div>
</div>
<?php
include ("footer.php");
?>