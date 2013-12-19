<?php
/**
 * @author Johanna Lind <Johannna182@hotmail.com>
 */
	session_start();
	
	$error = "";
//if not logged in: go to login page
if ($_SESSION['loggedin'] == false) {
	header("location:../../loginform.php");
}
	include 'dbconnect.php';
	
	if (isset($_GET['function']) == "loggedin") {
		require_once('../../classes/external/bcrypt.php');
	$user_username = mysql_real_escape_string($_POST['user_username']);
	$user_password = mysql_real_escape_string($_POST['user_password']);
	
	$user_username = stripslashes($user_username);
	$user_password = stripslashes($user_password);

 
	$query = "SELECT * FROM tbl_user WHERE user_username='$user_username'";
	$result = mysql_query($query) or die ();

	$pw = mysql_result($result, 0, "user_password");

	$is_correct = Bcrypt::check($_POST['user_password'], $pw);
	
  if ($is_correct) {
    $_SESSION['user_id'] = mysql_result($result,0, "user_id");
    $_SESSION['user_username'] = mysql_result($result,0, "user_username");
	$_SESSION['loggedin'] = true;
  }else{
		header("location:../../loginform.php?function=error");
	} 
	
	mysql_free_result($result);
	
	if ($_SESSION["loggedin"] == true) {
	header("location:../../index.php?");
	}
	}	
	mysql_close();
?>