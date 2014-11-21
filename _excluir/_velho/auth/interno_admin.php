<?php 
require_once 'perm_admin.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina interna</title>
    </head>
    <body>
        <h1>Página interna do sistema (ADMIN)</h1>
        
        <?php 
        if($usuario->getTipo() == 'admin') {
        ?>
            <?php 
                if($usuario != null) {
            ?>
                    <p>Voc&ecirc;  est&aacute; logado como 
                        <strong><?php print $usuario->getNome(); ?></strong>.
                    </p>
                    <p>E tem permiss&otilde;es de
                        <strong><?php print $usuario->getTipo(); ?></strong>.
                    </p>
                    <?php 
                        if($usuario->getCliente() > 0) {
                    ?>    
                        <p>E &eacute; o cliente 
                                <strong><?php print $usuario->getCliente(); ?></strong>, 
                                <strong>
                        <?php
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
                        ?>
                                </strong>.
                        </p>
                    <?php 
                        }
                    ?>
            <?php 
                }
            ?>
        <?php 
        }
        else {
        ?>
            <p>Voc&ecirc; n&atilde;o tem direitos de administrador para acessar est&aacute; página.</p>
            <p><a href='javascript:history.go(-1)'>Voltar</a> para a p&aacute;gina anterior.</p>
        <?php 
        }
        ?>

        <p><a href="controle.php?acao=sair">Sair</a></p>
    </body>
</html>