<?php

$usuario = "Fulano";
$link_hash = "http://labs.lucianoandrade.me/hotel/auth/confirm_email.php?hash=";
$link_hash .= md5(uniqid(time()));;

include 'email_template.php';

$to = "uchiha.luciano@gmail.com";

$subject = "HTML email";

$message = $emailTemplate;

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <hotel@lucianoandrade.me>' . "\r\n";
//$headers .= 'Cc: andrade.luciano@live.com' . "\r\n";

mail($to,$subject,$message,$headers);

?>