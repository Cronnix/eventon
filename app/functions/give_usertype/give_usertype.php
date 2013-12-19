<!-- Alexander Timm -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"> 
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
				<h2>Manage user type</h2>
				<br>
				<table id="users">
					<thead>
					<div>

 <form id="userType" name="give_UserType" action="database.php?function=update" method="POST">

   <select id="category1" name="user_id">
     <option value="">person</option>

     <?php
     require ("dbconnect.php");
     $query = "SELECT * FROM tbl_user";
     $result = mysql_query($query) or die ();



     while($row = mysql_fetch_assoc($result)) {
       $id = $row["user_id"] ;
       $category1 = $row ["user_firstname"] ;
       echo "<option value='$id'> $category1 </option>";
     }

      mysql_free_result($result);
     ?>
   </select>


   <select id="category2" name="listUserType">
     <option value="user type">user type</option>
     <?php

     $query = "SELECT * FROM tbl_usertype";
     $result = mysql_query($query) or die ();


     while($row = mysql_fetch_assoc($result)) {
       $id = $row["usertype_id"] ;
       $category2 = $row["usertype_name"] ;
       echo "<option value='$id'> $category2 </option>";
     }

      mysql_free_result($result);
     ?>
   </select>


   <input type="submit" value="SAVE"/>

 </form>
</div>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="assets/js/jquery-2.0.3.min.js"></script>
</body>
</html>