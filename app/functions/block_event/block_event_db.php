<?php   
/**
 * @author Johanna Lind <Johannna182@hotmail.com>
 */
include '../login/loggedin.php';
include 'dbconnect.php';

//Blocks

	$function = mysql_real_escape_string($_GET['function']);
	$block_name = mysql_real_escape_string($_POST["block_name"]);
	$block_startdate = mysql_real_escape_string($_POST["block_startdate"]);
	$block_enddate = mysql_real_escape_string($_POST["block_enddate"]);
	$course = implode(',', $_POST['checkboxes']);
	
		//convert to the right date format 
		$startDateFormated = split('/', $block_startdate);
		$block_startdate = $startDateFormated[2].'-'.$startDateFormated[0].'-'.$startDateFormated[1];

		$endDateFormated = split('/', $block_enddate);
		$block_enddate = $endDateFormated[2].'-'.$endDateFormated[0].'-'.$endDateFormated[1];

	if ($function == "newBlock") {
		$insert_query = "INSERT INTO tbl_block (block_name,block_startdate,block_enddate) VALUES ('$block_name','$block_startdate','$block_enddate')";
		echo($insert_query);
		mysql_query($insert_query) or die (mysql_error());
		
		header("location:../../blocks.php");
	}
	if ($function == "updateBlock") {
		if(isset($_GET['block_id'])){
			$block_id=mysql_real_escape_string($_GET['block_id']);
			$block_name=mysql_real_escape_string($_POST['block_name']);
			$block_startdate=mysql_real_escape_string($_POST['block_startdate']);
			$block_enddate=mysql_real_escape_string($_POST['block_enddate']);

			$startDateFormated = split('/', $block_startdate);
			$block_startdate = $startDateFormated[2].'-'.$startDateFormated[0].'-'.$startDateFormated[1];

			$endDateFormated = split('/', $block_enddate);
			$block_enddate = $endDateFormated[2].'-'.$endDateFormated[0].'-'.$endDateFormated[1];
			
			$qry=mysql_query("UPDATE tbl_block SET block_name='$block_name',block_startdate='$block_startdate',block_enddate='$block_enddate' WHERE block_id='$block_id'");
			if($qry){
			header("location:../../blocks.php");
			}
			else
			{   
			die("Query Failed: ". mysql_error());
			} 
		}		
	}	
//delete inlägg
	 if ($function == "deleteBlock") {
		$block_id=mysql_real_escape_string($_GET['block_id']);
		//delete inlägg från databasen
		$delete_query = "DELETE FROM tbl_block WHERE block_id = $block_id";
		mysql_query($delete_query) or die (mysql_error());
  
		//skickar till articlelist
		header("location:../../blocks.php");
	}
//Events

	$course_name = mysql_real_escape_string($_POST["course_name"]);
	$event_startdate = mysql_real_escape_string($_POST["event_startdate"]);
	$event_enddate = mysql_real_escape_string($_POST["event_enddate"]);
	$block_id = mysql_real_escape_string($_POST["block_id"]);

		//convert to the right date format 
		$startDateFormated = split('/', $event_startdate);
		$event_startdate = $startDateFormated[2].'-'.$startDateFormated[0].'-'.$startDateFormated[1];

		$endDateFormated = split('/', $event_enddate);
		$event_enddate = $endDateFormated[2].'-'.$endDateFormated[0].'-'.$endDateFormated[1];

	if ($function == "newEvent") {
		$insert_query = "INSERT INTO tbl_event (course_name,event_startdate,event_enddate,block_id) VALUES ('$course_name','$event_startdate','$event_enddate','$block_id')";
		echo($insert_query);
		mysql_query($insert_query) or die (mysql_error());
  
		header("location:../../events.php?");
	}
	if ($function == "updateEvent") {
		if(isset($_GET['event_id'])){
			$event_id=mysql_real_escape_string($_GET['event_id']);
			$course_name=mysql_real_escape_string($_POST['course_name']);
			$event_startdate=mysql_real_escape_string($_POST['event_startdate']);
			$event_enddate=mysql_real_escape_string($_POST['event_enddate']);

			$startDateFormated = split('/', $event_startdate);
			$event_startdate = $startDateFormated[2].'-'.$startDateFormated[0].'-'.$startDateFormated[1];

			$endDateFormated = split('/', $event_enddate);
			$event_enddate = $endDateFormated[2].'-'.$endDateFormated[0].'-'.$endDateFormated[1];
			
			$qry=mysql_query("UPDATE tbl_event SET course_name='$course_name',event_startdate='$event_startdate',event_enddate='$event_enddate' WHERE event_id='$event_id'");
			if($qry){
			header("location:../../events.php");
			}
			else
			{   
			die("Query Failed: ". mysql_error());
			} 
		}

	}
	//delete inlägg
	if ($function == "deleteEvent") {
		$event_id=mysql_real_escape_string($_GET['event_id']);
		//delete inlägg från databasen
		$delete_query = "DELETE FROM tbl_event WHERE event_id = $event_id";
		mysql_query($delete_query) or die (mysql_error());
  
		//skickar till articlelist
		header("location:../../events.php");
	}
  mysql_close();
?>