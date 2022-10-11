<?php
   include('session.php');
include('userheader.php');
?>
<html>
   
   <head>
      <title>Welcome</title>
   </head>
   
 <body>
   <!-- ASIDE NAV AND CONTENT -->
      <div class="line">
         <div class="box  margin-bottom">
            <div class="margin2x">
               <!-- ASIDE NAV 1 -->
               <aside class="s-12 l-3">
                 
   
   <div>
   <p>
  <div class="pos" id="error4"><?php include("error4.php");$myfile1 = fopen("error4.php", "w") or die("Unable to open file!");
   $txt1 = '<?php $error=""; echo $error;?>';
fwrite($myfile1, $txt1);
fclose($myfile1);?></div>
<p></p>

	  <button class="accordion">timetable: preview and print</button>
<div class="panel">
<form method="POST" action="previewtimetableall.php">
   <p class="accordionmenubg">
	<button name="studentpreviewtimetable" class="accordionmenu">preview timetable</button>
	  <br><br>
	  <button name="studentprinttimetable" class="accordionmenu">print timetable</button>
	  <br>
	</p>
	</form>  
</div>
<button class="accordion">File:Search and download</button>
<div class="panel">
<form method="POST" action="filesearch.php">
   <p class="accordionmenubg">
	<button name="search" class="accordionmenu">download </button>
	  <br>
	</p>
	<p class="accordionmenubg">
	<button name="search" class="accordionmenu" disabled >Search(coming soon)</button>
	  <br>
	</p>
	</form>  
</div>
 </p>
	   </div>
  <br>
    </aside>
               <!-- CONTENT -->
               <section class="s-12 l-6">
 <?php
 $database=$adminusername."_studentusers";
 $sql6="SELECT previewtimetable1 FROM $database Where username='$user_check'";
$result6 = $conn->query($sql6);
if($result6 != "")
{
	if ($result6->num_rows > 0) 
{
    // output data of each row
    while($row6 = $result6->fetch_array())
		{
			$rows6		=	 $row6['previewtimetable1'];
		}
}
if($rows6 != "")
{
	echo '<table><tr><th>Timetable  Status</th></tr><tr>
	<td>Your new Timetable  is ready just go and preview it</td></tr></table>';
}else{
	echo '<table><tr><th>Timetable  Status</th></tr><tr>
	<td> Your new Timetable is not ready</td></tr></table>';
}
}
 ?>
  </section>
		<!-- ASIDE NAV 2 -->
               <aside class="s-12 l-3">
                  <h2>Instruction</h2>
                  <div class="aside-nav">
                     <ol type="1">
						<li>you have to click on print timetable under timetable: preview and print to get print</li>
						<li><br></li>
						<li>you have to click on  preview timetable under timetable: preview and print to preview timetable </li>
						<li><br></li>
						<li>you have to click on Search and download under File:Search and download to download teacher upload file</li>
						<li><br></li>
					 </ol>
					  <br><br><br><br> <br><br><br><br>
                  </div>
               </aside>
            </div>
         </div>
      </div>
  <?php
include ("footer.php");
?>  
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
		panel.style.maxHeight = null;
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
   </body>
   
</html>