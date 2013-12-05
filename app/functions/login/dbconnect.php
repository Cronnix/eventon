<?php
$db_username="wukwebbi_grupp3";
$db_password="weeho549";
$database="wukwebbi_grupp3_2";
$host="wuk.web.bitcloud.se";

$db = mysql_connect($host, $db_username, $db_password);
mysql_select_db($database, $db) or die ();
?>
