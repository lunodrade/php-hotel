<?php
    
	if(!isset($_SESSION)){
	    session_start();
	}
	
	if (!defined('URL')) define('URL', 'http://labs.lucianoandrade.me/hotel');
	if (!defined('DS'))  define('DS', '/');

	if (!defined('DEBUG'))  define('DEBUG', FALSE);

?>
