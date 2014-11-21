<?php  include '../_header.php';  ?>
<?php

function getRoomList($checkIn, $checkOut) {
    $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
        
    $sql = "SELECT pk_qua_num
            FROM tb_quartos
            WHERE pk_qua_num NOT IN (
                SELECT DISTINCT fk_qua_num
                FROM tb_reservas r
                INNER JOIN tb_quartos q ON q.pk_qua_num = r.fk_qua_num
                WHERE q.qua_status = false
                    OR
                    NOT(
                        NOT('{$checkIn}' BETWEEN res_in AND res_out)
                        AND 
                        NOT('{$checkOut}' BETWEEN res_in AND res_out)
                        AND 
                        NOT( 
                            (res_in BETWEEN date('{$checkIn}') AND date('{$checkOut}'))
                            AND 
                            (res_out   BETWEEN date('{$checkIn}') AND date('{$checkOut}')) 
                        )
                    )
                )
            ORDER BY pk_qua_num ASC
            ;";

    $stm = $pdo->query($sql);

    if ($stm->rowCount() > 0) {

        $dados = $stm->fetchAll(PDO::FETCH_ASSOC);

        //echo $dados[1]['pk_qua_num'];
        return $dados;

    }
    else {
        return false;
    }
}

?>

    <h1>Mostrar os quartos disponiveis, a pessoa escola e vai pra tela de confirmação</h1>
    <h2>
        Check in: <?php echo $_GET['checkIn'] ?><br>
        Check in: <?php echo $_GET['checkOut'] ?><br>
    </h2>
    
    <?php
    $in = preg_replace("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", "$3-$2-$1 13:00:00", $_GET['checkIn']);
    $out = preg_replace("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", "$3-$2-$1 12:00:00", $_GET['checkOut']);
    $rooms = getRoomList(date($in), date($out));
    if($rooms != false) {
        foreach($rooms as $room) {
            echo $room['pk_qua_num'] . '<br>';
        }
    }
    ?>
<br><br>
    <a href="finalizar.php">Finalizar</a><br><br><br><br><br><br>

<?php  include '../_footer.php';  ?>