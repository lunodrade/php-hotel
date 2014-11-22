<?php 

require_once '../database.php';
			
class cadastro extends ConfigController
{	
	function __construct()
	{	
        parent::__construct();
	}
	
	public function salvar()
	{	
		try {
			
			if(isset($_POST) && !empty($_POST)) {

				$data = $this->conn->prepare("INSERT INTO tb_clientes (cli_nome,cli_sobr,cli_sexo,cli_tel,cli_nasc,cli_rg,cli_cpf) VALUES ('".$_POST["nome"]."', '".$_POST["sobrenome"]."', '".$_POST["sexo"]."', '".$_POST["telefone"]."', '".$_POST["dataNasc"]."', '".$_POST["rg"]."', '".$_POST["cpf"]."')");

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

		header("Location: ". URL . DS . 'tb_clientes');
	}

	

//if(class_exists('Controller') && !isset($class))
//{	
//	$class 	= new Controller();
//}
}
?>