<?php 

require_once '../database.php';
			
class Cadastro extends ConfigController {	
	function __construct() {	
        parent::__construct();
	}
	
	public function salvar() {	
		try {
			if(isset($_POST) && !empty($_POST)) {
                
                //Conectar no banco
                $pdo = $this->conn;

                //Prepara o query, usando :values
                $query = $pdo->prepare("INSERT INTO tb_clientes
                                        (cli_nome, cli_sobr, cli_sexo, cli_tel, cli_nasc, cli_rg, cli_cpf)
                                        VALUES
                                        (:nome, :sobr, :sexo, :tel, :nasc, :rg, :cpf);");

                //Troca os :symbol pelos valores que irão executar
                //Ao mesmo tempo protege esses valores de injection
                $query->bindValue(":nome",  $_POST["nome"]);
                $query->bindValue(":sobr",  $_POST["sobrenome"]);
                $query->bindValue(":sexo",  $_POST["sexo"]);
                $query->bindValue(":tel",   $_POST["telefone"]);
                $query->bindValue(":nasc",  $_POST["datanasc"]);
                $query->bindValue(":rg",    $_POST["rg"]);
                $query->bindValue(":cpf",   $_POST["cpf"]);
                
                if ($query->execute()) {
                    
                    //Pega o ID do último cliente inserido  
                    $clienteID = $pdo->lastInsertId();

                    //Prepara o query, usando :values
                    $query = $pdo->prepare("INSERT INTO tb_usuarios
                                            (usu_email, usu_senha, usu_tipo, fk_cli_cod, usu_conf, usu_hash)
                                            VALUES
                                            (:email, :senha, :tipo, :fk_cod, :conf, :hash);");

                    //Troca os :symbol pelos valores que irão executar
                    //Ao mesmo tempo protege esses valores de injection
                    $query->bindValue(":email",     $_POST["email"]);
                    $query->bindValue(":senha",     $_POST["senha"]);
                    $query->bindValue(":tipo",      "user");
                    $query->bindValue(":fk_cod",    $clienteID);
                    $query->bindValue(":conf",      false);
                    $query->bindValue(":hash",      "");
                    
                    //Executar o sql
                    if($query->execute()) {
                        
                        //A query foi executada com sucesso
                        $usuarioID = $pdo->lastInsertId();
                        
                        // Enviar pra página que manda o email de confirmação do cadastro
                        header("Location: " . URL . '/auth/sendmail_confirmation.php?user=' . $usuarioID);
                    } else {
                        
                        //Erro ao inserir usuário
                        echo "erro - usuario \n";
                        die();
                    }
                } else {
                    
                    //Erro ao inserir cliente
                    echo "erro - cliente \n";
                    die();
                }
			}
		} catch (Exception $e) {
			if(DEBUG){
				echo $e->getMessage();
			} else {
				echo 'Erro ao cadastrar registro! \n';
			}
		}  
	}
}

if(class_exists('Cadastro') && !isset($class))
{	
	$class 	= new Cadastro();
}

?>