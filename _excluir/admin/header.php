<?php

if (!defined('__ROOT__'))  define('__ROOT__', dirname(dirname(__FILE__)));

if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
	include_once __ROOT__ . '\constantes.php';
} else {
	include_once __ROOT__ . '/constantes.php';
}

if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
	include_once __ROOT__ . '\auth\perm_admin.php';
} else {
	require_once __ROOT__ . '/auth/perm_admin.php';
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Seu projeto!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" href='<?php echo URL; ?>/assets/css/jquery.dataTables.css'>
    <link rel="stylesheet" href='<?php echo URL; ?>/assets/css/dataTables.bootstrap.css'>
    <link rel="stylesheet" href='<?php echo URL; ?>/assets/css/dataTables.tableTools.css'>
    <script type="text/javascript" src='<?php echo URL; ?>/assets/js/jquery.dataTables.min.js'></script>
    <script type="text/javascript" src='<?php echo URL; ?>/assets/js/dataTables.bootstrap.js'></script>
    <script type="text/javascript" src='<?php echo URL; ?>/assets/js/dataTables.tableTools.js'></script>
    
</head>
<body>
	<div class="container">
		<div style="padding:20px 0px 20px 0px;" class="btn-group">
			<div class='btn btn-default'><a href="<?php echo URL; ?>">HOME</a></div>
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