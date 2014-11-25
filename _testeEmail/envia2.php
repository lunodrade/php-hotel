<?php
$to = "uchiha.luciano@gmail.com";

$assunto          = $_POST['assunto'];
$nomeremetente = $_POST['nome'];
$emailremetente    = trim($_POST['e-mail']);
$mensagem          = $_POST['mensagem'];
$mensagem = nl2br($mensagem); // Para manter os parágrafos e quebras de linha

$subject = "HTML email";

/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<P>FORMULARIO PREENCHIDO NO SITE [URL="http://www.meudominio.com.br</P"]www.meudominio.com.br</P[/URL]>
<p><b>Nome: </b> '.$nomeremetente.'
<p><b>E-Mail: </b> '.$emailremetente.'
<p><b>Assunto: </b> '.$assunto.'
<p><b>Mensagem: </b> '.$mensagem.'</p>
<hr>';

// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.1" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: $emailremetente\r\n"; // remetente

$envio = mail($to, $assunto, $mensagemHTML, $headers); 
 
 if($envio)
    //echo "<script>location.href='sucesso.html'</script>"; // Página que será redirecionada
    echo "enviado!"; // Página que será redirecionada
?>