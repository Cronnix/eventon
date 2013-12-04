<?php
/**
 * @author [Sebastian Westberg] <[sebastianostbrink@gmail.com]>
 */

namespace Classtration;

require_once('validation.php');
require_once('/../db/db.php');

class User
{
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

	private $db;

	function __construct() {
		$db = new Db;
		$this->db = $db->connect();
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public static function create($userData, $settings = array())
	{
		$user = new User;

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

		unset($user->db);
		// unset($user->hash);
		unset($user->validation);
		return $user;
	}

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

		while ($obj = $sth->fetch())
		{
			$result[] = (object)$obj;
		}
		return $result;
	}

	private function save()
	{
		$db = $this->db;
		try
		{
			$sth = $db->prepare("INSERT INTO tbl_user (user_firstname, user_lastname, user_email, user_phonenumber, user_username, user_password, usertype_id) value (?, ?, ?, ?, ?, ?, ?)");
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
		$this->id = $db->lastInsertId();
	}

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

			if (is_array($userData['password'])) 
			{
				$validate->password($userData['password']);
			}
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

	public static function createUsername($fname = null, $lname = null)
	{
		if ($fname && $lname)
		{
			return ucfirst(substr($fname, 0, 3)).ucfirst(substr($lname, 0, 3)).self::generateNumber(1000, 9999);
		}
	}

	protected function generateHash($password)
	{
		require_once('/../external/bcrypt.php');
		return \Bcrypt::hash($password);
	}

	public static function generateNumber($min, $max)
	{
		return rand($min, $max);
	}

	public static function generateString($length)
	{
		return substr(md5(rand()), 0, $length);
	}
}

?>
