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
<html>
<head>
    <title>Seu projeto!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">    
</head>
<body>
    
	<div class="container">
   
        <h3>Ir para a <a href='<?php echo URL ?>/'>home</a></h3><br><br>
    
		<h2>Olá, <strong>
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
        ?>
		</strong>		
		</h2>
       
		<?php 
            if($usuario != null) {
                if($usuario->getCliente() > 0) {
        ?>
                    Acessar <a href='<?php echo URL ?>/user/index.php'>meu perfil</a><br>
		<?php 
                }
            }
        ?>
		
		<?php if($usuario == null) { ?>	
		        <a href='<?php echo URL ?>/auth/login.php'>logar</a>
		<?php } else { ?>
		        <a href='<?php echo URL ?>/auth/logout.php'>Sair</a>
        <?php } ?>	
		<br><br><br><br>