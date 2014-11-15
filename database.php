<?php

require_once 'constantes.php';

class ConfigController
{	
	public $conn;

	function __construct()
	{
		try 
		{	
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