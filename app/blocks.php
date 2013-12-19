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
					<li><a href="new_block.php"><button class="btn btn-success">Create New Block</button></a>
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
				<h2>Listing All Blocks</h2>
				<table id="blocks">
					<thead>
						<tr>
							<th>#</th>
							<th>Block Name</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query ="SELECT * FROM tbl_block ORDER By block_id DESC";
						$result = mysql_query($query) or die ();

						while($row = mysql_fetch_array($result)){
							$block_id = $row["block_id"];
							$block_name = $row['block_name']; 
							$block_startdate = $row["block_startdate"]; 
							$block_enddate = $row['block_enddate'];
						  ?>
						  <tr>
							<td><?php echo $block_id; ?></td>
							<td><a href="block_edit.php?block_id=<?php echo $block_id?>"> <?php echo $block_name; ?></a></td>
							<td><?php echo $block_startdate; ?></td>
							<td><?php echo $block_enddate; ?></td>
							<td><button class="btn btn-success" onclick="blockDelete(<?php echo $block_id;?>)">Delete</button> </td>
						  </tr>
						  <?php
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