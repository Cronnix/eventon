<!doctype html>
<head>
	<meta charset="utf-8">
	<title>Edit Block</title>
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
</script>
<?php
require_once('functions/block_event/dbconnect.php');

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
}
?>
</head>
<body>
	  <form id="eventform" name="eventform" action="functions/block_event/block_event_db.php?function=updateEvent&event_id=<?php echo $event_id; ?>" method="POST">
		<h1>Block</h1>
		<label for="EventName">
		<input type="text" id="course_name" name="course_name" value="<?php echo $course_name; ?>" autofocus>
		</label>
		<label for="StartDate">
			<input type="text" id="startDate" name="event_startdate" value="<?php echo $event_startdate; ?>">
		</label>
		<label for="EndDate">
			<input type="text" id="endDate" name="event_enddate" value="<?php echo $event_enddate; ?>">
		</label>
			<input type="submit" value="SAVE">
	  </form>
</body>
</html>