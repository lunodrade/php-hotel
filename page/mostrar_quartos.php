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
        return $dados;
    }
    else {
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
    
    
    
    
    
    
    

    <h1 class="cover-heading outerFullBox">Selecione o(s) quarto(s)</h1>
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
                  <div class="col-xs-4 image-room"> <img src="../assets/img/room-101.jpg" width="100%"> </div>
                  <div class="col-xs-6 description-room"><p><?php echo $room['pk_qua_num'] ?></p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum adipisci error non tempora inventore officia dolores eligendi doloremque voluptas quisquam quibusdam illum tempore modi repudiandae iusto necessitatibus laborum, impedit ipsum.</div>
                  <div class="col-xs-2 checkbox-room"><input type="checkbox" class="check-room" name="room[]" value="<?php echo $room['pk_qua_num'] ?>"></div>
              </div>
        <?php  
            }
        }
        ?>
        
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