<?php
// Passando os dados obtidos pelo formulário para as variáveis abaixo
$assunto          = $_POST['assunto'];
$nomeremetente = $_POST['nome'];
$emailremetente    = trim($_POST['e-mail']);
$mensagem          = $_POST['mensagem'];
$mensagem = nl2br($mensagem); // Para manter os parágrafos e quebras de linha
$emaildestinatario = [EMAIL="'hotel@lucianoandrade.me'"]'hotel@lucianoandrade.me'[/EMAIL]; // Seu e-mail aqui, lembrando que o e-mail deve estar em seu servidor web
 
/* Montando a mensagem a ser enviada no corpo do e-mail. */
$mensagemHTML = '<P>FORMULARIO PREENCHIDO NO SITE [URL="http://www.meudominio.com.br</P"]www.meudominio.com.br</P[/URL]>
<p><b>Nome:</b> '.$nomeremetente.'
<p><b>E-Mail:</b> '.$emailremetente.'
<p><b>Assunto:</b> '.$assunto.'
<p><b>Mensagem:</b> '.$mensagem.'</p>
<hr>';
// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.
$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From: $emailremetente\r\n"; // remetente
$headers .= "Return-Path: $emaildestinatario \r\n"; // return-path
 
$envio = mail($emaildestinatario, $assunto, $mensagemHTML, $headers); 
 
 if($envio)
//echo "<script>location.href='sucesso.html'</script>"; // Página que será redirecionada
echo "enviado!"; // Página que será redirecionada
?>