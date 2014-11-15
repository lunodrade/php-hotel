<?php 
require_once 'usuario.php';
require_once 'sessao.php';
require_once 'autenticador.php';

//apagar?
if(!isset($_SESSION)){
    session_start();
}

$aut = Autenticador::instanciar();

$usuario = null;
if ($aut->esta_logado()) {
    $usuario = $aut->pegar_usuario();
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h1>Tela de login</h1>
    <form action="controle.php" method="post" target="_self">
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