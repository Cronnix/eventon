<?php

namespace Classtration;

class Db 
{
	private $host = 'localhost';
	private $dbname = 'wukwebbi_grupp3_2';
	private $user = 'root';
	private $password = '';

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