<?php
    include '../constantes.php'; 
    include 'sessao.php'; 

    $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $consulta = $pdo->prepare("SELECT DISTINCT c.cli_nome, u.usu_email, u.usu_senha
                              FROM tb_usuarios u
                              JOIN tb_clientes c ON c.pk_cli_cod = u.fk_cli_cod
                              WHERE u.pk_usu_cod = :usu_cod;");

    $consulta->bindValue(":usu_cod", $_GET['user']);

    $consulta->execute();
        
    if($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        echo $linha['cli_nome'];

        $usuario = $linha['cli_nome'];
        $destinatario = $linha['usu_email'];
        
        $sess = Sessao::instanciar();
        $sess->set('email', $linha['usu_email']);
        $sess->set('senha', $linha['usu_senha']);

    } else {
        echo "morreu";
        die();
    }

    $hash = md5(uniqid(time()));;

    $link_hash = URL . "/auth/confirm_email.php?hash=";
    $link_hash .= $hash;

    $query = $pdo->prepare("UPDATE tb_usuarios
                            SET usu_hash = :hash
                            WHERE pk_usu_cod = :usu_cod;");

    $query->bindValue(":hash", $hash);
    $query->bindValue(":usu_cod", $_GET['user']);

    if($query->execute()) {

    } else {
        echo "morreu";
        die();
    }

    include '../templates/email_confirmation.php';

    $assunto = "Confirmação de email";
    $email = $emailTemplate;

    $headers =  "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: <hotel@lucianoandrade.me>" . "\r\n";

    if(mail($destinatario, $assunto, $email, $headers))
        echo "\nOk! \n";
    else
        echo "\nErro! \n";
    

    //redireciona para pagina de login apos finalizar cadastro e enviar pedido de confirmação de email
    //header("Location: ". URL . '/auth/login.php?redirect=true');


    header('location: unconfirmed_email.php');
    die();
    
?>
