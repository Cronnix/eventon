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
	 * @param  array  $settings  validation options for properties
	 * @return object 			 a new user object
	 */
	public static function create($userData, $settings = array())
	{
		$user = new User;

		// Validate and set the client data
		if ($userData = parent::validate($userData, $settings))
		{
			$user->fname = $userData['fname'];
			$user->lname = $userData['lname'];
			$user->ssn = $userData['ssn'];
			$user->email = $userData['email'];
			$user->phone = $userData['phone'];
			$user->type = $userData['type'];
			$user->password = $userData['password'];
			$user->username = $user->createUsername($userData['fname'], $userData['lname']);
			$user->hash = $user->generateHash($user->password);
			$user->save();
		}

		// Don't return the Db object, password hash or validation options
		unset($user->db);
		unset($user->hash);
		unset($user->validation);

		// Send e-mail with login information to the user
		require_once('../functions/mail/mail.php');

		// Can't send mail without a mail server setup
		//generateMail($user->email, $user->username, $user->password);

		return $user;
	}

	/**
	 * Validates and updates existing users 
	 * @param  array   $userData data sent from the user edit form
	 * @param  array   $settings validation options for properties
	 * @param  int     $id       id of the user 
	 */
	public static function edit($userData, $settings = array(), $id = null)
	{
		if (is_numeric($id))
		{
			$user = new User;

			$oldUserData = $user->view($id)[0];

			// Validate and set the client data
			if ($userData = parent::validate($userData, $settings))
			{
				$user->fname = $userData['fname'];
				$user->lname = $userData['lname'];
				$user->ssn = $userData['ssn'];
				$user->email = $userData['email'];
				$user->phone = $userData['phone'];
				$user->type = $userData['type'];

				/** 
				 * Check if the posted values for first- and last
				 * name matches the old ones, or a new username has
				 * to be generated for this user
				 */
				$user->username = $oldUserData->user_firstname == $userData['fname'] && $oldUserData->user_lastname == $userData['lname'] ? $oldUserData->user_username : $user->createUsername($userData['fname'], $userData['lname']);
				$user->hash = $oldUserData->user_password;
				//$user->id = $oldUserData->user_id;
				$user->save($id);
			}
		}
	}

	/**
	 * Deletes a user
	 * @param  int  $id  user id
	 */
	public function delete($id = null) 
	{
		$db = $this->db;

		if (is_numeric($id))
		{
			try
			{
				$sth = $db->prepare("DELETE FROM tbl_user WHERE user_id = {$id}");
				$sth->execute();
			}
			catch (PDOException $e)
			{
				die($e->getMessage());
			}

			// Takes the user back to the previous page
			header("Location: {$_SERVER['HTTP_REFERER']}");
		}
	}

	/**
	 * Grabs user data from the Db
	 * @param  int 	  $id  user id
	 * @return array       an array of User objects
	 */
	public function view($id = null)
	{
		$db = $this->db;
		$query = "
			SELECT a.*, b.program_id 
			FROM tbl_user
			AS a
			LEFT JOIN tbl_participant
			AS b
				ON a.user_id = b.user_id
		";

		try
		{
			if (is_numeric($id))
			{
				$sth = $db->prepare("
					{$query} 
					WHERE a.user_id = {$id}
				");
			}
			else
			{
				$sth = $db->prepare("
					{$query}
				");
			}
			$sth->execute();

			$result = array();
			$sth->setFetchMode(\PDO::FETCH_OBJ);


			// Every object that's returned appends to an array
			while ($obj = $sth->fetch())
			{
				$result[] = (object)$obj;
			}

		}
		catch (PDOException $e)
		{
			die($e->getMessage());
		}

		return $result;
	}

	/**
	 * Attempts to save a User object. When a user id
	 * is provided it will be used to update that
	 * specific user. If the id parameter is left out,
	 * the insert statement will be used instead
	 */
	private function save($id = null)
	{
		$db = $this->db;

		try
		{
			if ($id)
			{
				$sth = $db->prepare("UPDATE tbl_user SET user_firstname = :fname, user_lastname = :lname, user_email = :email, user_phonenumber = :phone, user_username = :username, user_password = :hash, usertype_id = :type, user_ssn = :ssn WHERE user_id = :id");
				$sth->bindParam(':id', $id, \PDO::PARAM_INT);
			}
			else 
			{
				$sth = $db->prepare("INSERT INTO tbl_user (user_firstname, user_lastname, user_email, user_phonenumber, user_username, user_password, usertype_id, user_ssn)
				value (:fname, :lname, :email, :phone, :username, :hash, :type, :ssn)");
			}
			
			// Binds properties to the query
			$sth->bindParam(':fname', $this->fname, \PDO::PARAM_STR, 40);
			$sth->bindParam(':lname', $this->lname, \PDO::PARAM_STR, 40);
			$sth->bindParam(':email', $this->email, \PDO::PARAM_STR, 50);
			$sth->bindParam(':phone', $this->phone, \PDO::PARAM_STR, 40);
			$sth->bindParam(':username', $this->username, \PDO::PARAM_STR, 10);
			$sth->bindParam(':hash', $this->hash, \PDO::PARAM_STR, 60);
			$sth->bindParam(':type', $this->type, \PDO::PARAM_INT);
			$sth->bindParam(':ssn', $this->ssn, \PDO::PARAM_STR, 12);

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
	 * Returns the block associated with the user id
	 * @param  int    $id  user id
	 * @return object
	 */
	public function get_block($id = null)
	{
		$db = $this->db;

		if (is_numeric($id)) 
		{
			try 
			{
				$sth = $db->prepare("
					SELECT * 
					FROM tbl_block
					WHERE block_id = {$id}
					LIMIT 1
				");
				$sth->execute();

				$sth->setFetchMode(\PDO::FETCH_OBJ);
			}
			catch (\PDOException $e)
			{
				die($e->getMessage());
			}

			return $sth->fetch();
		}
		else
		{
			return false;
		}
	}

	/**
	 * Returns all user types
	 * @param  int    $id  user id
	 * @return object
	 */
	public function get_usertypes()
	{
		$db = $this->db;

		try 
		{
			$sth = $db->prepare("
				SELECT * 
				FROM tbl_usertype
			");
			$sth->execute();

			$sth->setFetchMode(\PDO::FETCH_OBJ);
		}
		catch (\PDOException $e)
		{
			die($e->getMessage());
		}

		$result = array();

		while ($obj = $sth->fetch())
		{
			$result[] = (object)$obj;
		}

		return $result;
	}
}