	<html>
	<head>
	<link rel="stylesheet" href="assets/style/style.css">
	<link rel="stylesheet" href="assets/style/bootstrap.min.css">
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	</head>
		<body>
		
			<form name="input" class="form-inline well" action="functions/login/login.php?function=loggedin" method="POST">
				<fieldset>
					<label for="username">
						<input required autofocus title="Please enter your username" type="text"  id="user_username" name="user_username" placeholder="username">
					</label>
					<label for="password">
						<input required title="Please enter your password" type="password" id="user_password" name="user_password" placeholder="password">
					</label>
					<input type="submit" class="button" value="Log in">
				</fieldset>
			</form>
<?php
include 'functions/login/dbconnect.php';

if (isset($_GET['function'])) {
	$function = mysql_real_escape_string($_GET['function']);
}
if (isset($function) && $function == "error"){
	$message = "Incorrect Username or Password";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
 ?>
		</body>
	</html>
