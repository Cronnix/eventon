<!doctype html>
<head>
	<meta charset="utf-8">
	<title>New Event</title>
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
	
	  <form id="eventform" name="eventform" action="functions/block_event/block_event_db.php?function=newEvent"  method="POST">
		<h1>Event</h1>
		<label for="CourseName">
		<input type="text" id="course_name" name="course_name" placeholder="CourseName" autofocus>
		</label>
		<label for="StartDate">
			<input type="text" id="startDate" name="event_startdate" placeholder="StartDate">
		</label>
		<label for="EndDate">
			<input type="text" id="endDate" name="event_enddate" placeholder="EndDate">
		</label>

	  <select id="block_id" name="block_id">
      <option value="">Choose category</option>
      <?php
      //hämtar blocken från databasen
	  $query ="SELECT * FROM tbl_block ORDER BY block_name";
      $result = mysql_query($query) or die (mysql_error());

      //loopar igenom query resultaten och lägger till <option> för varje 'row' 
      while($row = mysql_fetch_assoc($result)) {
		$block_id=$row["block_id"];
		$block_name=$row["block_name"];
        echo "<option value='$block_id'>$block_name</option>";
      }
	  mysql_free_result($result);
      ?>
    </select>
	
			<input type="submit" value="SAVE">
	  </form>
<a href="event_list.php">eventlist</a>
</body>
</html>