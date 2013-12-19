<?php
session_start();

//if not logged in: go to login page
if ($_SESSION['loggedin'] == false) {
	header("location:functions/login/login.php");
}
?>