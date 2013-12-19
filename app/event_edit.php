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
<?php
if(isset($_GET['event_id'])) //kollar om man fått in event_id
{
	$event_id=$_GET['event_id']; //om id är skickar får man en query med informationen från databasen i table 'tbl_event' som matchar valda event_id
	$qry=mysql_query("SELECT * FROM tbl_event WHERE event_id=$event_id");
		if(!$qry)
		{
			die("Query Failed: ". mysql_error());
		}	
	$row=mysql_fetch_array($qry);//gör queryn till en array som sedan gör om inehållet till variabler
	$course_name =$row['course_name'];
	$event_startdate =$row['event_startdate'];
	$event_enddate =$row['event_enddate'];
	$block_id =$row['block_id'];
}
?>
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
							<li><span class="glyphicon glyphicon-star"></span><a href="blocks.php">Blocks</a></li>
							<li ><a href="#"><span class="glyphicon glyphicon-user"></span>Users</a></li>
							<li class="current"><a href="events.php"><span class="glyphicon glyphicon-time"></span>Events</a></li>
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
				<h2>Edit Event</h2>
				<form id="eventform" name="eventform" action="functions/block_event/block_event_db.php?function=updateEvent&event_id=<?php echo $event_id; ?>" method="POST">
					<label for="EventName">
						<input type="text" id="course_name" name="course_name" value="<?php echo $course_name; ?>" autofocus>
					</label>
					<label for="StartDate">
						<input type="text" id="startDate" name="event_startdate" value="<?php echo $event_startdate; ?>">
					</label>
					<label for="EndDate">
						<input type="text" id="endDate" name="event_enddate" value="<?php echo $event_enddate; ?>">
					</label>
					<select id="block_id" name="block_id">
						<option value="">Choose Block</option>
						<?php
						//hämtar blocken från databasen
						  $query ="SELECT * FROM tbl_block";
						  $result = mysql_query($query) or die (mysql_error());

						  //loopar igenom query resultaten och lägger till <option> för varje 'row' 
						while ($row = mysql_fetch_assoc($result)) {
						echo	'<option value="' . $row["block_id"] . 
								'"' . ($block_id == $row["block_id"] 
								? ' selected="selected"' : '') . '>' . 
								$row["block_name"] . '</option>';
						}
						  mysql_free_result($result);
						  mysql_close();
						?>
					</select>
					<input type="submit" class="btn btn-success" value="SAVE">
				</form>
			</div>
		</div>
	</div>
</body>
</html>