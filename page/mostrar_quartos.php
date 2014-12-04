<?php  
include '../_header.php'; 

function getRoomList($checkIn, $checkOut) {
    //Conectar no banco
    $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    //Prepara o query, usando :values
    $consulta = $pdo->prepare("SELECT q.pk_qua_num, t.tip_val, t.tip_desc
                               FROM tb_quartos q
                               INNER JOIN tb_tipos t ON q.fk_tip_cod = t.pk_tip_cod
                               WHERE pk_qua_num NOT IN (
                                   SELECT DISTINCT fk_qua_num
                                   FROM tb_reservas r
                                   INNER JOIN tb_quartos q ON q.pk_qua_num = r.fk_qua_num
                                   WHERE q.qua_status = false
                                       OR
                                       NOT(
                                           NOT(:checkIn BETWEEN res_in AND res_out)
                                           AND 
                                           NOT(:checkOut BETWEEN res_in AND res_out)
                                           AND 
                                           NOT( 
                                               (res_in BETWEEN date(:checkIn) AND date(:checkOut))
                                               AND 
                                               (res_out BETWEEN date(:checkIn) AND date(:checkOut)) 
                                           )
                                       )
                                   )
                               ORDER BY pk_qua_num ASC
                               ;");

    //Troca os :symbol pelos valores que irão executar
    //Ao mesmo tempo protege esses valores de injection
    $consulta->bindValue(":checkIn", $checkIn);
    $consulta->bindValue(":checkOut", $checkOut);

    //Executa o sql
    $consulta->execute();

    if ($linhas = $consulta->fetchAll(PDO::FETCH_ASSOC)) {
        //Trabalhar com os resultados
        return $linhas;
    } else {
        echo "erro";
        return false;
    }
}
?>




<style type="text/css">
    .fullheight-container {
        height: 60vh;
        padding: 5%;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    @media (max-height: 480px) {
        .fullheight-container {
            height: 24vh;
        }
        .col-xs-6.description-room {
            font-size: 0.7em;
        }
    }
    
    @media (max-height: 667px) {
        .fullheight-container {
            height: 43vh;
        }
        .col-xs-6.description-room {
            font-size: 0.8em;
        }
    }
    
    .outerFullBox {
        margin: 5% 0 5% 0;
    }
    button.outerFullBox {
        width: 25%;
        height: 3em;
    }
    h1 {
        font-size: 1.8em;
    }
    input, button {
        color: black;
    }
    .description-room, .image-room {
        padding: 2%;
    }
    .checkbox-room {
        margin-top: 5em;
    }
    #sendRooms {
        display: none;
    }
    
    input[type=radio], input[type=checkbox] {
        width: 36px;
        height: 36px;
    }
    
    
</style>




<div class="inner cover">

    <h1 class="cover-hex2binading outerFullBox">Selecione o(s) quarto(s)</h1>
    <!--<div class="fullheight-container">-->

    <div class="rooms">
        <form id="quartos" action="finalizar.php" method="get">
            <?php
                $in = preg_replace("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", "$3-$2-$1 13:00:00", $_GET['checkIn']);
                $out = preg_replace("/([0-9]{2})\/([0-9]{2})\/([0-9]{4})/", "$3-$2-$1 12:00:00", $_GET['checkOut']);
                $rooms = getRoomList(date($in), date($out));
                if($rooms != false) {
                    foreach($rooms as $room) {
                ?>
                <div class="row" style="border-bottom: 1px solid gray;">
                    <div class="col-xs-4 image-room">
                        <img src="../assets/img/room-101.jpg" width="100%">
                    </div>
                    <div class="col-xs-6 description-room">
                        <p>
                            <?php echo "<strong>" . $room['pk_qua_num'] . "</strong><br>R$: " . $room['tip_val'] ?>
                        </p>
                        <span>
                            <?php echo $room['tip_desc']; ?>
                        </span>
                    </div>
                    <div class="col-xs-2 checkbox-room">
                        <input 
                            type="checkbox" 
                            class="check-room" 
                            name="room[]" 
                            value="<?php echo $room['pk_qua_num'] ?>"
                        >
                        <input 
                            type="hidden" 
                            name="values[]" 
                            value="<?php echo $room['tip_val'] ?>"
                        >
                    </div>
                    
                    
                </div>
                <?php  
                    }
                }
            ?>
            <input type="hidden" name="checkIn" value=<?php echo $_GET['checkIn'] ?> >
            <input type="hidden" name="checkOut" value=<?php echo $_GET['checkOut'] ?> >
            <button type="submit" id="sendRooms"></button>
        </form>
    </div>

    <!--</div>-->

    <button id="finalize" class="outerFullBox">Prosseguir</button>

</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {

        $("#finalize").on("click", function() {
            if($(".check-room:checked").size() > 0) {
                $('#sendRooms').click();
            } else {
                alert("Você precisa selecionar ao menos um quarto!");
            }
        });
    });
</script>

<?php  include '../_footer.php';  ?>