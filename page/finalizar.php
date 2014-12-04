<?php  include '../_header.php';  

    $sess = Sessao::instanciar();

    $arr = [];
    $count = count($_GET["room"]);
    for ($i = 0; $i < $count; $i++) {
        $arr[$i] = [$_GET["room"][$i], $_GET["values"][$i]];
    }

    $arr[$count]     = $_GET["checkIn"];
    $arr[$count + 1] = $_GET["checkOut"];

    $sess->set('data', json_encode($arr));

?>

<?php
function printValue() {    
    //Conectar no banco
    $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    //Pega o id dos quartos, e cria tantos ? bindValues para serem substituídos depois
    $ids = $_GET['room'];
    $rooms = implode(',', array_fill(0, count($ids), '?'));
    
    //Prepara o query, usando :values
    $consulta = $pdo->prepare("SELECT DISTINCT sum(t.tip_val) AS value
                               FROM tb_quartos q
                               INNER JOIN tb_tipos t ON q.fk_tip_cod = t.pk_tip_cod
                               WHERE q.pk_qua_num IN (" . $rooms . ");");

    //Troca os :symbol pelos valores que irão executar
    //Ao mesmo tempo protege esses valores de injection
    //bindvalue é 1-indexed, então $k+1
    foreach ($ids as $k => $id)
        $consulta->bindValue(($k+1), $id);
    
    //Executa o sql
    $consulta->execute();

    if ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        //Trabalhar com os resultados
        echo($linha['value']);
    } else {
        echo "erro";
        die();
    }
    
}
?>
    
    <style type="text/css">
        h2 {
            margin: 1% 0 1% 0;
        }
        .buttonGroup {
            text-align: right;
        }
        .buttonGroup > a {
            margin: 5px;
        }
    </style>
		
		


<div class="inner cover">
  
  
  
  
  
  
  
   
    <h2>Você selecionou o(s) seguinte(s) quarto(s)</h2><br>
    <?php
    foreach($_GET['room'] as $room) {
        echo '<h3>' . $room . '</h3>';
    }
    ?>
        
    <br><h1>Resultando no valor de R$ <?php printValue(); ?></h1><br><br>
    
    <div class="buttonGroup">
        <a type="button" class="btn btn-large btn-default" onclick="history.go(-1);return true;">Voltar</a>
        <a type="button" class="btn btn-large btn-primary" href="pagamento.php">Finalizar e reservar</a>
    </div>
    
    
    
    
    
</div>

<?php  include '../_footer.php';  ?>