<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

require_once('classes/user/user.php');

$id = is_numeric($_REQUEST['id']) ? $_REQUEST['id'] : false; 
$users = new Classtration\User;

?>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>First name</th>
			<th>Last name</th>
			<th>Social security number</th>
			<th>Username</th>
			<th>Email</th>
			<th>Block</th>
		</tr>
	</thead>
	<tbody>
<?php
// Determine if we're going to show a specific user
// or all users that are available.
$view = $id ? $users->view($id) : $users->view();

foreach ($view as $user) :
?>
	<tr>
		<td><?php echo $user->user_id; ?></td>
		<td><a href="editUser.php?id=<?php echo $user->user_id; ?>"><?php echo $user->user_firstname; ?></td>
		<td><a href="editUser.php?id=<?php echo $user->user_id; ?>"><?php echo $user->user_lastname; ?></td>
		<td><?php echo $user->user_ssn; ?></td>
		<td><?php echo $user->user_username; ?></td>
		<td><?php echo $user->user_email; ?></td>
		<td><?php echo $users->get_block($user->program_id)->block_name; ?></td>
	</tr>
<?php
endforeach;
?>
	</tbody>
</table>
