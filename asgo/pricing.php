<?php
session_start();
	if($_SESSION['location']=="")
	{
		include ("header.php");
		$tag='TRY OUR BASIC PLAN NOW FOR FREE OPENING OFFER';
		$price='<li class="grey"><strike>$ 9.99 / year</strike> Free only year</li>';
		$price1='<li class="grey">$ 24.99 / year</li>';
		$price2='<li class="grey">$ 49.99 / year</li>';
		$button='<a href="admincreateform.php"  class="button"><input type=submit name=Basic value="Sign Up" style="background-color:#777777;border:none;"></a>';
		$button1='<a href="admincreateform.php"  class="button"><input type=submit name=Pro value="Sign Up" style="background-color:#777777;border:none;"></a>';
		$button2='<a href="admincreateform.php"  class="button"><input type=submit name=Premium value="Sign Up" style="background-color:#777777;border:none;"></a>';
	}else{
		include('session.php');
		if($location == "adminhome.php"){
	include ("userheader.php");
	$tag='User Special Price';
	$price='<li class="grey">$ 4.99 / year</li>';
		$price1='<li class="grey">$ 19.99 / year</li>';
		$price2='<li class="grey">$ 44.99 / year</li>';
		$button='<a><input type=submit name=userBasic value="Upgrade to Basic" style="background-color:#777777;border:none;"></a>';
		$button1='<a ><input type=submit name=userPro value="Upgrade to Pro" style="background-color:#777777;border:none;"></a>';
		$button2='<a ><input type=submit name=userPremium value="Upgrade to Premium " style="background-color:#777777;border:none;"></a>';
		}
	}
?>
<body>
<div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               
		<section>
<center><h1 class=changecolor><?php echo $tag;?></h1><center>
<form method="POST"  action="admincreateform.php">
<div class="columns">
  <ul class="price">
    <li class="header">Basic</li>
   <?php echo $price;?>
    <li>10GB Storage</li>
    <li>100 Teacher Account</li>
    <li>1000 Student Account</li>
    <li>1GB Bandwidth</li>
    <li class="grey"><?php echo $button;?></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header" style="background-color:#4CAF50">Pro</li>
    <?php echo $price1;?>
    <li>25GB Storage</li>
    <li>1000 Teacher Account</li>
    <li>5000 Student Account</li>
    <li>2GB Bandwidth</li>
    <li class="grey"><?php echo $button1;?></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header">Premium</li>
    <?php echo $price2;?>
    <li>Unlimited Storage</li>
    <li>Unlimited Teacher Account</li>
    <li>Unlimited Student Account</li>
    <li>5GB Bandwidth</li>
    <li class="grey"><?php echo $button2;?></li>
  </ul>
</div>
</form>
</section>
		
         </div>
      </div>
</body>
<?php
include ("footer.php");
?>