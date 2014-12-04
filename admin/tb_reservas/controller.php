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
                $data = $pdo->prepare("INSERT INTO tb_reservas
                                       (res_in, res_out, res_val, fk_qua_num, fk_cli_cod)
                                       VALUES
                                       (:in, :out, :val, :fk_qua, :fk_cli);");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":in",     $_POST["res_in"]);
                $data->bindValue(":out",    $_POST["res_out"]);
                $data->bindValue(":val",    $_POST["res_val"]);
                $data->bindValue(":fk_qua", $_POST["fk_qua_num"]);
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

		header("Location: ". URL . DS . 'admin' . DS . 'tb_reservas');
	}

	public function atualizar($id)
	{	
		try {

			if(isset($_POST) && !empty($_POST)) {
                //Conectar no banco
                $pdo = $this->conn;

                //Prepara o query, usando :values
                $data = $pdo->prepare("UPDATE tb_reservas
                                       SET res_in = :in, 
                                           res_out = :out, 
                                           res_val = :val, 
                                           fk_qua_num = :fk_qua, 
                                           fk_cli_cod = :fk_cli
                                       WHERE pk_res_cod = :id;");
                
                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":in",     $_POST["res_in"]);
                $data->bindValue(":out",    $_POST["res_out"]);
                $data->bindValue(":val",    $_POST["res_val"]);
                $data->bindValue(":fk_qua", $_POST["fk_qua_num"]);
                $data->bindValue(":fk_cli", $_POST["fk_cli_cod"]);
                $data->bindValue(":id",     $id);
                
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
                                       FROM tb_reservas
                                       WHERE pk_res_cod = :id;");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $data->bindValue(":id", $id);

				$data->execute();
	
				$result = $this->listaCombo();

				$result['tb_reservas'] = $data->fetch(PDO::FETCH_ASSOC);

				return $result;
			}

		} catch (Exception $e) {
			if(DEBUG){
				$_SESSION['error'] = $e->getMessage();
			} else {
				$_SESSION['error']   = 'Erro ao atualizar registro!';
			}
		}

		header("Location: ". URL . DS . 'admin' . DS . 'tb_reservas');
	}

	public function listar()
	{
		try {
			
            //Conectar no banco
            $pdo = $this->conn;

            //Prepara o query, usando :values
            $data = $pdo->prepare("SELECT *
                                   FROM tb_reservas;");

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
                                   FROM tb_reservas
                                   WHERE pk_res_cod = :id;");

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

		header("Location: ". URL . DS . 'admin' . DS . 'tb_reservas');
	}

	public function listaCombo()
	{
		$data = array();

		$data['fk_qua_num_list']       = $this->conn->query('SELECT pk_qua_num FROM tb_quartos')->fetchAll(PDO::FETCH_ASSOC);
        $data['fk_cli_cod_list']       = $this->conn->query('SELECT pk_cli_cod FROM tb_clientes')->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}
}

if(class_exists('Controller') && !isset($class))
{	
	$class 	= new Controller();
}

?>
		