<?php  include '../_header.php';  
        
        //include '../per_user.php';
        include 'controle.php';

        if (!defined('__ROOT__'))  define('__ROOT__', dirname(dirname(__FILE__)));

        if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
            include_once __ROOT__ . '\constantes.php';
        } else {
            include_once __ROOT__ . '/constantes.php';
        }

        if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
            include_once __ROOT__ . '\auth\perm_user.php';
        } else {
            require_once __ROOT__ . '/auth/perm_user.php';
        }
   


?>
 <h1>Perfil do cliente, com opções pessoais</h1>
 

<div class="inner cover">
   
   <?php
     if($usuario != null) {     
        $pkuser = $usuario->getId();
        $loguser = pegaPkuser($pkuser);
         gerahistorico($loguser);
     }
?>
      
   
   
   


</div>

<?php  include '../_footer.php';  ?>