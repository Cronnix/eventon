<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

namespace Classtration;

// Base methods for the User class
require_once('crud.php');
// Validation class to validate user data input
require_once('validation.php');
// Db class
require_once('/../db/db.php');

/**
 * Base class for users with a magic __get method to read
 * private/protected properties from the object. Supports
 * user creation, read and save.
 * 
 * TODO: implement the full CRUD (missing update, delete
 * and better reading support)
 */
class User extends User_Crud
{
	// Global instance of the Db handle (within the class scope)
	protected $db;

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

}

?>
