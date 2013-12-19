<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

require_once('../classes/user/user.php');

$id = is_numeric($_REQUEST['id']) ? $_REQUEST['id'] : false; 
$users = new Classtration\User;

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
				<h2>Listing all users</h2>
				<table id="users">
					<thead>
						<tr>
							<th>#</th>
							<th>First name</th>
							<th>Last name</th>
							<th>Social security number</th>
							<th>Username</th>
							<th>E-mail</th>
							<th>Program</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
<?php
// Determine if we're going to show a specific user
// or all users that are available.
$view = $id ? $users->view($id) : $users->view();

foreach ($view as $user) :
?>
	<tr>
		<td><?php echo $user->user_id; ?></td>
		<td><a href="edit.php?id=<?php echo $user->user_id; ?>"><?php echo $user->user_firstname; ?></td>
		<td><a href="edit.php?id=<?php echo $user->user_id; ?>"><?php echo $user->user_lastname; ?></td>
		<td><?php echo $user->user_ssn; ?></td>
		<td><?php echo $user->user_username; ?></td>
		<td><?php echo $user->user_email; ?></td>
		<td><?php echo $users->get_block($user->program_id)->block_name; ?></td>
		<td><a href="delete.php?id=<?php echo $user->user_id; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
	</tr>
<?php
endforeach;
?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="../assets/js/jquery-2.0.3.min.js"></script>
</body>
</html>