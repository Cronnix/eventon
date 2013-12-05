<?php
header('Content-type: text/html; charset=ISO-8859-1'); //swedish
session_start(); //enable the use of $_SESSION variables

//if not logged in: go to login page
if ($_SESSION['loggedin'] == false) {
	header("location:functions/login/login.php");
}

//include db connection file
include 'dbconnect.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Administration</title>
    <meta charset="utf-8">
  </head>
  <body>
    
    <div>
      Logged in as <?php echo $_SESSION['user_username']; ?>
      <a href="functions/login/logout.php">[Log out]</a>
    </div>
<?php
//close connection to db
mysql_close();
?>
    
  </body>
</html>
