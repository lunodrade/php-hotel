<?php

class Sessao {
    
    private static $instancia = array();
    
    /**
     * 
     * @return Session
     */
    public static function instanciar() {
        
        if (self::$instancia =! null) {
            self::$instancia = new Sessao();
        }
        
        return self::$instancia;
    }
    
    public function set($chave, $valor) {
        session_start();
        $_SESSION[$chave] = $valor;
        session_write_close();
    }
    
    public function get($chave) {
        session_start();
        $value = $_SESSION[$chave];
        session_write_close();
        return $value;
    }
    
    public function existe($chave) {
        session_start();
        if (isset($_SESSION[$chave]) && (!empty($_SESSION[$chave]))) {
            session_write_close();
            return true;
        }
        else {
            session_write_close();
            return false;
        }
    }
}

