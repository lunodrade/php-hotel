<?php 
//session_start();
//session_destroy(); 
?>

<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h1>Testes de segurança</h1>
    <p>Tente acessar uma <a href="../auth/interno_usuario.php">p&aacute;gina de usu&aacute;rio</a></p>
    <p>Tente acessar uma <a href="../auth/interno_admin.php">p&aacute;gina de administrador</a></p>

    <br>

    <form action="../auth/controle.php" method="post" target="_self">
        <label for="email">E-mail</label><br>
        <input type="text" id="email" name="email" value="">
        <br>

        <label for="senha">Senha</label><br>
        <input type="password" id="senha" name="senha" value="">
        <br>

        <button type="submit" id="acao" name="acao" value="logar">Entrar</button>
    </form>
</body>
</html>
