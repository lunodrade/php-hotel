
<?php 

if (!defined('__ROOT__'))  define('__ROOT__', dirname(dirname(__FILE__)));

if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
	require_once __ROOT__ . '\constantes.php';
	require_once __ROOT__ . '\auth\usuario.php';
	require_once __ROOT__ . '\auth\sessao.php';
	require_once __ROOT__ . '\auth\autenticador.php';
} else {
	require_once __ROOT__ . '/constantes.php';
	require_once __ROOT__ . '/auth/usuario.php';
	require_once __ROOT__ . '/auth/sessao.php';
	require_once __ROOT__ . '/auth/autenticador.php';
}

$aut = Autenticador::instanciar();

$usuario = null;
if ($aut->esta_logado()) {
    $usuario = $aut->pegar_usuario();
}

if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
	require_once __ROOT__ . '\auth\perm_admin.php';
} else {
	require_once __ROOT__ . '/auth/perm_admin.php';
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Seu projeto!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo URL ?>/favicon.ico">
    
    <script type="text/javascript" src="<?php echo ASSETS ?>/js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href='<?php echo URL; ?>/assets/css/jquery.dataTables.css'>
    <link rel="stylesheet" href='<?php echo URL; ?>/assets/css/dataTables.bootstrap.css'>
    <link rel="stylesheet" href='<?php echo URL; ?>/assets/css/dataTables.tableTools.css'>
    <script type="text/javascript" src='<?php echo URL; ?>/assets/js/jquery.dataTables.min.js'></script>
    <script type="text/javascript" src='<?php echo URL; ?>/assets/js/dataTables.bootstrap.js'></script>
    <script type="text/javascript" src='<?php echo URL; ?>/assets/js/dataTables.tableTools.js'></script>

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
        
        .btn-group {
            padding: 50px 0px 20px 0px;
        }
        
        @media (min-width: 827px) {
            .btn-group {
                margin-left: -12%;
            }
        }
        .container-menu > .btn {
            border: 2px solid rgba(25, 25, 25, .6);
            box-shadow: 0px 5px 20px 0px rgba(25, 25, 25, 0.60);
            background-color: rgba(25, 25, 25, 0.60);
        }
        
        table.dataTable thead tr {
          background-color: rgba(20,20,20,.5);
        }
        table.dataTable tbody tr {
          background-color: rgba(50,50,50,.5);
        }
        .table-striped>tbody>tr:nth-child(odd) {
background-color: rgba(50,50,50,.5);
}
        .table-hover>tbody>tr:hover {
            background-color: rgba(100,100,100,.5);
            }
        
        td:nth-child(6) {
            width: 100px !important;
            color: red;
        }
        
table {
    border-collapse: collapse !important;
}

table, td, th {
    border: 1px solid dimgray !important;
}
        
        .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
color: white;
}
        
        @media (min-width: 992px) {
            .masthead, .mastfoot, .cover-container {
                width: 875px;
            }
            td:nth-child(6) {
                width: 100px !important;
            }
        }
        @media (min-width: 1600px) {
            .masthead, .mastfoot, .cover-container {
                width: 1430px;
                margin-top: 0;
            }
            td:nth-child(6) {
                width: 100px !important;
            }
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
                                $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
                                $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                                $sql = "select cli_nome 
                                       from tb_clientes
                                       where pk_cli_cod = {$usuario->getCliente()};";

                                $stm = $conn->query($sql);

                                if ($stm->rowCount() > 0) {
                                    $dados = $stm->fetch(PDO::FETCH_ASSOC);
                                    echo($dados['cli_nome']);
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
<!--          </div>-->
	
	
	
	
	
	
	
	
	
	
	
	
	
            <div class="btn-group container-menu">
                <div class='btn btn-default'><a href="<?php echo URL; ?>/admin/">HOME</a></div>
                <div class='btn btn-default'><a href='<?php  echo URL;  ?>/admin/tb_clientes/'>Tb Clientes</a></div>
                <div class='btn btn-default'><a href='<?php  echo URL;  ?>/admin/tb_quartos/'>Tb Quartos</a></div>
                <div class='btn btn-default'><a href='<?php  echo URL;  ?>/admin/tb_reservas/'>Tb Reservas</a></div>
                <div class='btn btn-default'><a href='<?php  echo URL;  ?>/admin/tb_tipos/'>Tb Tipos</a></div>
                <div class='btn btn-default'><a href='<?php  echo URL;  ?>/admin/tb_usuarios/'>Tb Usuarios</a></div>

            </div>

		<div style="padding:20px 0px 0px 0px;">
			<?php if (isset($_SESSION['sucess'])) { ?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo $_SESSION['sucess']; ?>
				</div>
			<?php } ?>

			<?php if (isset($_SESSION['error'])) { ?>
				<div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo $_SESSION['error']; ?>
				</div>
			<?php } ?>

		</div>
		
	