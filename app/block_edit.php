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

if(isset($_GET['block_id'])) //kollar om man fått in blogg_id
{
	$block_id=$_GET['block_id']; //om id är skickar får man en query med informationen från databasen i table 'tbl_block' som matchar valda block_id
	$qry=mysql_query("SELECT * FROM tbl_block WHERE block_id=$block_id");
		if(!$qry)
		{
			die("Query Failed: ". mysql_error());
		}
		
	$row=mysql_fetch_array($qry);//gör queryn till en array som sedan gör om inehållet till variabler
	$block_name =$row['block_name'];
	$block_startdate =$row['block_startdate'];
	$block_enddate =$row['block_enddate'];
}
?>
</head>
<body>
	  <form id="blockform" name="blockform" action="functions/block_event/block_event_db.php?function=updateBlock&block_id=<?php echo $block_id; ?>" method="POST">
		<h1>Block</h1>
		<label for="BlockName">
		<input type="text" id="block_name" name="block_name" value="<?php echo $block_name; ?>" autofocus>
		</label>
		<label for="StartDate">
			<input type="text" id="startDate" name="block_startdate" value="<?php echo $block_startdate; ?>">
		</label>
		<label for="EndDate">
			<input type="text" id="endDate" name="block_enddate" value="<?php echo $block_enddate; ?>">
		</label>
<?php
	$query ="SELECT * FROM tbl_event";
	$result = mysql_query($query) or die (mysql_error());


	while($row = mysql_fetch_assoc($result)) {
		$event_id=$row["event_id"];
		$course_name=$row["course_name"];
		echo "<input type='checkbox' name='checkboxes[]' value='$event_id'>$course_name";
	}

	mysql_free_result($result);
?>
			<input type="submit" value="SAVE">
	  </form>
</body>
</html>
