<?php

require_once 'constantes.php';

class ConfigController
{	
	/*public $host  	 = 'localhost';
	public $user  	 = 'root';
	public $password = '';
	public $database = 'projectCake';*/
	public $conn;

	function __construct()
	{
        //$_SESSION = array();

		try 
		{	 
            //$conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
            $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->conn = $conn;
        } 
        catch (PDOException $e) 
        {	
            echo $e->getMessage();
        }
	}
}

?>