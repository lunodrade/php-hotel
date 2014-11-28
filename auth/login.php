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

//Testa se há a chave "redirect" na url; se houver, não gravar o redirecionamento
if(isset($_REQUEST['redirect']) and !empty($_REQUEST['redirect']))
    $set_redirect = false;

//Testa de que página está vindo, algumas não gravam o redirecionamento
if(isset($_SERVER['HTTP_REFERER'])) {
    if(preg_match("/^.*auth\/login.php$/", $_SERVER['HTTP_REFERER']))
        $set_redirect = false;

    if(preg_match("/^.*auth\/login.php\?redirect\=true$/", $_SERVER['HTTP_REFERER']))
        $set_redirect = false;
    
    if(preg_match("/^.*auth\/unconfirmed_email.php$/", $_SERVER['HTTP_REFERER']))
        $set_redirect = false;
    
    if(preg_match("/^.*auth\/signup.php$/", $_SERVER['HTTP_REFERER']))
        $set_redirect = false;
    
    
} else {
    $set_redirect = false;
}

//Gravar a página que estava antes do login, pois após logar irá ser redirecionado de volta para lá
if($set_redirect) {
    $sess = Sessao::instanciar();
    $sess->set('uri', $_SERVER['HTTP_REFERER']);
}
?>

<?php  include '../_header.php';  ?>

<link href="../assets/css/auth.css" rel="stylesheet">



<div class="inner cover">
   
   
   
   
   
   
   
   
   
   
   
   
   
    <h1>Faça o seu login</h1>

      <form action="controle.php" method="post" class="form-signin" role="form">
        <label for="inputEmail" class="sr-only">Email</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Endereço de email" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input name="senha" type="password" id="inputPassword" class="form-control" placeholder="Senha" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Lembrar-me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="acao" value="logar">Logar</button>
      </form>

    <br><br>
    <a href="signup.php">Ainda n&atilde;o &eacute; cadastrado?</a>













</div>
    
    
    <script type="text/javascript">
    	jQuery(document).ready(function($) {
            
            
            
            
            
            
//    		$('.btnCheck').click(function(){
//    			makeAjaxRequest();
//    		});
//
//            $('#email').submit(function(e){
//                e.preventDefault();
//                makeAjaxRequest();
//                return false;
//            });
//
//            function makeAjaxRequest() {
//                $.ajax({
//                    url: '../ajax/checkAvailability.php',
//                    type: 'get',
//                    data: {email: $('input#checkEmail').val()},
//                    success: function(response) {
//                        $('#avaibleResult').html(response);
//                    }
//                });
//            }
            
            
            
            
            
            
            
    	});
    </script>

<?php  include '../_footer.php';  ?>
