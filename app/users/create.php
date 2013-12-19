<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

require_once('../classes/user/user.php');
$success = false;

if ( ! empty($_POST['addUser']))
{

	$user = Classtration\User::create(
		array(
			'fname'		=> $_POST["fname"],
			'lname'		=> $_POST["lname"],
			'ssn'		=> $_POST["ssn"],
			'email'		=> $_POST["email"],
			'phone'		=> $_POST["phone"],
			'type'		=> $_POST["type"],
			// Uncomment the line below if you don't want to generate passwords automagically
		    //'password'	=> array($_POST['password'], $_POST['repeatPassword']),
		),
		array(
			'min_digits'   => 1,
			'min_uppers'   => 1,
			'min_chars'    => 5,
			'min_specials' => 0,
		)
	);
	
	if ($user->user_id !== 0)
	{
		$success = true;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../assets/style/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/style/main.css">
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
					<li><a href="create.php"><button class="btn btn-success">Create User</button></a>
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
							<li class="current"><a href="view.php"><span class="glyphicon glyphicon-user"></span>Users</a></li>
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
				if ($success === true) :
				?>
				<div class="alert alert-success">User "<?php echo $user->username; ?>" with password "<?php echo $user->password; ?>" successfully added!</div>
				<?php
				endif;
				?>
				<h2>Create a New User</h2>
				<div class="entry">
					<form method="post" action="<?php echo $_SERVER['self']; ?>">
						<input type="text" name="fname" id="fname" placeholder="First name" value="<?php echo $_POST["fname"] ?: $_POST["fname"];?>">
						<input type="text" name="lname" id="lname" placeholder="Last name" value="<?php echo $_POST["lname"] ?: $_POST["lname"];?>">
						<input type="text" name="ssn" id="ssn" placeholder="Social security number" value="<?php echo $_POST["ssn"] ?: $_POST["ssn"];?>">
						<input type="text" name="email" id="email" placeholder="E-mail" value="<?php echo $_POST["email"] ?: $_POST["email"];?>">
						<input type="text" name="phone" id="phone" placeholder="Phone" value="<?php echo $_POST["phone"] ?: $_POST["phone"];?>">
						<input type="text" name="type" id="type" placeholder="Type" value="<?php echo $_POST["type"] ?: $_POST["type"];?>">
						<!--<input type="text" name="password" id="password" placeholder="Password">
						<input type="text" name="repeatPassword" id="repeatPassword" placeholder="Repeat password">-->
						<input type="submit" name="addUser" class="btn btn-primary" id="addUser" value="Add user">
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="../assets/js/jquery-2.0.3.min.js"></script>
</body>
</html>