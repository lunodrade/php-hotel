<?php 
             
include '../cabecalho.php';
include '../conecta.php';
include 'controle.php';





        $loguser        =   $_GET['usuario'];
       

        $asd = gerahistorico($loguser);

