<?php

if (!defined('__ROOT__'))  define('__ROOT__', dirname(dirname(__FILE__)));

if($_SERVER['HTTP_HOST'] == '127.0.0.1') {
	include_once __ROOT__ . '\constantes.php';
} else {
	include_once __ROOT__ . '/constantes.php';
}

abstract class Autenticador {
    
    private static $instancia = null;
    
    private function __construct() {}
    
    /**
     * 
     * @return Autenticador
     */
    public static function instanciar() {
        
        if (self::$instancia == NULL) {
            self::$instancia = new AutenticadorEmBanco();
        }
        
        return self::$instancia;
        
    }
    
    public abstract function logar($email, $senha);
    public abstract function esta_logado();
    public abstract function pegar_usuario();
    public abstract function expulsar();
    
}

class AutenticadorEmBanco extends Autenticador {
    
    public function esta_logado() {
        $sess = Sessao::instanciar();
        return $sess->existe('usuario');
    }

    public function expulsar() {
        header('location: controle.php?acao=sair');
    }

    public function logar($email, $senha) {        
        //Conectar no banco
        $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
        $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

        //Prepara o query, usando :values
        $consulta = $pdo->prepare("SELECT *
                              FROM tb_usuarios
                              WHERE usu_email = :email AND
                                    usu_senha = :senha;");
        
        //Troca os :symbol pelos valores que irão executar
        //Ao mesmo tempo protege esses valores de injection
        $consulta->bindValue(":email", $email);
        $consulta->bindValue(":senha", $senha);

        //Executa o sql
        $consulta->execute();
            
        if($dados = $consulta->fetch(PDO::FETCH_ASSOC)) {

            if($dados['usu_conf'] == 1) {
                $usuario = new Usuario();
                $usuario->setId($dados['pk_usu_cod']);
                $usuario->setEmail($dados['usu_email']);
                $usuario->setSenha($dados['usu_senha']);
                $usuario->setTipo($dados['usu_tipo']);
                $usuario->setCliente($dados['fk_cli_cod']);

                $sess = Sessao::instanciar();
                $sess->set('usuario', $usuario);

                return true;
            } else {
                $sess = Sessao::instanciar();
                $sess->set('email', $email);
                $sess->set('senha', $senha);
                
                header('location: unconfirmed_email.php');
                die();
            }
            
        } else {
            return false;
        }
    }

    public function pegar_usuario() {
        $sess = Sessao::instanciar();
        
        if ($this->esta_logado()) {
            $usuario = $sess->get('usuario');
            return $usuario;
        }
        else {
            return false;
        }
    }

}

