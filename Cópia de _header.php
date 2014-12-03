<?php 
include 'constantes.php'; 

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
<html lang="en">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo URL ?>/favicon.ico">
    
    <script type="text/javascript" src="<?php echo ASSETS ?>/js/jquery.min.js"></script>

    <title>Hotel</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo ASSETS ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo ASSETS ?>/css/cover.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo ASSETS ?>/js/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    

    <style type="text/css">
        .site-wrapper {
        <?php 
        if(preg_match("/^\/".ROOT."\/index.php$|^\/".ROOT."\/$/", $_SERVER['REQUEST_URI'])) {
        ?>
            background-image: url("<?php echo ASSETS ?>/img/background.jpg");
            background-size: cover;
        <?php
        } else {
        ?>
            background: url("<?php echo ASSETS ?>/img/pattern.png");
        <?php
        }
        ?>
        }
        .goLoginBtn {
            font-size: 0.5em;
        }
        
        .masthead, .mastfoot {
            position: static;
        }
        
        .masthead {
            margin-bottom: 100px;
        }
        
        .mastfoot {
            margin-top: 100px;
        }
    </style>
    
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">
                  Ol&aacute;, 
                    <?php 
                        if($usuario != null) {
                            if($usuario->getCliente() > 0) {
                                $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
                                $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                                //Prepara o query, usando :values
                                $consulta = $pdo->prepare("SELECT cli_nome 
                                                           FROM tb_clientes
                                                           WHERE pk_cli_cod = :cli_cod;");

                                //Troca os :symbol pelos valores que irão executar
                                //Ao mesmo tempo protege esses valores de injection
                                $consulta->bindValue(":cli_cod", $usuario->getCliente());

                                //Executa o sql
                                $consulta->execute();

                                if ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                    echo($linha['cli_nome']);
                                }
                            } else {
                                echo('Administrador');
                            }
                        } else {
                            echo('Convidado');
                        }
                        if($usuario != null) {
                    ?>
                            <span class="goLoginBtn">(<a href="<?php echo URL ?>/auth/logout.php">sair</a>)</span>
                    <?php } else { ?>
                            <span class="goLoginBtn">(<a href="<?php echo URL ?>/auth/login.php">logar</a>)</span>
                    <?php } ?>
              </h3>
              <nav>
                <ul class="nav masthead-nav">
                    <li 
                    <?php 
                    if(preg_match("/^\/".ROOT."\/index.php$|^\/".ROOT."\/$/", $_SERVER['REQUEST_URI'])) {
                        echo 'class="active"';
                    }
                    ?>
                    ><a href="<?php echo URL ?>/">Inicio</a></li>
                    <?php
                    if($usuario != null) {
                        if($usuario->getCliente() > 0) {
                    ?>
                            <li 
                            <?php 
                            if(preg_match("/^\/".ROOT."\/user\/index.php$|^\/".ROOT."\/user\/$/", $_SERVER['REQUEST_URI'])) {
                                echo 'class="active"';
                            }
                            ?>
                            ><a href="<?php echo URL ?>/user">Perfil</a></li>
                    <?php 
                        } else {
                    ?>
                            <li
                            <?php 
                            if(preg_match("/^\/".ROOT."\/admin\/index.php$|^\/".ROOT."\/admin\/$/", $_SERVER['REQUEST_URI'])) {
                                echo 'class="active"';
                            }
                            ?>
                            ><a href="<?php echo URL ?>/admin">Admin</a></li>
                    <?php 
                        }
                    } 
                    ?>
                </ul>
              </nav>
            </div>
          </div>