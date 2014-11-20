<?php  	include '../cabecalho.php' ;?>

   <h1>Histórico de Reservas</h1>
   
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

<?php  include '../rodape.php'; ?>