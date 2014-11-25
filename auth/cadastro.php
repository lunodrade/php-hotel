<?php 

require_once '../database.php';
			
class Cadastro extends ConfigController
{	
	function __construct()
	{	
        parent::__construct();
	}
	
	public function salvar()
	{	
		try {
			
			if(isset($_POST) && !empty($_POST)) {

				$data = $this->conn->prepare("INSERT INTO tb_clientes (cli_nome,cli_sobr,cli_sexo,cli_tel,cli_nasc,cli_rg,cli_cpf) VALUES ('".$_POST["nome"]."', '".$_POST["sobrenome"]."', '".$_POST["sexo"]."', '".$_POST["telefone"]."', '".$_POST["datanasc"]."', '".$_POST["rg"]."', '".$_POST["cpf"]."')");
                

				if ($data->execute()) {
					$_SESSION['sucess']  = 'Registro cadastrado com sucesso!';
				} else {
					$_SESSION['error']   = 'Erro ao cadastrar registro!';
				}

              
			}

		} catch (Exception $e) {

			if(DEBUG){
				$_SESSION['error'] = $e->getMessage();
			} else {
				$_SESSION['error']   = 'Erro ao cadastrar registro!';
			}
		}
        
        
       		              
                $sql = "select max(pk_cli_cod)  as max_cod from tb_clientes";

                $stm = $this->conn->query($sql);

                $id = 42;

                if($stm->rowCount()>0){
                    $dado = $stm->fetch(PDO::FETCH_ASSOC);
                    $id = $dado['max_cod'];


                }


                $sql = "INSERT INTO tb_usuarios(usu_email, usu_senha, usu_tipo, fk_cli_cod, usu_conf, usu_hash) 
                        VALUES('".$_POST["email"]."', '".$_POST["senha"]."', 'user', $id, 'false', '')";
                $stm = $this->conn->query($sql);

                
				
   
         $id = $this->conn->lastInsertId(); 
        header("Location: ". URL . 'auth/sendmail_confirmation.php?user='.$id);
        
	}

	
}

if(class_exists('Cadastro') && !isset($class))
{	
	$class 	= new Cadastro();
}

?>