<?php
   

   function gerahistorico($loguser){//parametro id do login
    $conn =  new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
    
    $sql = "SELECT res_in, res_out, res_val, fk_qua_num   FROM tb_reservas WHERE fk_cli_cod={$loguser}";
    
  
    $stm = $conn->query($sql);
    $rows = $stm->fetchAll(PDO::FETCH_ASSOC);     
        
?>
        <table class="table">
           <tr>
               <td>Data de entrada</td>
               <td>Data de saida</td>
               <td>Valor da reserva</td>
               <td>numero do quarto</td>
           </tr>
       <?php
       
       foreach($rows as $row){
          echo " 
           <tr>
                <td>{$row['res_in']}</td>
                <td>{$row['res_out']}</td>
                <td>{$row['res_val']}</td>
                <td>{$row['fk_qua_num']}</td>
           </tr>";
           
       }
           ?>
       </table>      
       
    <?php
       
       
      
       
   }

?>
