<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

namespace Classtration;

class User_Base
{
	// User properties
	protected $fname;
	protected $lname;
	protected $ssn;
	protected $email;
	protected $phone;
	protected $id;
	protected $type;
	protected $username;
	protected $password;
	protected $hash;

	/**
	 * Generates a username containing the 3 first chars
	 * from the first and last name plus 4 random digits
	 * @param  string $fname 
	 * @param  string $lname
	 * @return string 		 the generated username
	 */
	public static function createUsername($fname, $lname)
	{
		if ($fname && $lname)
		{
			return ucfirst(substr($fname, 0, 3)).ucfirst(substr($lname, 0, 3)).self::generateNumber(1000, 9999);
		}
	}

	/**
	 * Generates a secure password hash (external lib)
	 * @param  string $password
	 * @return string[60]  
	 */
	protected function generateHash($password)
	{
		require_once('/../external/bcrypt.php');
		return \Bcrypt::hash($password);
	}

	/**
	 * Generate random numbers within a serie
	 * @param  int $min 
	 * @param  int $max 
	 * @return int     
	 */
	public static function generateNumber($min, $max)
	{
		return rand($min, $max);
	}

	/**
	 * Generates a random string (may be used for passswords)
	 * @param  int $length
	 * @return string
	 */
	public static function generateString($length)
	{
		return substr(md5(rand()), 0, $length);
	}


	/**
	 * Attempts to call the validation methods for user properties
	 * @param  array  $userData  data to test
	 * @param  array  $settings  validation options
	 * @return array           
	 */
	protected static function validate($userData, $settings)
	{
		$validate = new util\UserValidation($settings);
		try
		{
			$validate->name($userData['fname']);
			$validate->name($userData['lname']);
			$validate->ssn($userData['ssn']);
			$validate->email($userData['email']);
			$validate->phone($userData['phone']);
			$validate->type($userData['type']);

			// Check whether we have client created passwords or not
			if (is_array($userData['password'])) 
			{
				$validate->password($userData['password']);
			}
			// Or we generate a new password
			else
			{
				$userData['password'] = self::generateString(8);
			}
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
		return $userData;
	}
}