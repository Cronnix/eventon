<html>
	<head>
		<meta charset="utf-8">
		<title> Search! </title>
	</head>
	<body>
			<h2> Search!</h2>
			<form action='./search.php' method='get'>
				<input type='text' name='key' size='50' value='<?php echo $_GET['key']; ?>' />
				<input type='submit' value='Search' />
			 </form>

			 <hr/>
	<?php
		$key = $_GET ['key'];

		$terms = explode(" ", $key);
		$query = "SELECT * FROM search WHERE ";

		foreach ($terms as $each) {
		echo $each;
			$i++;

			if ($i == 1)
				$query .= "description LIKE '$each' ";

				else 
				$query .= "OR description LIKE '$each' ";                    //varje sökord
		}

		//db_connect

		mysql_connect("localhost", "root", "");       //ansluter till databas
		mysql_select_db("search_engine");

		$query = mysql_query($query);
		$numrows = mysql_num_rows($query);

		if ($numrows > 0) {
			while ($row = mysql_fetch_assoc($query)) {
				$id = $row['id'];
				$fnamn = $row['fnamn'];
				$enamn = $row['enamn'];
				$security_number = $row['s_number'];
				$email = $row['e-mail'];
				$phone = $row['phone'];
				$user_type = $row['user_type'];
				$description = $row['description'];
				$link = $row['link'];

				echo "<h2><a href='$link'> $fnamn </a></h2>";

			}

		}

		else 
			echo "inga resultat hittades för \"<b>$key<b/>\"";     //om inga sökningar hittades

	?>


	</body>
</html>