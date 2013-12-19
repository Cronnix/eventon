<?php
require_once('functions/block_event/dbconnect.php');
?>
<html>
<head>
<script src="assets/js/delete.js"></script>
</head>
<body>
<div>
  <h1>Blocks</h1>

  <table>
    <tr>
      <th>Name</th>
      <th>Start Date</th>
	  <th>End Date</th>
	  <th>Events</th>
      <th>Delete</th>
    </tr>
    <?php
	$query ="SELECT * FROM tbl_block ORDER By block_id DESC";
    $result = mysql_query($query) or die ();

	while($row = mysql_fetch_array($result)){
		$block_id = $row["block_id"];
		$block_name = $row['block_name']; 
		$block_startdate = $row["block_startdate"]; 
		$block_enddate = $row['block_enddate'];
      ?>
      <tr>
		<td><a href="block_edit.php?block_id=<?php echo $block_id?>"> <?php echo $block_name; ?></a></td>
        <td><?php echo $block_startdate; ?></td>
		<td><?php echo $block_enddate; ?></td>
		<td><?php echo "..." ?></td>
        <td><a onclick="blockDelete(<?php echo $block_id;?>)">[Delete]</a></td>
      </tr>
      <?php
    }
    mysql_free_result($result);
    ?>
	<a href="new_block.php">New block</a>
  </table>
</div>
<?php mysql_close(); ?>
</body>
</html>