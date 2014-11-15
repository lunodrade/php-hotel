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
        
        //$pdo = new PDO('mysql:dbname=projectCake;host=localhost', 'root', '');
        $pdo = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSER, DBPASS);
        $sess = Sessao::instanciar();
        
        $sql = "select * 
               from tb_usuarios
               where usu_email ='{$email}' and
                   usu_senha = '{$senha}'";
                   
        $stm = $pdo->query($sql);
        
        if ($stm->rowCount() > 0) {
        
            $dados = $stm->fetch(PDO::FETCH_ASSOC);

            $usuario = new Usuario();
            $usuario->setEmail($dados['usu_nome']);
            $usuario->setId($dados['pk_usu_cod']);
            $usuario->setNome($dados['usu_nome']);
            $usuario->setSenha($dados['usu_senha']);
            $usuario->setTipo($dados['usu_tipo']);
            $usuario->setCliente($dados['fk_cli_cod']);

            $sess->set('usuario', $usuario);
            return true;
            
        }
        else {
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

