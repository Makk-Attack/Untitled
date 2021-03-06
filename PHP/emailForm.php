<?php
	if(!isset($_POST['submit'])){
		//This page should not be accessed directly. Need to submit the form.
		echo "error; you need to submit the form!";
	}
	
	$fname = IsInjected($_POST['firstname']);
	$lname = IsInjected($_POST['lastname']);
	$email = IsInjected($_POST['email']);
	$company = IsInjected($_POST['companyname']);
	
	$email_from = "us@mjinit.com";
	$email_subject = "New client info";
	$email_body = "Contacted by $fname $lastname. \n".
					"Company: $company\n".
					"Email: $email\n".
	$to = "mjdevstartup@gmail.com";
	$headers = "From: $email_from \r\n";
	$headers .= "Reply to $email \r\n";
	
	mail($to, $email_subject, $email_body);//, $headers);
	header('Location: ../index.html');

	function IsInjected($str){
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
		return $str;
	  }
	}
?>