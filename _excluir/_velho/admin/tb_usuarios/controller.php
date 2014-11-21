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

				
				if(isset($_POST["fk_cli_cod"]) and !empty($_POST["fk_cli_cod"])) {
					$data = $this->conn->prepare("INSERT INTO tb_usuarios (usu_nome,usu_email,usu_senha,usu_tipo,fk_cli_cod) VALUES ('".$_POST["usu_nome"]."', '".$_POST["usu_email"]."', '".$_POST["usu_senha"]."', '".$_POST["usu_tipo"]."', '".$_POST["fk_cli_cod"]."')");
				} else {
					$data = $this->conn->prepare("INSERT INTO tb_usuarios (usu_nome,usu_email,usu_senha,usu_tipo) VALUES ('".$_POST["usu_nome"]."', '".$_POST["usu_email"]."', '".$_POST["usu_senha"]."', '".$_POST["usu_tipo"]."')");
				}

				if ($data->execute()) {
					$_SESSION['sucess']  = 'Registro cadastrado com sucesso! Oi 2!';
				} else {
					$_SESSION['error']   = 'Erro ao cadastrar registro! AQUI';
				}
			}

		} catch (Exception $e) {

			if(DEBUG){
				$_SESSION['error'] = $e->getMessage();
			} else {
				$_SESSION['error']   = 'Erro ao cadastrar registro!';
			}
		}

		header("Location: ". URL . DS . 'admin' . DS . 'tb_usuarios');
	}

	public function atualizar($id)
	{	
		try {

			if(isset($_POST) && !empty($_POST)) {
				
                
				if(isset($_POST["fk_cli_cod"]) and !empty($_POST["fk_cli_cod"])) {
					$data = $this->conn->prepare("UPDATE tb_usuarios SET usu_nome = '".$_POST['usu_nome']."', usu_email = '".$_POST['usu_email']."', usu_senha = '".$_POST['usu_senha']."', usu_tipo = '".$_POST['usu_tipo']."', fk_cli_cod = '".$_POST['fk_cli_cod']."' WHERE pk_usu_cod = ".$id."");
				} else {
					$data = $this->conn->prepare("UPDATE tb_usuarios SET usu_nome = '".$_POST['usu_nome']."', usu_email = '".$_POST['usu_email']."', usu_senha = '".$_POST['usu_senha']."', usu_tipo = '".$_POST['usu_tipo']."' WHERE pk_usu_cod = ".$id."");
				}

				if ($data->execute()) {
					$_SESSION['sucess']  = 'Registro atualizado com sucesso! Oi!';
				} else {
					$_SESSION['error']   = 'Erro ao atualizar registro!';
				}

			} else {
				$data = $this->conn->prepare("SELECT * FROM tb_usuarios WHERE pk_usu_cod = ".$id."");

				$data->execute();
	
				$result = $this->listaCombo();

				$result['tb_usuarios'] = $data->fetch(PDO::FETCH_ASSOC);

				return $result;
			}

		} catch (Exception $e) {
			if(DEBUG){
				$_SESSION['error'] = $e->getMessage();
			} else {
				$_SESSION['error']   = 'Erro ao atualizar registro!';
			}
		}

		header("Location: ". URL . DS . 'admin' . DS . 'tb_usuarios');
	}

	public function listar()
	{
		try {
			
			$data = $this->conn->prepare("SELECT * FROM tb_usuarios");

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
			
			$data = $this->conn->prepare("DELETE FROM tb_usuarios WHERE pk_usu_cod = ".$id."");

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

		header("Location: ". URL . DS . 'admin' . DS . 'tb_usuarios');
	}

	public function listaCombo()
	{
		$data = array();

		$data['fk_cli_cod_list']       = $this->conn->query('SELECT pk_cli_cod FROM tb_clientes')->fetchAll(PDO::FETCH_ASSOC);


		return $data;
	}
}

if(class_exists('Controller') && !isset($class))
{	
	$class 	= new Controller();
}

?>