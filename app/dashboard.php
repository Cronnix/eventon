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
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Sebastian</td>
							<td>Westberg</td>
							<td>199005083911</td>
							<td>SebWes0001</td>
							<td>sebastian.westberg@24group.se</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Sebastian</td>
							<td>Westberg</td>
							<td>199005083911</td>
							<td>SebWes0001</td>
							<td>sebastian.westberg@24group.se</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Sebastian</td>
							<td>Westberg</td>
							<td>199005083911</td>
							<td>SebWes0001</td>
							<td>sebastian.westberg@24group.se</td>
						</tr>
						<tr>
							<td>4</td>
							<td>Sebastian</td>
							<td>Westberg</td>
							<td>199005083911</td>
							<td>SebWes0001</td>
							<td>sebastian.westberg@24group.se</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="assets/js/jquery-2.0.3.min.js"></script>
</body>
</html>