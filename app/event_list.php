<?php
require_once('functions/block_event/dbconnect.php');
?>
<html>
<head>
<script src="assets/js/delete.js"></script>
</head>
<body>
<div>
  <h1>Events</h1>

  <table>
    <tr>
      <th>Course Name</th>
      <th>Start Date</th>
	  <th>End Date</th>
	  <th>Block</th>
      <th>Feedback</th>
	  <th>Delete</th>
    </tr>
    <?php
	$query ="SELECT * FROM tbl_event ORDER By event_id DESC";
    $result = mysql_query($query) or die ();

	while($row = mysql_fetch_array($result)){
		$event_id = $row["event_id"];
		$course_name = $row['course_name']; 
		$event_startdate = $row["event_startdate"]; 
		$event_enddate = $row['event_enddate'];
		$block_id = $row['block_id'];
		
	$query1 ="SELECT block_name FROM tbl_block WHERE block_id=$block_id";
    $result1 = mysql_query($query1) or die ();

	while($row = mysql_fetch_array($result1)){
		$block_name = $row['block_name'];
      ?>
      <tr>
		<td><a href="event_edit.php?event_id=<?php echo $event_id?>"> <?php echo $course_name; ?></a></td>
        <td><?php echo $event_startdate; ?></td>
		<td><?php echo $event_enddate; ?></td>
		<td><?php echo $block_name; ?></td>
		<td>..........</td>
        <td><a onclick="eventDelete(<?php echo $event_id;?>)">[Delete]</a></td>	
      </tr>
      <?php
    }
	}
    mysql_free_result($result);
    ?>
	<br>
	<a href="new_event.php">New event</a>
	<br>
  </table>
</div>
<?php mysql_close(); ?>
</body>
</html>