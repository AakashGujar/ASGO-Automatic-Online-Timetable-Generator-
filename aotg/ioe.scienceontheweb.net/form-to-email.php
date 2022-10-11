<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$fname         = $_POST['fname'];
$lname         = $_POST['lname'];
$contact       = $_POST['contact'];
$visitor_email = $_POST['email'];
$message       = $_POST['message'];

$firstname         = $_POST['fname'];
$lastname         = $_POST['lname'];
$mycontact       = $_POST['contact'];
$myvisitor_email = $_POST['email'];
$mymessage       = $_POST['message'];


//Validate first
if(empty($lname)||empty($fname)||empty($contact)||empty($visitor_email))
{
    echo "Please fill out everything! We need to know who you are, and why you want to get in touch with us!";
    
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$to = "chitraartprinters168@gmail.com";//<== update the email address
$email_from = 'anqlrim6.epizy.com';//<== update the email address
$email_subject = "New Client Details";
$email_body = "You have received a new message from the new user \n".
  "\n".
                        "client name = $fname $lname \n".
  "\n".
                        "client Email-id = $myvisitor_email \n".
  "\n".
                        "client contact number = $contact \n".                          "\n".
                         "client message =  $message \r".             


$headers = "From: noreply@chitraartprinters.com \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.

//Validate first
if(empty($lastname)||empty($firstname)||empty($mycontact)||empty($myvisitor_email)) 
{
    echo "Please fill out everything! We need to know who you are, and why you want to get in touch with us!";
    
    exit;
}

if(IsInjected($myvisitor_email))
{
    echo "Bad email value!";
    exit;
}



$email_from = 'chitraartprinters168@gmail.com';//<== update the email address
$email_subject = "New client Contact";
$email_body = "You have received a new message from the user \n".  
                        " $firstname \n".
                          "Here is the message:.\n".
                         " $mymessage /n".
                        " $myvisitor_email /n".

$to = " $myvisitor_email ";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $myvisitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: http://chitraartprinters.epizy.com/#contact');



// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}


?> 
   