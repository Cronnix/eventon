<?php
$db_username="root";
$db_password="";
$database="wukwebbi_grupp3_2";
$host="localhost";

$db = mysql_connect($host, $db_username, $db_password);
mysql_select_db($database, $db) or die ();
?>

