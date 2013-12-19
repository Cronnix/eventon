<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

require_once('../classes/user/user.php');

$id = is_numeric($_REQUEST['id']) ? $_REQUEST['id'] : false; 

if ( ! empty($_POST['editUser']))
{
	$user = Classtration\User::edit(
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
		),
		$id,
		true
	);
}
if ($id)
{
	$user = new Classtration\User;
	foreach ($user->view($id) as $viewUser);
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
				<h2>Editing user</h2>
				<div class="entry">
					<form method="post" action="<?php echo $_SERVER['self']; ?>">
						<input type="text" name="fname" id="fname" placeholder="First name" value="<?php echo $viewUser->user_firstname ? $viewUser->user_firstname : '';?>">
						<input type="text" name="lname" id="lname" placeholder="Last name" value="<?php echo $viewUser->user_lastname ? $viewUser->user_lastname : '';?>">
						<input type="text" name="ssn" id="ssn" placeholder="Social security number" value="<?php echo $viewUser->user_ssn ? $viewUser->user_ssn : '';?>">
						<input type="text" name="email" id="email" placeholder="E-mail" value="<?php echo $viewUser->user_email ? $viewUser->user_email : '';?>">
						<input type="text" name="phone" id="phone" placeholder="Phone" value="<?php echo $viewUser->user_phonenumber ? $viewUser->user_phonenumber : '';?>">
						<input type="text" name="type" id="type" placeholder="Type" value="<?php echo $viewUser->usertype_id ? $viewUser->usertype_id : ''; ?>">
						<div class="btn-nav">
							<input type="submit" name="editUser" class="btn btn-primary" id="editUser" value="Save User">
							<button class="btn btn-default">Edit User Role</button>
							<button class="btn btn-default">Generate New Password</button> 
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="../assets/js/jquery-2.0.3.min.js"></script>
</body>
</html>