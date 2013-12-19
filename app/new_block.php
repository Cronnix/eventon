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
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script>
		$(document).ready(function(){
		$("#startDate").datepicker({
			minDate: 0,
			numberOfMonths: 2,
			onSelect: function(selected) {
			  $("#endDate").datepicker("option","minDate", selected)
			}
		});
		$("#endDate").datepicker({ 
			minDate: 0,
			numberOfMonths: 2,
			onSelect: function(selected) {
			   $("#startDate").datepicker("option", selected)
			}
		});  
		});
	</script>
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
							<li class="current"><span class="glyphicon glyphicon-star"></span><a href="blocks.php">Blocks</a></li>
							<li ><a href="users/view.php"><span class="glyphicon glyphicon-user"></span>Users</a></li>
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
				<h2>Create New Block</h2>
				<form id="blockform" name="blockform" action="functions/block_event/block_event_db.php?function=newBlock"  method="POST">
					<label for="BlockName">
						<input type="text" id="block_name" name="block_name" placeholder="BlockName">
					</label>
					<label for="StartDate">
						<input type="text" id="startDate" name="block_startdate" placeholder="StartDate">
					</label>
					<label for="EndDate">
						<input type="text" id="endDate" name="block_enddate" placeholder="EndDate">
					</label>
					<input type="submit" class="btn btn-success" value="SAVE">
				</form>
			</div>
		</div>
	</div>
</body>
</html>