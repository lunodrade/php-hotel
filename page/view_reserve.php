<?php

require_once '../lib/RNCryptor/autoload.php';

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