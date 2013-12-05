
<?php

function generateMail($email, $username, $password)
//if function is to generate an email for one user, send email automatically
  {
  //send email

	$subject = 'Jensen information';
	$message = 'Welcome to Jenseneducation!\r\nBelow is your login information.\r\nUsername: ' . $username . '\r\nPassword: ' . $password . '\r\nPlease log in at www.google.com';

	mail($email, $subject, $message);
  }

function sendMail($emailArr, $username, $password)
{

foreach ($emailArr as $email) 
	{
	    mail($email,$subject,$message);
	}
}

?>