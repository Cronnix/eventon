<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

require_once('classes/user/user.php');
if ( ! empty($_POST['addUser']))
{

	$user = Classtration\User::create(
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
		)
	);
	var_dump($user);
}
?>

<form method="post" action="<?php echo $_SERVER['self']; ?>">
	<input type="text" name="fname" id="fname" placeholder="First name" value="<?php echo $_POST["fname"] ?: $_POST["fname"];?>">
	<input type="text" name="lname" id="lname" placeholder="Last name" value="<?php echo $_POST["lname"] ?: $_POST["lname"];?>">
	<input type="text" name="ssn" id="ssn" placeholder="Social security number" value="<?php echo $_POST["ssn"] ?: $_POST["ssn"];?>">
	<input type="text" name="email" id="email" placeholder="E-mail" value="<?php echo $_POST["email"] ?: $_POST["email"];?>">
	<input type="text" name="phone" id="phone" placeholder="Phone" value="<?php echo $_POST["phone"] ?: $_POST["phone"];?>">
	<input type="text" name="type" id="type" placeholder="Type" value="<?php echo $_POST["type"] ?: $_POST["type"];?>">
	<input type="text" name="password" id="password" placeholder="Password">
	<input type="text" name="repeatPassword" id="repeatPassword" placeholder="Repeat password">	
	<input type="submit" name="addUser" id="addUser" value="Add user">
</form>