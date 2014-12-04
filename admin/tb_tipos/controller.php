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

                //Conectar no banco
                $pdo = $this->conn;

                //Prepara o query, usando :values
                $data = $pdo->prepare("INSERT INTO tb_tipos
                                       (tip_nome, tip_val, tip_desc)
                                       VALUES
                                       (:nome, :val, :desc);");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":nome",  $_POST["tip_nome"]);
                $data->bindValue(":val",   $_POST["tip_val"]);
                $data->bindValue(":desc",  $_POST["tip_desc"]);
                
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

		header("Location: ". URL . DS . 'admin' . DS . 'tb_tipos');
	}

	public function atualizar($id)
	{	
		try {

			if(isset($_POST) && !empty($_POST)) {
                
                //Conectar no banco
                $pdo = $this->conn;

                //Prepara o query, usando :values
                $data = $pdo->prepare("UPDATE tb_tipos
                                       SET tip_nome = :nome, 
                                           tip_val = :val, 
                                           tip_desc = :desc
                                       WHERE pk_tip_cod = :id;");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":nome",  $_POST["tip_nome"]);
                $data->bindValue(":val",   $_POST["tip_val"]);
                $data->bindValue(":desc",  $_POST["tip_desc"]);
                $data->bindValue(":id",    $id);

				if ($data->execute()) {
					$_SESSION['sucess']  = 'Registro atualizado com sucesso!';
				} else {
					$_SESSION['error']   = 'Erro ao atualizar registro!';
				}

			} else {
                //Conectar no banco
                $pdo = $this->conn;

                //Prepara o query, usando :values
                $data = $pdo->prepare("SELECT *
                                       FROM tb_tipos
                                       WHERE pk_tip_cod = :id;");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":id", $id);

				$data->execute();
	
				$result = $this->listaCombo();

				$result['tb_tipos'] = $data->fetch(PDO::FETCH_ASSOC);

				return $result;
			}

		} catch (Exception $e) {
			if(DEBUG){
				$_SESSION['error'] = $e->getMessage();
			} else {
				$_SESSION['error']   = 'Erro ao atualizar registro!';
			}
		}

		header("Location: ". URL . DS . 'admin' . DS . 'tb_tipos');
	}

	public function listar()
	{
		try {
			
            //Conectar no banco
            $pdo = $this->conn;

            //Prepara o query, usando :values
            $data = $pdo->prepare("SELECT *
                                   FROM tb_tipos;");

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
			
            //Conectar no banco
            $pdo = $this->conn;

            //Prepara o query, usando :values
            $data = $pdo->prepare("DELETE 
                                   FROM tb_tipos
                                   WHERE pk_tip_cod = :id;");

            //Troca os :symbol pelos valores que irão executar
            //Ao mesmo tempo protege esses valores de injection
            $data->bindValue(":id", $id);

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

		header("Location: ". URL . DS . 'admin' . DS . 'tb_tipos');
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
		