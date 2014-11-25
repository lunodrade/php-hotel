<?php
require_once 'usuario.php';
require_once 'autenticador.php';
require_once 'sessao.php';



switch($_REQUEST['acao']) {

    case 'logar': {
        
        # Uso do singleton para instanciar
        # apenas um objeto de autenticação
        # e esconder a classe real de autenticação
        $aut = Autenticador::instanciar();
        
        # efetua o processo de autenticação
        if ($aut->logar($_REQUEST['email'], $_REQUEST['senha'])) {
            # redireciona o usuário para dentro do sistema
            //header('location: interno_usuario.php');
            
			if(isset($_SESSION['uri']) and !empty($_SESSION['uri'])) {
                header('location: ' . $_SESSION['uri'] . '');
            } else {
                header('location: ../index.php');
            }
        }
        else {
            # envia o usuário de volta para o form de login
            header('location: login.php');
        }
        
        
    } break;
    
    case 'sair': {
        
        # envia o usuário para fora do sistema
        # o form de login
        header('location: logout.php');
        
    } break;
    
}
