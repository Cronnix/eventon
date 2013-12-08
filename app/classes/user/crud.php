<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

namespace Classtration;

// Base methods for the User class
require_once('base.php');

class User_Crud extends User_Base
{

	/**
	 * Validates and sets the User object properties
	 * @param  array  $userData  data sent from the user creation form
	 * @param  array  $settings  validate options for the properties
	 * @return object 			 a new user object
	 */
	public static function create($userData, $settings = array())
	{
		$user = new User;

		// Validate and set the client data
		if ($userData = self::validate($userData, $settings))
		{
			$user->fname = $userData['fname'];
			$user->lname = $userData['lname'];
			$user->ssn = $userData['ssn'];
			$user->email = $userData['email'];
			$user->phone = $userData['phone'];
			$user->type = $userData['type'];
			$user->password = $userData['password'];
			$user->username = $user->createUsername($userData['fname'], $userData['lname']);
			$user->hash = $user->generateHash(list($userData['password']) = $password);
			$user->save();
		}

		// Don't return the Db object, password hash or validation options
		unset($user->db);
		unset($user->hash);
		unset($user->validation);

		return $user;
	}

	/**
	 * Grabs user data from the Db
	 * @param  int 	  $id  user id
	 * @return array       an array of User objects
	 */
	private function get($id = null)
	{
		$db = $this->db;

		try
		{
			if ($id)
			{
				$sth = $db->prepare("SELECT * FROM tbl_user WHERE id = {$id}");
			}
			else
			{
				$sth = $db->prepare("SELECT * FROM tbl_user");
			}
			$sth->execute();
		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}

		$result = array();
		$sth->setFetchMode(\PDO::FETCH_CLASS, 'User');

		// Every row that's returned appends to an array and is type-casted to an object
		while ($obj = $sth->fetch())
		{
			$result[] = (object)$obj;
		}
		return $result;
	}

	/**
	 * Attempts to save a User object
	 * TODO: check if an id is sent as a parameter and if so
	 * use and update instead of insertion
	 */
	private function save()
	{
		$db = $this->db;
		try
		{
			$sth = $db->prepare("INSERT INTO tbl_user (user_firstname, user_lastname, user_email, user_phonenumber, user_username, user_password, usertype_id)
			value (?, ?, ?, ?, ?, ?, ?)");
			
			// Binds properties to the query and runs it
			$sth->bindParam(1, $this->fname);
			$sth->bindParam(2, $this->lname);
			$sth->bindParam(3, $this->email);
			$sth->bindParam(4, $this->phone);
			$sth->bindParam(5, $this->username);
			$sth->bindParam(6, $this->hash);
			$sth->bindParam(7, $this->type);
			$sth->execute();
		}
		catch (\PDOException $e)
		{
			die($e->getMessage());
		}

		// The affected row's id
		$this->id = $db->lastInsertId();
	}

	/**
	 * Attempts to call the validation methods for user properties
	 * @param  array  $userData  data to test
	 * @param  array  $settings  validation options
	 * @return array           
	 */
	private static function validate($userData, $settings)
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
				$userData['password'] = parent::generateString(8);
			}
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
		return $userData;
	}


}