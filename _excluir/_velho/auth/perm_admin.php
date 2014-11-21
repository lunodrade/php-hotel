<?php 
require_once 'usuario.php';
require_once 'sessao.php';
require_once 'autenticador.php';

$aut = Autenticador::instanciar();

$usuario = null;
$admin = false;

if ($aut->esta_logado()) {
    $usuario = $aut->pegar_usuario();
    
    if($usuario->getTipo() == 'admin') {
        $admin = true;
    }
}

if($admin == false) {    
    header('Location: '.URL.'/index.php');
}
?>