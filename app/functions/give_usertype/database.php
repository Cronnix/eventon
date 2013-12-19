<!-- Alexander Timm -->

<?php require("dbconnect.php");  
 ?>  

 <?php  
error_reporting(-1); 

$function = mysql_real_escape_string($_GET['function']);  
$category1 = ($_POST["user_id"]);  
$category2 = mysql_real_escape_string($_POST["listUserType"]);  

if ($function == "update") {  

$update_query = "UPDATE tbl_user SET usertype_id = '$category2' WHERE user_id = '$category1'";  

mysql_query($update_query) or die ("Userrole edit failed"); 

echo "update succesful";
echo "<br/>";
 
}  
 
echo "<a href='give_usertype.php'> <br> return</a>"; 
 ?>

 <?php
mysql_close();
?>