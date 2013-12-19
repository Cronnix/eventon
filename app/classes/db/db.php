<?php
/**
 * @author Sebastian Westberg <sebastianostbrink@gmail.com>
 */

namespace Classtration;

class Db 
{
	private $host = 'sql4.freemysqlhosting.net';
	private $dbname = 'sql425233';
	private $user = 'sql425233';
	private $password = 'tC7!qD6*';

	public function connect()
	{
		try {
			$pdo = new \PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->user, $this->password);
		}  
		catch(\PDOException $e) {  
		    die($e->getMessage());
		}
		return $pdo;
	}
}