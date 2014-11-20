<?php

function insereCliente($conexao, $nome, $data_nasc, $cpf, $rg, $email){
    //executa a query    
    $query = "INSERT INTO tb_clientes(cli_nome, cli_nasc, cli_rg, cli_cpf) VALUES ('{$nome}','{$data_nasc}',{$rg},{$cpf})";
    
    
   
    return mysqli_query($conexao,$query);
}


function ultimoCliente($nome,$email,$senha){
    $conn =  new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
    
    $sql = "select max(pk_cli_cod)  as max_cod from tb_clientes";
    
    $stm = $conn->query($sql);
    
    $id = 42;
    
    if($stm->rowCount()>0){
        $dado = $stm->fetch(PDO::FETCH_ASSOC);
        $id = $dado['max_cod'];
        
        
    }
        
      
    $sql = "INSERT INTO tb_usuarios(usu_nome, usu_email,usu_senha,usu_tipo,fk_cli_cod) VALUES('{$nome}','{$email}','{$senha}','user',$id)";
    $stm = $conn->query($sql);
    
     
    
    
return true;

}




