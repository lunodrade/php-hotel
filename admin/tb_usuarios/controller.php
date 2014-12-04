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
                $data = $pdo->prepare("INSERT INTO tb_usuarios
                                       (usu_email, usu_senha, usu_tipo, usu_conf, usu_hash, fk_cli_cod)
                                       VALUES
                                       (:email, :senha, :tipo, :conf, :hash, :fk_cli);");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":email",  $_POST["usu_email"]);
                $data->bindValue(":senha",  $_POST["usu_senha"]);
                $data->bindValue(":tipo",   $_POST["usu_tipo"]);
                $data->bindValue(":conf",   $_POST["usu_conf"]);
                $data->bindValue(":hash",   $_POST["usu_hash"]);
                $data->bindValue(":fk_cli", $_POST["fk_cli_cod"]);
                
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

		header("Location: ". URL . DS . 'admin' . DS . 'tb_usuarios');
	}

	public function atualizar($id)
	{	
		try {

			if(isset($_POST) && !empty($_POST)) {
                
                //Conectar no banco
                $pdo = $this->conn;

                //Prepara o query, usando :values
                $data = $pdo->prepare("UPDATE tb_usuarios
                                       SET usu_email = :email, 
                                           usu_senha = :senha, 
                                           usu_tipo = :tipo, 
                                           usu_conf = :conf, 
                                           usu_hash = :hash, 
                                           fk_cli_cod = :fk_cli
                                       WHERE pk_usu_cod = :id;");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":email",  $_POST["usu_email"]);
                $data->bindValue(":senha",  $_POST["usu_senha"]);
                $data->bindValue(":tipo",   $_POST["usu_tipo"]);
                $data->bindValue(":conf",   $_POST["usu_conf"]);
                $data->bindValue(":hash",   $_POST["usu_hash"]);
                $data->bindValue(":fk_cli", $_POST["fk_cli_cod"]);
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
                                       FROM tb_usuarios
                                       WHERE pk_usu_cod = :id;");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":id", $id);

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
			
            //Conectar no banco
            $pdo = $this->conn;

            //Prepara o query, usando :values
            $data = $pdo->prepare("SELECT *
                                   FROM tb_usuarios;");

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
                                   FROM tb_usuarios
                                   WHERE pk_usu_cod = :id;");

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
		