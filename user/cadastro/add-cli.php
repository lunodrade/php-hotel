<?php 
             
include '../cabecalho.php';
include '../conecta.php';
include 'controle.php';





        $nome        =   $_GET['nome'];
        $cpf         =   $_GET['cpf'];
        $rg          =   $_GET['rg'];
        $data_nasc   =   $_GET['dataNasc'];
        $email       =   $_GET['checkEmail'];
        $senha       =   $_GET['senha'];


        $asd = insereCliente($conexao, $nome, $data_nasc, $cpf, $rg, $email);
        $uc =  ultimoCliente($nome,$email,$senha); 

            if ($asd && $uc){ ?>
              
            
               <p class="text-success"> Cliente/Usuário adicionado com sucesso!  </p>
        
        <?php } else{ 
            $msg = mysqli_error($conexao);
        ?>
            <p class="text-danger"> não foi adicionado: <?=$msg?> </p>
  
         <?php
        }

?>
 
              
            
    
<?php  include '../rodape.php' ?>
