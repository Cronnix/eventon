<?php
/**
 * @author Johanna Lind <Johannna182@hotmail.com>
 */
session_start(); //enable the use of $_SESSION variables

//reset sessions variables
unset($_SESSION['user_id']);
unset($_SESSION['user_username']);
unset($_SESSION['loggedin']);

//go to login page
header("location:../../loginform.php");
?>