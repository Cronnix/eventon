<!DOCTYPE html>
<?php 
$db_username="sql425233";
$db_password="tC7!qD6*";
$database="sql425233";
$host="sql4.freemysqlhosting.net";
 
$connection = mysql_connect($host, $db_username, $db_password);
mysql_select_db($database, $connection) or die ();
?>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/style/normalize.css">
	<link rel="stylesheet" href="assets/style/bootstrap.min.css">
	<link rel="stylesheet" href="assets/style/main.css">
</head>
<body>
	<div class="container-full">
		<div id="topbar" role="banner" class="row">
			<div id="logo" class="col-md-3">
				<header>
					<h1>Classtration</h1>
				</header>
			</div>
			<div id="action-bar" class="col-md-9 clearfix">
				<div class="admin-info pull-right">
					<span><span class="glyphicon glyphicon-lock"></span>Logged in as <strong>Sebastian</strong></span>
				</div>
				<ul class="button-nav">
					<li><a href=""><button class="btn btn-success">Create User</button></a>
				</ul>
			</div>
		</div>
		<div class="row full-height">
			<div id="leftbar" class="col-md-3">
				<aside>
					<h3>Management</h3>
					<nav>
						<ul>
							<li><span class="glyphicon glyphicon-star"></span><a href="#">Blocks</a></li>
							<li class="current"><a href="#"><span class="glyphicon glyphicon-user"></span>Users</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-time"></span>Events</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-envelope"></span>E-mails</a></li>
						</ul>
					</nav>
					<form action="searchbox.php"method="post" id="search">
						<fieldset>
							<input type="search" name="search" placeholder="Search for a user...">
							<button><span class="glyphicon glyphicon-search"></button>
						</fieldset>
					</form>
				</aside>
			</div>
			<div id="content" class="col-md-9">
				<h2>Searching</h2>
				<table id="users">
					<thead>

<?php

$output = '';

if(isset($_POST['search'])) {

	$searchq = $_POST['search'];
	$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);


	 $query = "SELECT * FROM tbl_user WHERE user_firstname LIKE '$searchq' OR user_lastname LIKE '$searchq' OR user_phonenumber LIKE '$searchq' OR user_email LIKE '$searchq'";
                        $result = mysql_query($query) or die("Could not search");
                        var_dump($query);
 
	}

		while($row = mysql_fetch_array($result)) {
			$id = $row['user_id'];
			$fname = $row['user_firstname'];
			$lname = $row['user_lastname'];
			$email = $row['user_email'];
			$phone = $row['user_phonenumber'];

			$output .= '<div>'.$fname.' '.$lname.' '.$email.' '.$phone.'</div>';

		}
}
?>
<?php
 mysql_close($connection);
  ?>
	<?php

			print("$output");

		?>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="assets/js/jquery-2.0.3.min.js"></script>

</body>
</html>