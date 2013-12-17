
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

function updatePass($email, $username, $password)
//if function is to generate an email for one user, send email automatically
  {
  //send email

	$subject = 'Jensen password update';
	$message = 'Hello ' . $username . ', your password has been updated to: ' . $password;

	mail($email, $subject, $message);
  }

?>
