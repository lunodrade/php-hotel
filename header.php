<?php include 'constantes.php'; 

require_once 'auth/usuario.php';
require_once 'auth/sessao.php';
require_once 'auth/autenticador.php';

$aut = Autenticador::instanciar();

$usuario = null;
if ($aut->esta_logado()) {
    $usuario = $aut->pegar_usuario();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Seu projeto!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">    
</head>
<body>