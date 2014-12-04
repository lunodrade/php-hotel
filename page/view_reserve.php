<?php 
include '../constantes.php'; 

require_once '../lib/RNCryptor/autoload.php';
require_once "../lib/phpqrcode/qrlib.php"; 


$password = "myPassword";
$base64EncryptedIn = rawurldecode($_GET['data']);
$decryptor = new \RNCryptor\Decryptor();
$plaintextIn = $decryptor->decrypt($base64EncryptedIn, $password);
$arrIn = json_decode($plaintextIn, true);

$filename = '../temp/qrcode.png';
$errorCorrectionLevel = 'L';  
$matrixPointSize = 6;
$data = URL . "/page/view_reserve.php?data=" . rawurlencode($_GET['data']);
QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);   

function echoInfos($arrIn) {
    //Conectar no banco
    $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    //Prepara o query, usando :values
    $consulta = $pdo->prepare("SELECT DISTINCT c.cli_nome, c.cli_sobr, r.res_in, r.res_out, r.fk_qua_num
                               FROM tb_reservas r
                               INNER JOIN tb_clientes c ON c.pk_cli_cod = r.fk_cli_cod
                               WHERE pk_res_cod = :res_cod;");

    //Troca os :symbol pelos valores que irão executar
    //Ao mesmo tempo protege esses valores de injection
    $id = 0;
    $consulta->bindParam(":res_cod", $id);
    
    $cliente;
    $checkIn;
    $checkOut;
    $rooms = [];
    
    for($i=0; $i<count($arrIn); $i++) {
        //Pega o ID do select
        $id = $arrIn[$i];
        //Executa o sql
        $consulta->execute();

        if ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            //Trabalhar com os resultados
            $cliente = $linha['cli_nome'] . " " . $linha['cli_sobr'];
            $checkIn = $linha['res_in'];
            $checkOut = $linha['res_out'];
            $rooms[$i] = $linha['fk_qua_num'];
        } else {
            echo "erro";
            die();
        }
    }
    
    echo "<h1><strong>Cliente</strong></h1>"; 
    echo "<h3>" . $cliente . "</h3><br>"; 
    echo "<h1><strong>Data da reserva</strong></h1>"; 
    echo "<h4><strong>Entrada: </strong>" . $checkIn . "</h4>"; 
    echo "<h4><strong>Saída: </strong>" . $checkOut . "</h4><br>"; 
    echo "<h1><strong>Quartos</strong></h1>"; 
    echo "<ul style='font-size:1.5em;'>";
    for($i=0; $i<count($rooms); $i++) {
        echo "<li>" . $rooms[$i] . "</li>";
    }
    echo "</ul>";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo URL ?>/favicon.ico">
    
    <script type="text/javascript" src="<?php echo ASSETS ?>/js/jquery.min.js"></script>

    <title>Hotel</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo ASSETS ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo ASSETS ?>/js/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    

    <style type="text/css">
        body {
            text-align: center;
            padding: 100px 0;
        }
        
        .masthead, .mastfoot {
            position: static;
        }
        
        .masthead {
            margin-bottom: 100px;
        }
        
        .mastfoot {
            margin-top: 100px;
        }
        
        .details {
            text-align: left;
        }
    </style>
    
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              
              
              

<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="row clearfix">
				<div class="col-md-2 column">
				</div>
				<div class="col-md-4 column details">
				    <?php echoInfos($arrIn); ?>
				</div>
				<div class="col-md-4 column">
                    <?php echo '<img src="' . $filename . '" />';  ?>
				</div>
				<div class="col-md-2 column">
				</div>
			</div>
		</div>
	</div>
</div>
        
    


              
            </div>
          </div>            
           <div class="mastfoot">
            <div class="inner">
              <p>Empresa Tal, na rua x, do bairro y, da cidade z, na República Rio-Grandense. <br>Nenhum direito reservado :)</p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo ASSETS ?>/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo ASSETS ?>/js/ie10-viewport-bug-workaround.js"></script>
  

</body></html>
