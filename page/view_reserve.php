<?php

require_once '../lib/RNCryptor/autoload.php';

?>
<?php 
include '../constantes.php'; 
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

    <!-- Custom styles for this template -->
    <link href="<?php echo ASSETS ?>/css/cover.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo ASSETS ?>/js/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    

    <style type="text/css">
        
        
        .masthead, .mastfoot {
            position: static;
        }
        
        .masthead {
            margin-bottom: 100px;
        }
        
        .mastfoot {
            margin-top: 100px;
        }
    </style>
    
  </head>

  <body>

    <div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              
              
              <?php


$password = "myPassword";

$base64EncryptedIn = rawurldecode($_GET['data']);
//$base64EncryptedIn = "AwHLJhdnkGFMXex0soqCJRGteESjMhC9s5A76Uziwq7z05WQV8wm2BXuC30OQM9visuLKkpxVLfuZ7+YCHGW6zayl0B9k78wr/q9kP6kK6cPOSPkg8X5G+S+XrvKbymHFRVCnEO7oKwiotWi/Dwq3WDF+SNIMUH+/IPD1QFHekRh3A==";

$decryptor = new \RNCryptor\Decryptor();
$plaintextIn = $decryptor->decrypt($base64EncryptedIn, $password);

echo "GET: " . rawurldecode($_GET['data']);
echo "<br><br>";
echo "Plaintext:\n" . $plaintextIn;
echo "<br><br>------------------------------------------<br><br>";

$arrIn = json_decode($plaintextIn, true);

echo json_encode($arrIn);

/*************************************************************************/

echo "<br><br>";
    include "../lib/phpqrcode/qrlib.php"; 
    
    $filename = 'qrcode.png';
    
    
    
    $errorCorrectionLevel = 'L';  

    $matrixPointSize = 6;
    
    $data = dirname(__FILE__) . "/preview?data=" . $base64EncryptedIn;

    QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);   
        
    //display generated file
    echo '<img src="'.$filename.'" /><hr/>';  
    

?>
              
            </div>
          </div>            
           <div class="mastfoot">
            <div class="inner">
              <p>Rodape</p>
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