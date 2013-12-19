<?php
/**
 * @author Johanna Lind <Johannna182@hotmail.com>
 */
include 'functions/login/loggedin.php';
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
mysql_close();
?>
    
  </body>
</html>
