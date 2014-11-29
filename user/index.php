<?php  
include '../_header.php';  
        
if (!defined('__ROOT__'))
    define('__ROOT__', dirname(dirname(__FILE__)));

if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
    include_once __ROOT__ . '\constantes.php';
    include_once __ROOT__ . '\auth\perm_user.php';
} else {
    include_once __ROOT__ . '/constantes.php';
    require_once __ROOT__ . '/auth/perm_user.php';
}
?>

 
<div class="inner cover">
    <h1>Reservas</h1><br>
   
    <table class="table">
        <tr>
            <td>Data de entrada</td>
            <td>Data de saida</td>
            <td>Valor da reserva</td>
            <td>numero do quarto</td>
        </tr>

        <?php
        if($usuario != null) {
            if($usuario->getCliente() > 0) {                
                //Conectar no banco
                $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
                $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                //Prepara o query, usando :values
                $consulta = $pdo->prepare("SELECT res_in, res_out, res_val, fk_qua_num 
                                           FROM tb_reservas 
                                           WHERE fk_cli_cod = :cli_cod");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $consulta->bindValue(":cli_cod", $usuario->getCliente());

                //Executa o sql
                $consulta->execute();

                //pega todas as linhas retornadas pelo SELECT
                if ($linhas = $consulta->fetchAll(PDO::FETCH_ASSOC)) {
                    //Trabalhar com os resultados
                    foreach($linhas as $linha){
                        echo "<tr>
                                  <td>{$linha['res_in']}</td>
                                  <td>{$linha['res_out']}</td>
                                  <td>{$linha['res_val']}</td>
                                  <td>{$linha['fk_qua_num']}</td>
                              </tr>";
                    }
                } else {
                    echo "erro";
                    die();
                }
            }
        }
        ?>
    </table>    
   
</div>

<?php  include '../_footer.php';  ?>