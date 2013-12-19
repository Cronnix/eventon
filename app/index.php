<!DOCTYPE html>
<?php
/**
 * @author Johanna Lind <Johannna182@hotmail.com>
 */
include 'functions/login/loggedin.php';
include 'functions/login/dbconnect.php';
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
					<span><span class="glyphicon glyphicon-lock"></span>Logged in as <strong><?php echo $_SESSION['user_username']; ?></strong></span>
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
							<li><span class="glyphicon glyphicon-star"></span><a href="blocks.php">Blocks</a></li>
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
				<h2>Index</h2>
				<div>
					<a href="functions/login/logout.php"><button class="btn btn-success">Log Out</button></a>
					
				</div>

			</div>
		</div>
	</div>
	<script src="assets/js/jquery-2.0.3.min.js"></script>
</body>
</html>
