<!DOCTYPE html>
<?php
/**
 * @author Johanna Lind <Johannna182@hotmail.com>
 */
include 'functions/login/loggedin.php';
include 'functions/block_event/dbconnect.php';

?>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/style/normalize.css">
	<link rel="stylesheet" href="assets/style/bootstrap.min.css">
	<link rel="stylesheet" href="assets/style/main.css">
	<script src="assets/js/delete.js"></script>
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
				</ul>
			</div>
		</div>
		<div class="row full-height">
			<div id="leftbar" class="col-md-3">
				<aside>
					<h3>Management</h3>
					<nav>
						<ul>
							<li class="current"><span class="glyphicon glyphicon-star"></span><a href="#">Blocks</a></li>
							<li ><a href="#"><span class="glyphicon glyphicon-user"></span>Users</a></li>
							<li><a href="events.php"><span class="glyphicon glyphicon-time"></span>Events</a></li>
							<li><a href="#"><span class="glyphicon glyphicon-envelope"></span>E-mails</a></li>
						</ul>
					</nav>
					<form action="search/index.php"method="get" id="search">
						<fieldset>
							<input type="search" name="term" placeholder="Search for a user...">
							<button><span class="glyphicon glyphicon-search"></button>
						</fieldset>
					</form>
				</aside>
			</div>
			<div id="content" class="col-md-9">	
			<form id="eventform" name="eventform" action="test.php?function=userBlock"  method="POST">
				<select id="block_id" name="block_id">
					<option value="">Choose Block</option>
						<?php
						$query ="SELECT * FROM tbl_block ORDER BY block_name";
						$result = mysql_query($query) or die (mysql_error());

						while($row = mysql_fetch_assoc($result)) {
							$block_id=$row["block_id"];
							$block_name=$row["block_name"];
							echo "<option value='$block_id'>$block_name</option>";
						}
						mysql_free_result($result);
						?>
				</select>
				<select id="user_id" name="user_id">
					<option value="">Choose User</option>
					<?php
					$query ="SELECT * FROM tbl_user ORDER BY user_firstname";
					$result = mysql_query($query) or die (mysql_error());

					while($row = mysql_fetch_assoc($result)) {
						$user_id=$row["user_id"];
						$user_firstname=$row["user_firstname"];
						echo "<option value='$user_id'>$user_firstname</option>";
					}
					?>
				</select>
					<input type="submit" class="btn btn-success" value="SAVE">
			</form>
			<?php
			if(isset($_GET['function']) && isset($_POST['block_id']) && isset($_POST['user_id'])){
			$function = mysql_real_escape_string($_GET['function']);
			$block_id = mysql_real_escape_string($_POST["block_id"]);
			$user_id = mysql_real_escape_string($_POST["user_id"]);
			
			if ($function == "userBlock") {	
				$insert_query = "INSERT INTO tbl_participant(user_id,program_id) VALUES ('$user_id','$block_id')";
				mysql_query($insert_query) or die (mysql_error());

				header("location:test.php?");
			}
			}
			?>
			<h2>User & Blocks</h2>
			<table id="blocks">
				<thead>
					<tr>
						<th>User ID</th>
						<th>User Name</th>
						<th>Block ID</th>
						<th>Block Name</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$query ="SELECT * FROM tbl_participant";
				$result = mysql_query($query) or die ();

				while($row = mysql_fetch_array($result)){
					$user_id = $row["user_id"];
					$program_id = $row['program_id'];

				$query1 ="SELECT block_name FROM tbl_block WHERE block_id=$program_id";
				$result1 = mysql_query($query1) or die ();

				while($row = mysql_fetch_array($result1)){
					$program_name = $row['block_name'];

				$query2 ="SELECT user_firstname FROM tbl_user WHERE user_id=$user_id";
				$result2 = mysql_query($query2) or die ();

				while($row = mysql_fetch_array($result2)){
					$user_firstname = $row['user_firstname'];
				?>
				<tr>
					<td><?php echo $user_id ?></td>
					<td><?php echo $user_firstname ?></td>
					<td><?php echo $program_id ?></td>
					<td><?php echo $program_name ?></td>
				</tr>
				<?php
				}
				}
				}
				mysql_free_result($result);
				mysql_close();
				?>
			</tbody>
			</table>
			</div>
		</div>
	</div>
	<script src="assets/js/jquery-2.0.3.min.js"></script>
</body>
</html>