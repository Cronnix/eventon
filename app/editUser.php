<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

require_once('classes/user/user.php');

$id = is_numeric($_REQUEST['id']) ? $_REQUEST['id'] : false; 

if ( ! empty($_POST['editUser']))
{
	$user = Classtration\User::edit(
		array(
			'fname'		=> $_POST["fname"],
			'lname'		=> $_POST["lname"],
			'ssn'		=> $_POST["ssn"],
			'email'		=> $_POST["email"],
			'phone'		=> $_POST["phone"],
			'type'		=> $_POST["type"],
			// Uncomment the line below if you don't want to generate passwords automagically
		    //'password'	=> array($_POST['password'], $_POST['repeatPassword']),
		),
		array(
			'min_digits'   => 1,
			'min_uppers'   => 1,
			'min_chars'    => 5,
			'min_specials' => 0,
		),
		$id,
		true
	);
}
if ($id)
{
	$user = new Classtration\User;
	foreach ($user->view($id) as $viewUser);

	var_dump($viewUser);
}
?>

<form method="post" action="<?php echo $_SERVER['self']; ?>">
	<input type="text" name="fname" id="fname" placeholder="First name" value="<?php echo $viewUser->user_firstname ? $viewUser->user_firstname : '';?>">
	<input type="text" name="lname" id="lname" placeholder="Last name" value="<?php echo $viewUser->user_lastname ? $viewUser->user_lastname : '';?>">
	<input type="text" name="ssn" id="ssn" placeholder="Social security number" value="<?php echo $viewUser->user_ssn ? $viewUser->user_ssn : '';?>">
	<input type="text" name="email" id="email" placeholder="E-mail" value="<?php echo $viewUser->user_email ? $viewUser->user_email : '';?>">
	<input type="text" name="phone" id="phone" placeholder="Phone" value="<?php echo $viewUser->user_phonenumber ? $viewUser->user_phonenumber : '';?>">
	<input type="text" name="type" id="type" placeholder="Type" value="<?php echo $viewUser->usertype_id ? $viewUser->usertype_id : ''; ?>">
	<input type="submit" name="editUser" id="editUser" value="Edit User">
</form>