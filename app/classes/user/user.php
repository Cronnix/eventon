<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

namespace Classtration;

// Validation class to validate user data input
require_once('validation.php');
// Db class
require_once('/../db/db.php');

/**
 * Base class for users with a magic __get method to read
 * private/protected properties from the object. Supports
 * user creation, reading and save.
 * 
 * TODO: implement the full CRUD (missing update, delete
 * and better reading support)
 */
class User
{
	// User properties
	protected $fname;
	protected $lname;
	protected $ssn;
	protected $email;
	protected $phone;
	private $id;
	private $type;
	private $username;
	private $password;
	private $hash;

	// Global instance of the Db handle (within the class scope)
	private $db;

	// Invoked when a new user objected is created 
	function __construct() {
		$db = new Db;

		// We're now connected to the Db
		$this->db = $db->connect();
	}

	/**
	 * A public getter to reach user properties
	 * @param  string    the property to look for
	 * @return function  getter-method to execute
	 */
	public function __get($property) {

		// Does the Property exist within the $this-scope?
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

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
				$userData['password'] = self::generateString(8);
			}
		}
		catch (\Exception $e)
		{
			die($e->getMessage());
		}
		return $userData;
	}

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
}

?>
