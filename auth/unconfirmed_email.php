<?php  include '../_header.php';  ?>

<?php 

$sess = Sessao::instanciar();
$email = $sess->get('email');
$senha = $sess->get('senha');

//Conectar no banco
$pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

//Prepara o query, usando :values
$consulta = $pdo->prepare("SELECT *
                           FROM tb_usuarios
                           WHERE usu_email = :email AND
                                 usu_senha = :senha;");

//Troca os :symbol pelos valores que irão executar
//Ao mesmo tempo protege esses valores de injection
$consulta->bindValue(":email", $email);
$consulta->bindValue(":senha", $senha);

//Executa o sql
$consulta->execute();

if($dados = $consulta->fetch(PDO::FETCH_ASSOC)) {

    if($dados['usu_conf'] == 1) {
        $usuario = new Usuario();
        $usuario->setId($dados['pk_usu_cod']);
        $usuario->setEmail($dados['usu_email']);
        $usuario->setSenha($dados['usu_senha']);
        $usuario->setTipo($dados['usu_tipo']);
        $usuario->setCliente($dados['fk_cli_cod']);

        $sess = Sessao::instanciar();
        $sess->set('usuario', $usuario);
        
        
        if(isset($_SESSION['uri']) and !empty($_SESSION['uri'])) {
            header('location: ' . $_SESSION['uri'] . '');
        } else {
            header('location: ../index.php');
        }
        
        
    } else {
        //deixar renderizar a página, pois depois ela vai recarregar e testar de novo
    }

} else {
    echo "<br><br><br>U&eacute;, o cadastro se perdeu? 
            Voc&ecirc; est&aacute; for&ccedil;ando o acesso a est&aacute; p&aacute;gina, n&eacute;? ;)";
    die();
}

?>

    <style type="text/css">
        .inner.cover {
            border: 2px solid rgba(25, 25, 25, .6);
            box-shadow: 0px 5px 20px 0px rgba(25, 25, 25, 0.60);
            padding: 12% 0 12% 0;
            background-color: rgba(100, 100, 100, 0.6);
        }
        .cover-heading {
            margin-bottom: 10%;
        }
        input, button {
            color: black;
        }
    </style>


<div class="inner cover">


   
   
   
    <h1 class="cover-heading">Seu email ainda n&atilde;o est&aacute; confirmado</h1>
    
    <h3>Por favor, confirme o seu cadastro, acessando o email que foi enviado para voc&ecirc;.</h3>
    <br>
    <p>Est&aacute; p&aacute;gina recarrega automaticamente a cada 5 segundos para checar se sua conta foi confirmada.
    Ent&atilde;o basta clica no link que h&aacute; no seu email, e est&aacute; p&aacute;gina lhe ir&aacute; enviar de volta
    para onde voc&ecirc; estava antes do login. Simples assim... :)</p>
    
    <br><br><input type="button" value="Reload Page" onClick="history.go(0)">
    
    <script type='text/javascript'>
        setTimeout(function(){ history.go(0); }, 5000);
    </script>
    
    
    


</div>
          
	<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">
        jQuery(document).ready(function($) {
            
        });
    </script>
          
          
<?php  include '../_footer.php';  ?>
