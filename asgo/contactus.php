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
<!-- Third Parallax Image with Portfolio Text -->
<div class="bgimg-3 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
     <span class="w3-xxlarge w3-text-black w3-wide"><br>CONTACT</span>
  </div>
</div>

<!-- Container (Contact Section) -->
<div class="w3-content w3-container w3-padding-64" id="contact">
  <h3 class="w3-center" id=hetsheth>Het sheth</h3>

  <p class="w3-center"><em>I'd love your feedback!</em></p>

  <div class="w3-row w3-padding-32 w3-section">
    <div class="w3-col m4 w3-container">
      <!-- Add Google Maps -->
      <div class="mapouter"><div class="gmap_canvas"><iframe class="w3-round-large w3-greyscale" width="auto" height="700px" id="gmap_canvas" src="https://maps.google.com/maps?q=Trishul%2C%20Off%20M%20G%20Road%2C%20Opposite%20Santoshi%20Mata%20Temple%2C%20Dahanukar%20Wadi%2C%20Kandivali%20West%2C%20Mumbai%2C%20Maharashtra%20400067&t=&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div>
    </div>
	 <div class="w3-col m8 w3-panel w3-hide-large w3-hide-medium">
      <div class="w3-large w3-margin-bottom">
       <p> <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i>Address: 
	   <br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Trishul, Off M G Road,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Opposite Santoshi 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Mata Temple,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Dahanukar Wadi, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Kandivali West, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> &nbspMumbai,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Maharashtra 400067<br>
        <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone:
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> 		+91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> &nbsp(contact number)<br>
        <i class="fa fa-whatsapp fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone: 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> +91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>(whats app number)<br>
        <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email: 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>chitraartprinters168@gmail.com<br>
		</p>
      </div>
  <p>Contact through <i class="fa fa-envelope"></i> mail for rates or call on <i class="fa fa-phone"></i> phone number:</p>

      <form method="post" name="myemailform" action="form-to-email.php">
        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" First Name" required name="fname">
          </div>
  <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Last Name" required name="lname">
          </div>                          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Contat Number" required name="contact">
          </div>                                                                    
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder="Email" required name="email">
          </div>
        </div>
        <input class="w3-input w3-border" type="text" placeholder="Message" required name="message">
        <button class="w3-button w3-black w3-right w3-section"  type="submit"   >
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </form>

   <script language="JavaScript">

var frmvalidator  = new Validator("myemailform");
frmvalidator.addValidation("fname","req","Please provide your first name"); 
frmvalidator.addValidation("lname","req","Please provide your last name");                                              
frmvalidator.addValidation("contact","req","Please provide your contact ");                    
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
</div>

 
    <div class="w3-col m8 w3-panel w3-hide-small ">
      <div class="w3-large w3-margin-bottom">
       <p> <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i>Address : Trishul, Off M G Road,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Opposite Santoshi 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Mata Temple,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Dahanukar Wadi, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Kandivali West, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbspMumbai,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Maharashtra 400067<br>
        <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone : +91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp(contact number)<br>
        <i class="fa fa-whatsapp fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone : +91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp(what's app number)<br>
        <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email-Id : chitraartprinters168@gmail.com<br>
		</p>
      </div>
    <p>Contact through <i class="fa fa-envelope"></i> mail for rates or call on <i class="fa fa-phone"></i> phone number:</p>
    
 <form method="post" name="myemailform" action="form-to-email.php">
        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" First Name" required name="fname">
          </div>
  <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Last Name" required name="lname">
          </div>                          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Contat Number" required name="contact">
          </div>                                                                    
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder="Email" required name="email">
          </div>
        </div>
        <input class="w3-input w3-border" type="text" placeholder="Message" required name="message">
        <button class="w3-button w3-black w3-right w3-section"  type="submit"   >
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </form>

   <script language="JavaScript">

var frmvalidator  = new Validator("myemailform");
frmvalidator.addValidation("fname","req","Please provide your first name"); 
frmvalidator.addValidation("lname","req","Please provide your last name");                                              
frmvalidator.addValidation("contact","req","Please provide your contact ");                    
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
 <br><br><br>

</div>
  </div>
  </div>
<div class="w3-content w3-container w3-padding-64" id="contact">
  <h3 class="w3-center" id=yashtailor>Yash Tailor</h3>
  <p class="w3-center"><em>I'd love your feedback!</em></p>

  <div class="w3-row w3-padding-32 w3-section">
    <div class="w3-col m4 w3-container">
      <!-- Add Google Maps -->
      <div class="mapouter"><div class="gmap_canvas"><iframe class="w3-round-large w3-greyscale" width="auto" height="700px" id="gmap_canvas" src="https://maps.google.com/maps?q=Trishul%2C%20Off%20M%20G%20Road%2C%20Opposite%20Santoshi%20Mata%20Temple%2C%20Dahanukar%20Wadi%2C%20Kandivali%20West%2C%20Mumbai%2C%20Maharashtra%20400067&t=&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div>
    </div>
	 <div class="w3-col m8 w3-panel w3-hide-large w3-hide-medium">
      <div class="w3-large w3-margin-bottom">
       <p> <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i>Address: 
	   <br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Trishul, Off M G Road,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Opposite Santoshi 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Mata Temple,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Dahanukar Wadi, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Kandivali West, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> &nbspMumbai,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Maharashtra 400067<br>
        <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone:
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> 		+91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> &nbsp(contact number)<br>
        <i class="fa fa-whatsapp fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone: 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> +91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>(whats app number)<br>
        <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email: 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>chitraartprinters168@gmail.com<br>
		</p>
      </div>
  <p>Contact through <i class="fa fa-envelope"></i> mail for rates or call on <i class="fa fa-phone"></i> phone number:</p>

      <form method="post" name="myemailform" action="form-to-email.php">
        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" First Name" required name="fname">
          </div>
  <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Last Name" required name="lname">
          </div>                          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Contat Number" required name="contact">
          </div>                                                                    
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder="Email" required name="email">
          </div>
        </div>
        <input class="w3-input w3-border" type="text" placeholder="Message" required name="message">
        <button class="w3-button w3-black w3-right w3-section"  type="submit"   >
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </form>

   <script language="JavaScript">

var frmvalidator  = new Validator("myemailform");
frmvalidator.addValidation("fname","req","Please provide your first name"); 
frmvalidator.addValidation("lname","req","Please provide your last name");                                              
frmvalidator.addValidation("contact","req","Please provide your contact ");                    
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
</div>

 
    <div class="w3-col m8 w3-panel w3-hide-small ">
      <div class="w3-large w3-margin-bottom">
       <p> <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i>Address : Trishul, Off M G Road,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Opposite Santoshi 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Mata Temple,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Dahanukar Wadi, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Kandivali West, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbspMumbai,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Maharashtra 400067<br>
        <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone : +91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp(contact number)<br>
        <i class="fa fa-whatsapp fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone : +91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp(what's app number)<br>
        <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email-Id : chitraartprinters168@gmail.com<br>
		</p>
      </div>
    <p>Contact through <i class="fa fa-envelope"></i> mail for rates or call on <i class="fa fa-phone"></i> phone number:</p>
    
 <form method="post" name="myemailform" action="form-to-email.php">
        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" First Name" required name="fname">
          </div>
  <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Last Name" required name="lname">
          </div>                          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Contat Number" required name="contact">
          </div>                                                                    
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder="Email" required name="email">
          </div>
        </div>
        <input class="w3-input w3-border" type="text" placeholder="Message" required name="message">
        <button class="w3-button w3-black w3-right w3-section"  type="submit"   >
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </form>

   <script language="JavaScript">

var frmvalidator  = new Validator("myemailform");
frmvalidator.addValidation("fname","req","Please provide your first name"); 
frmvalidator.addValidation("lname","req","Please provide your last name");                                              
frmvalidator.addValidation("contact","req","Please provide your contact ");                    
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
 <br><br><br>
</div>
</div>
</div>
  </div><div class="w3-content w3-container w3-padding-64" id="contact">
  <h3 class="w3-center" id=swapnilsomawanshi>Swapnil Somawanshi</h3>
  <p class="w3-center"><em>I'd love your feedback!</em></p>

  <div class="w3-row w3-padding-32 w3-section">
    <div class="w3-col m4 w3-container">
      <!-- Add Google Maps -->
      <div class="mapouter"><div class="gmap_canvas"><iframe class="w3-round-large w3-greyscale" width="auto" height="700px" id="gmap_canvas" src="https://maps.google.com/maps?q=Trishul%2C%20Off%20M%20G%20Road%2C%20Opposite%20Santoshi%20Mata%20Temple%2C%20Dahanukar%20Wadi%2C%20Kandivali%20West%2C%20Mumbai%2C%20Maharashtra%20400067&t=&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div>
    </div>
	 <div class="w3-col m8 w3-panel w3-hide-large w3-hide-medium">
      <div class="w3-large w3-margin-bottom">
       <p> <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i>Address: 
	   <br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Trishul, Off M G Road,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Opposite Santoshi 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Mata Temple,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Dahanukar Wadi, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Kandivali West, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> &nbspMumbai,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> Maharashtra 400067<br>
        <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone:
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> 		+91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> &nbsp(contact number)<br>
        <i class="fa fa-whatsapp fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone: 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i> +91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>(whats app number)<br>
        <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email: 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>chitraartprinters168@gmail.com<br>
		</p>
      </div>
  <p>Contact through <i class="fa fa-envelope"></i> mail for rates or call on <i class="fa fa-phone"></i> phone number:</p>

      <form method="post" name="myemailform" action="form-to-email.php">
        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" First Name" required name="fname">
          </div>
  <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Last Name" required name="lname">
          </div>                          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Contat Number" required name="contact">
          </div>                                                                    
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder="Email" required name="email">
          </div>
        </div>
        <input class="w3-input w3-border" type="text" placeholder="Message" required name="message">
        <button class="w3-button w3-black w3-right w3-section"  type="submit"   >
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </form>

   <script language="JavaScript">

var frmvalidator  = new Validator("myemailform");
frmvalidator.addValidation("fname","req","Please provide your first name"); 
frmvalidator.addValidation("lname","req","Please provide your last name");                                              
frmvalidator.addValidation("contact","req","Please provide your contact ");                    
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
</div>

 
    <div class="w3-col m8 w3-panel w3-hide-small ">
      <div class="w3-large w3-margin-bottom">
       <p> <i class="fa fa-map-marker fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i>Address : Trishul, Off M G Road,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Opposite Santoshi 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Mata Temple,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Dahanukar Wadi, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Kandivali West, 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbspMumbai,
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp Maharashtra 400067<br>
        <i class="fa fa-phone fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone : +91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp(contact number)<br>
        <i class="fa fa-whatsapp fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Phone : +91 9819168961 
		<br><i class="fa fa-fw  w3-xlarge w3-margin-right"></i>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp(what's app number)<br>
        <i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i> Email-Id : chitraartprinters168@gmail.com<br>
		</p>
      </div>
    <p>Contact through <i class="fa fa-envelope"></i> mail for rates or call on <i class="fa fa-phone"></i> phone number:</p>
    
 <form method="post" name="myemailform" action="form-to-email.php">
        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" First Name" required name="fname">
          </div>
  <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Last Name" required name="lname">
          </div>                          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder=" Contat Number" required name="contact">
          </div>                                                                    
          <div class="w3-half">
            <input class="w3-input w3-border" type="text" placeholder="Email" required name="email">
          </div>
        </div>
        <input class="w3-input w3-border" type="text" placeholder="Message" required name="message">
        <button class="w3-button w3-black w3-right w3-section"  type="submit"   >
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </form>

   <script language="JavaScript">

var frmvalidator  = new Validator("myemailform");
frmvalidator.addValidation("fname","req","Please provide your first name"); 
frmvalidator.addValidation("lname","req","Please provide your last name");                                              
frmvalidator.addValidation("contact","req","Please provide your contact ");                    
frmvalidator.addValidation("email","req","Please provide your email"); 
frmvalidator.addValidation("email","email","Please enter a valid email address"); 
</script>
 <br><br><br>

</div>
  </div>
  </div> 


  </section>
            </div>
         </div>
      </div>
	  <?php
include ("footer.php");
?>