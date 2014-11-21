<?php 
require_once 'usuario.php';
require_once 'sessao.php';
require_once 'autenticador.php';

$aut = Autenticador::instanciar();

$usuario = null;
if ($aut->esta_logado()) {
    $usuario = $aut->pegar_usuario();
}
else {
    $sess = Sessao::instanciar();
    $sess->set('uri', $_SERVER['REQUEST_URI']);
    
    header('Location: '.URL.'/auth/login.php?redirect=true');
}
?>