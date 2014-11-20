<?php  	
    include '../cabecalho.php' ;
    include '../per_user.php';
    include 'controle.php';
?>

   <h1>Histórico de Reservas</h1>
<!--
   
 <form action="consulta.php" >
            <table class="table">
               <tr>
                   <td>usuario:</td>
                   <td><input class="form-control" type="text" name="usuario"><br></td>
               </tr>
              <tr>
                    <td>    <button class="btn btn-primary" type="submit"> consulta </button></td>
                </tr>                
                
            </table>
-->
    <?php
     if($usuario != null) {     
        $pkuser = $usuario->getId();
        $loguser = pegaPkuser($pkuser);
         gerahistorico($loguser);
     }
?>
      
      

      

        
    </body>
</html>



















































<?php  include '../rodape.php'; ?>
