<!doctype html>
<head>
	<meta charset="utf-8">
	<title>New Block</title>
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
<?php
require_once('functions/block_event/dbconnect.php');
?>
	
	  <form id="blockform" name="blockform" action="functions/block_event/block_event_db.php?function=newBlock"  method="POST">
		<h1>Block</h1>
		<label for="BlockName">
		<input type="text" id="block_name" name="block_name" placeholder="BlockName" autofocus>
		</label>
		<label for="StartDate">
			<input type="text" id="startDate" name="block_startdate" placeholder="StartDate">
		</label>
		<label for="EndDate">
			<input type="text" id="endDate" name="block_enddate" placeholder="EndDate">
		</label>
			<input type="submit" value="SAVE">
	  </form>
<a href="block_list.php">blocklist</a>

<!--<?php/*
	$query ="SELECT * FROM tbl_event";
	$result = mysql_query($query) or die (mysql_error());


	while($row = mysql_fetch_assoc($result)) {
		$event_id=$row["event_id"];
		$course_name=$row["course_name"];
		echo "<input type='checkbox' name='checkboxes[]' value='$event_id'>$course_name";
	}

	mysql_free_result($result);
*/?>-->
</body>
</html>