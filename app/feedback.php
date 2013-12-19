<!DOCTYPE html>
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
					<form action="search/index.php"method="get" id="search">
						<fieldset>
							<input type="search" name="term" placeholder="Search for a user...">
							<button><span class="glyphicon glyphicon-search"></button>
						</fieldset>
					</form>
				</aside>
			</div>
			<div id="content" class="col-md-9">
				<?php 

				//require "/functions/login/loggedin.php";

				$db_username="sql425233";
				$db_password="tC7!qD6*";
				$database="sql425233";
				$host="sql4.freemysqlhosting.net";

				$db = mysql_connect($host, $db_username, $db_password);
				mysql_select_db($database, $db) or die ();

				$function = $_GET['function'];
				$userid = $_GET['userid'];

				$name_q = "SELECT user_firstname, user_lastname FROM tbl_user WHERE user_id = '$userid'";
				$nameResult = mysql_query($name_q) or die ("bad name query");
				$nameRow = mysql_fetch_array($nameResult);
				$name = $nameRow['user_firstname'];
				$lname = $nameRow['user_lastname'];


				$username = $name . ' ' . $lname;

				if ($function == "addFeed")
				{
					$grade = $_POST['grade'];
					$comment = mysql_real_escape_string($_POST['comment']);
					$eventid = $_POST['eventid'];

					$insert_query = "INSERT INTO tbl_feedback (feedback_grade, feedback_com, user_id, course_id) VALUES ('$grade', '$comment', $userid, $eventid)";
					var_dump($insert_query);
					mysql_query($insert_query) or die (mysql_error());

					$message = "Feedback added!";
				}

				?>

				<div id="feedbackWrap">
					<form id="feedform" name="feedbackform" action="feedback.php?function=addFeed&userid=<?php echo $userid;?>" method="POST">
					<p id="fbmessage"><?php echo $message;?></p>
					<h2 class="btitle">Add new feedback to <?php echo $username;?></h2>
					<input type="text" id="fcomment" name="comment" placeholder="Feedback">
					<select id="grade" name="grade">
						<option value="IG">IG</option>
						<option value="IG">G</option>
						<option value="IG">VG</option>
						<option value="IG">MVG</option>
					</select>
					<select id="eventid" name="eventid">
						<?php
						$event_q = "SELECT * FROM tbl_event";
						$eventResult = mysql_query($event_q) or die ("bad event query");
							while ($eventRow = mysql_fetch_array($eventResult)) {
								$eventName = $eventRow['course_name'];
								$eventlistId = $eventRow['event_id'];
								echo "<option value=$eventlistId>$eventName</option>";
							}
						?>
					</select>
					<input type="button" value="Add Feedback" onclick="feedform.submit();" />
					</form>

					<p>Existing feedback for this user:</p>
					<table id="feedbackTable">
					<?php
					$feedback_q = "SELECT * FROM tbl_feedback WHERE user_id = $userid";
					$feedbackResult = mysql_query($feedback_q);
					var_dump($feedback_q);

					while ($feedbackRow = mysql_fetch_array($feedbackResult)) {
						$f_com = $feedbackRow['feedback_com'];
						$f_grade = $feedbackRow['feedback_grade'];

						echo "<tr>
							  <td>$f_grade</td>
						      <td>$f_com</td>
						      <tr>";
					}
					?>
					</table>
				</div>

				<?php
				mysql_close($db);
				?>
			</div>
		</div>
	</div>
	<script src="assets/js/jquery-2.0.3.min.js"></script>
</body>
</html>