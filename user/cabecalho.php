<?php 
if (!defined('__ROOT__'))  define('__ROOT__', dirname(dirname(__FILE__)));

if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
	include_once __ROOT__ . '\constantes.php';
} else {
	include_once __ROOT__ . '/constantes.php';
}


?>
<html>
    <head>
        <meta charset="utf-8">
        
        <meta name="description" content="">
         <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="/cliente/css/bootstrap.css">
        <link rel="stylesheet" href="/cliente/css/loja.css">
         <title>Cliente</title>
    </head>
    <body>
      
        <div class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-heder">
                <a class="navbar-brand "href="">Cliente</a>
                </div>
                <br>
                <br>
                <div>
                    <ul class="nav navbar-nav">
                        <li><a href="../cadastro/index.php">cadastro</a></li>
                        <li><a href="../historico/index.php">Historico</a></li>
                        <li><a href='<?php echo URL ?>/auth/logout.php'>Sair</a></li>
                        
                    </ul>
                </div>
                
            </div>
            
            
            
        </div>  
      
       <div class="container">
           <div class="principal">