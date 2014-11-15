<?php
    
	if(!isset($_SESSION)){
	    session_start();
	}
	
	if (!defined('URL')) define('URL', 'http://127.0.0.1/projects/projectCake');
	if (!defined('DS'))  define('DS', '/');

	if (!defined('DEBUG'))  define('DEBUG', TRUE);

?>
