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

$set_redirect = true;

if(isset($_REQUEST['redirect']) and !empty($_REQUEST['redirect']))
    $set_redirect = false;

if(preg_match("/^.*auth\/login.php$/", $_SERVER['HTTP_REFERER']))
    $set_redirect = false;

if(preg_match("/^.*auth\/login.php\?redirect\=true$/", $_SERVER['HTTP_REFERER']))
    $set_redirect = false;


if($set_redirect) {
    $sess = Sessao::instanciar();
    $sess->set('uri', $_SERVER['HTTP_REFERER']);
}
?>

<?php  include '../_header.php';  ?>
    
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
    
    
    <br><br><br><br><br><br><br><br>
    <h1>Cadastrar usuário</h1>
    <form id="email" method="get">   
        <label for="checkEmail">Email</label>
        <input id="checkEmail" name="checkEmail" placeholder="Digite o email" />
        <button class="btnCheck">Verificar disponibilidade</button>   
    </form>
    <div id="avaibleResult" style="
            width: 300px;
            height: 50px;
            background-color: lightgray;
            padding: 15px 0 10px 30px;
    "></div>	
    <script type="text/javascript">
    	jQuery(document).ready(function($) {
    		$('.btnCheck').click(function(){
    			makeAjaxRequest();
    		});

            $('#email').submit(function(e){
                e.preventDefault();
                makeAjaxRequest();
                return false;
            });

            function makeAjaxRequest() {
                $.ajax({
                    url: '../ajax/checkAvailability.php',
                    type: 'get',
                    data: {email: $('input#checkEmail').val()},
                    success: function(response) {
                        $('#avaibleResult').html(response);
                    }
                });
            }
    	});
    </script>

<?php  include '../_footer.php';  ?>