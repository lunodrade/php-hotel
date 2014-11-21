<?php  include '../_header.php';  ?>

<?php
function printValue() {
    $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
        
    $rooms = implode(", ", $_GET['room']);
    
    $sql = "SELECT DISTINCT sum(t.tip_val) AS value
            FROM tb_quartos q
            INNER JOIN tb_tipos t ON q.fk_tip_cod = t.pk_tip_cod
            WHERE q.pk_qua_num IN ($rooms)
            ;";

    $stm = $pdo->query($sql);

    $dados = $stm->fetch(PDO::FETCH_ASSOC);
    echo $dados['value'];
}
?>
    
    <style type="text/css">
        h2 {
            margin: 1% 0 1% 0;
        }
    </style>
		
		


<div class="inner cover">
  
  
  
  
  
  
  
   
    <h1>Você selecionou o(s) seguinte(s) quarto(s)</h1><br>
    <?php
    foreach($_GET['room'] as $room) {
        echo '<h2>' . $room . '</h2>';
    }
    ?>
    
    
    <h1>Resultando no valor de R$ <?php printValue(); ?></h1><br>
    
    
    
    
    
    
    
    
</div>

<?php  include '../_footer.php';  ?>