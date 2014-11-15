<?php include 'constantes.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel - projectCake</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
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