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

				$data = $this->conn->prepare("INSERT INTO tb_quartos (qua_status,fk_tip_cod) VALUES ('".$_POST["qua_status"]."', '".$_POST["fk_tip_cod"]."')");

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

		header("Location: ". URL . DS . 'admin' . DS . 'tb_quartos');
	}

	public function atualizar($id)
	{	
		try {

			if(isset($_POST) && !empty($_POST)) {
				$data = $this->conn->prepare("UPDATE tb_quartos SET qua_status = '".$_POST['qua_status']."', fk_tip_cod = '".$_POST['fk_tip_cod']."' WHERE pk_qua_num = ".$id."");

				if ($data->execute()) {
					$_SESSION['sucess']  = 'Registro atualizado com sucesso!';
				} else {
					$_SESSION['error']   = 'Erro ao atualizar registro!';
				}

			} else {
				$data = $this->conn->prepare("SELECT * FROM tb_quartos WHERE pk_qua_num = ".$id."");

				$data->execute();
	
				$result = $this->listaCombo();

				$result['tb_quartos'] = $data->fetch(PDO::FETCH_ASSOC);

				return $result;
			}

		} catch (Exception $e) {
			if(DEBUG){
				$_SESSION['error'] = $e->getMessage();
			} else {
				$_SESSION['error']   = 'Erro ao atualizar registro!';
			}
		}

		header("Location: ". URL . DS . 'admin' . DS . 'tb_quartos');
	}

	public function listar()
	{
		try {
			
			$data = $this->conn->prepare("SELECT * FROM tb_quartos");

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
			
			$data = $this->conn->prepare("DELETE FROM tb_quartos WHERE pk_qua_num = ".$id."");

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

		header("Location: ". URL . DS . 'admin' . DS . 'tb_quartos');
	}

	public function listaCombo()
	{
		$data = array();

		$data['fk_tip_cod_list']       = $this->conn->query('SELECT pk_tip_cod FROM tb_tipos')->fetchAll(PDO::FETCH_ASSOC);


		return $data;
	}
}

if(class_exists('Controller') && !isset($class))
{	
	$class 	= new Controller();
}

?>
		