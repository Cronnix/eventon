<?php
/**
 * @author [Sebastian Westberg] <[sebastianostbrink@gmail.com]>
 */

namespace Classtration\util;

use util;


class UserValidation
{
	protected $validation = array(
		'min_uppers' => 0,
		'min_digits' => 0,
		'min_chars' => 6,
		'min_specials' => 1,
		'specials_regex' => "/[\@\£\$\€\&\-\_\.\,\<\>\|\{\[\]\}\\\+\?\*\^\~]/i",
	);

	function __construct($settings = array())
	{
		$this->validation = array_merge($this->validation, $settings);
	}

	public function name($name)
	{
		if ( ! strlen($name))
		{
			throw new \Exception("The property \"Name\" cannot hold an empty string.");
		}
		else 
		{
			return ucfirst($name);
		}
	}

	public function ssn($ssn)
	{	
		if (strlen($ssn) !== 12)
		{
			throw new \Exception("The property \"Ssn\" has to contain exactly 12 characters (ååååmmddxxxx).");
		}
		else 
		{
			return $ssn;
		}
	}

	public function email($email)
	{
		if ( ! strlen($email)) {
			throw new \Exception("The property \"Email\" cannot hold an empty string.");
		}
		elseif ( ! filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			throw new \Exception("The property \"Email\" does not contain a valid e-mail.");
		}
		else
		{
			return $email;
		}
	}

	public function phone($phone)
	{
		if ( ! strlen($phone))
		{
			throw new \Exception("The property \"Phone\" cannot hold an empty string.");
		}
		else
		{
			return $phone;
		}
	}

	public function type($type)
	{
		if ( !is_numeric($type))
		{
			throw new \Exception("The property \"Type\" must have a numeric value.");
		}
		else
		{
			return $type;
		}
	}

	public function password($password)
	{
		$uppers = 0;
		$digits = 0;
		$specials = 0;

		if ($password[0] === $password[1])
		{
			$password = $password[0];
			if (strlen($password) >= $this->validation["min_chars"])
			{
				$specials = preg_match_all($this->validation["specials_regex"], $password);
				if ($specials >= $this->min_specials)
				{
					foreach (str_split($password, 1) as $char)
					{
						$uppers += (ctype_upper($char) ? 1 : 0);
						$digits += (ctype_digit($char) ? 1 : 0);
					}
				}
				else
				{
					throw new \Exception("A password must contain at least {$this->validation["min_specials"]} special character(s) which follows the pattern \"{$this->specials_regex}\".");
				}

				if ($uppers < $this->validation["min_uppers"])
				{
					throw new \Exception("A password must contain at least {$this->validation["min_uppers"]} uppercase character(s).");
				}
				else 
				{
					if ($digits < $this->validation["min_digits"])
					{
						throw new \Exception("A password must contain at least {$this->validation["min_digits"]} digit(s)");
					}
					else
					{
						return $password;
					}
				}
				return false;
			}
			else
			{
				throw new \Exception("A password must contain at least {$this->validation["min_chars"]} characters.");
			}
		}
		else 
		{
			throw new \Exception("Passwords provided do not match.");
		}
	}


}