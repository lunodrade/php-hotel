<?php

require_once '../../database.php';
			
class Controller extends ConfigController
{	
	function __construct()
	{	
        parent::__construct();
	}
	
	public function salvar()
	{	
		try {
			
			if(isset($_POST) && !empty($_POST)) {

				$data = $this->conn->prepare("INSERT INTO tb_clientes (cli_nome,cli_sobr,cli_sexo,cli_tel,cli_nasc,cli_rg,cli_cpf) VALUES ('".$_POST["cli_nome"]."', '".$_POST["cli_sobr"]."', '".$_POST["cli_sexo"]."', '".$_POST["cli_tel"]."', '".$_POST["cli_nasc"]."', '".$_POST["cli_rg"]."', '".$_POST["cli_cpf"]."')");

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

		header("Location: ". URL . DS . 'admin' . DS . 'tb_clientes');
	}

	public function atualizar($id)
	{	
		try {

			if(isset($_POST) && !empty($_POST)) {
				$data = $this->conn->prepare("UPDATE tb_clientes SET cli_nome = '".$_POST['cli_nome']."', cli_sobr = '".$_POST['cli_sobr']."', cli_sexo = '".$_POST['cli_sexo']."', cli_tel = '".$_POST['cli_tel']."', cli_nasc = '".$_POST['cli_nasc']."', cli_rg = '".$_POST['cli_rg']."', cli_cpf = '".$_POST['cli_cpf']."' WHERE pk_cli_cod = ".$id."");

				if ($data->execute()) {
					$_SESSION['sucess']  = 'Registro atualizado com sucesso!';
				} else {
					$_SESSION['error']   = 'Erro ao atualizar registro!';
				}

			} else {
				$data = $this->conn->prepare("SELECT * FROM tb_clientes WHERE pk_cli_cod = ".$id."");

				$data->execute();
	
				$result = $this->listaCombo();

				$result['tb_clientes'] = $data->fetch(PDO::FETCH_ASSOC);

				return $result;
			}

		} catch (Exception $e) {
			if(DEBUG){
				$_SESSION['error'] = $e->getMessage();
			} else {
				$_SESSION['error']   = 'Erro ao atualizar registro!';
			}
		}

		header("Location: ". URL . DS . 'admin' . DS . 'tb_clientes');
	}

	public function listar()
	{
		try {
			
			$data = $this->conn->prepare("SELECT * FROM tb_clientes");

			$data->execute();

			return $data->fetchAll(PDO::FETCH_ASSOC);

		} catch (Exception $e) {
			if(DEBUG){
				$_SESSION['error'] = $e->getMessage();
			} else {
				$_SESSION['error']   = 'Erro ao listar registros!';
			}
		}
	}

	public function deletar($id)
	{
		try {
			
			$data = $this->conn->prepare("DELETE FROM tb_clientes WHERE pk_cli_cod = ".$id."");

			if ($data->execute()) {
				$_SESSION['sucess']  = 'Registro excluído com sucesso!';
			} else {
				$_SESSION['error']   = 'Erro ao excluir registro!';
			}

		} catch (Exception $e) {
			if(DEBUG){
				$_SESSION['error'] = $e->getMessage();
			} else {
				$_SESSION['error']   = 'Erro ao excluir registro!';
			}
		}

		header("Location: ". URL . DS . 'admin' . DS . 'tb_clientes');
	}

	public function listaCombo()
	{
		$data = array();

		

		return $data;
	}
}

if(class_exists('Controller') && !isset($class))
{	
	$class 	= new Controller();
}

?>
		