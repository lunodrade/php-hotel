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
                $data = $pdo->prepare("INSERT INTO tb_clientes
                                       (cli_nome, cli_sobr, cli_sexo, cli_tel, cli_nasc, cli_rg, cli_cpf)
                                       VALUES
                                       (:nome, :sobr, :sexo, :tel, :nasc, :rg, :cpf);");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":nome",  $_POST["cli_nome"]);
                $data->bindValue(":sobr",  $_POST["cli_sobr"]);
                $data->bindValue(":sexo",  $_POST["cli_sexo"]);
                $data->bindValue(":tel",   $_POST["cli_tel"]);
                $data->bindValue(":nasc",  $_POST["cli_nasc"]);
                $data->bindValue(":rg",    $_POST["cli_rg"]);
                $data->bindValue(":cpf",   $_POST["cli_cpf"]);

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
                
                //Conectar no banco
                $pdo = $this->conn;

                //Prepara o query, usando :values
                $data = $pdo->prepare("UPDATE tb_clientes
                                       SET cli_nome = :nome, 
                                           cli_sobr = :sobr, 
                                           cli_sexo = :sexo, 
                                           cli_tel = :tel, 
                                           cli_nasc = :nasc, 
                                           cli_rg = :rg, 
                                           cli_cpf = :cpf
                                       WHERE pk_cli_cod = :id;");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":nome",  $_POST["cli_nome"]);
                $data->bindValue(":sobr",  $_POST["cli_sobr"]);
                $data->bindValue(":sexo",  $_POST["cli_sexo"]);
                $data->bindValue(":tel",   $_POST["cli_tel"]);
                $data->bindValue(":nasc",  $_POST["cli_nasc"]);
                $data->bindValue(":rg",    $_POST["cli_rg"]);
                $data->bindValue(":cpf",   $_POST["cli_cpf"]);
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
                                       FROM tb_clientes
                                       WHERE pk_cli_cod = :id;");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":id", $id);
                
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
			
            //Conectar no banco
            $pdo = $this->conn;

            //Prepara o query, usando :values
            $data = $pdo->prepare("SELECT *
                                   FROM tb_clientes;");

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
                                   FROM tb_clientes
                                   WHERE pk_cli_cod = :id;");

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
		