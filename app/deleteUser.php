<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

require_once('classes/user/user.php');

$id = is_numeric($_REQUEST['id']) ? $_REQUEST['id'] : false; 

if ($id)
{
	$user = new Classtration\User;
	$user->delete($id);
	echo "The user #{$id} has been deleted.";
}
?>
