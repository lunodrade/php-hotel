<?php
    
	if(!isset($_SESSION)){
	    session_start();
	}
	
	if (!defined('DS'))  define('DS', '/');
	
	if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
		if (!defined('URL')) define('URL', 'http://127.0.0.1/php-hotel');
		if (!defined('DEBUG'))  define('DEBUG', TRUE);
		
		if (!defined('DBHOST'))  define('DBHOST', 'localhost');
		if (!defined('DBUSER'))  define('DBUSER', 'root');
		if (!defined('DBPASS'))  define('DBPASS', '');
		if (!defined('DBNAME'))  define('DBNAME', 'projectCake');
		
	} else {
		if (!defined('URL')) define('URL', 'http://labs.lucianoandrade.me/hotel');
		if (!defined('DEBUG'))  define('DEBUG', FALSE);

		if (!defined('DBHOST'))  define('DBHOST', 'mysql.hostinger.com.br');
		if (!defined('DBUSER'))  define('DBUSER', 'u966508396_adm');
		if (!defined('DBPASS'))  define('DBPASS', '8mez?X[c&bj|?n');
		if (!defined('DBNAME'))  define('DBNAME', 'u966508396_hotel');
	}
	
?>