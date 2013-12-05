<?php
mysql_connect("wuk.web.bitcloud.se", "wukwebbi", "Wuk2013") or die("Could not connect");
mysql_select_db("wukwebbi_grupp3_2") or die("could not find database");

$output = '';

if(isset($_POST['search'])) {

	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);


	$query = mysql_query("SELECT * FROM tbl_user WHERE user_firstname LIKE '%$searchq%' OR user_lastname LIKE '%$searchq%'") or die("Could not search");
	$count = mysql_num_rows($query);

	if ($count == 0) {
		$output = 'No results';

	}

	else {
		while($row = mysql_fetch_array($query)) {
			$fname = $row['user_firstname'];
			$lname = $row['user_lastname'];
			$email = $row['user_email'];
			$phone = $row['user_phonenumber'];
			$id = $row['user_id'];


			$output .= '<div>'.$fname.' '.$lname.' '.$email.' '.$phone.'</div>';

		}
	}
}

?>


<!DOCTYPE>

<html>
	<head>
		<meta charset="utf-8">
		<title> Search </title>
	</head>
	<body>

		<form action="searchbox.php" method='post'>
		<input type='text' name="search" placeholder="Sök här"/>               
		<input type='submit' value='>>' />
		</form>

		<?php

			print("$output");

		?>
	</body>
</html>